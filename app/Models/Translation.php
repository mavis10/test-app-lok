<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use stdClass;
use TheSeer\Tokenizer\Exception;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class Translation extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'translation';

    /**
     * The primary key associated with the table.
     *
     * @var integer
     */
    protected $primaryKey = 'translationID';
    public $timestamps = false; //by default timestamp false

    const TRANSLATION_DELETED = "DELETED";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'languageID',
        'translationKeyID',
        'locale',
        'status',
        'createdAt',
        'recordHistory'
    ];

    /**
     * 
     * @return status array
     */
    protected function getENUMStatus() {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM translation WHERE Field = 'status'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);

        $arrStatus = [];
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $arrStatus[] = $v;
        }
        return $arrStatus;
    }

    /**
     * This functions returns the translation object
     * @param type $request
     * @param type $translationObject
     * @return type translation object
     */
    private function createObject($request, $translationObject) {
        if (isset($translationObject->translationID)) {
            $translationObject->status = $request->get('status');
        } else {
            $translationObject->createdAt = date('Y-m-d H:i:s');
          
        }
        $translationObject->languageID = $request->get('languageID');
        $translationObject->translationKeyID = $request->get('translationKeyID');
        $translationObject->locale = $request->get('locale');
        return $translationObject;
    }

    /**
     * This function returns all translation records 
     * @return type array of translation objects
     */
    protected function readAll() {
        $arrAllTranslations = $this::select('translation.*', 'language.name as language', 'language.iso', 'language.align', 'translationkey.name as translationKey')
                ->join('language', 'language.languageID', '=', 'translation.languageID')
                ->join('translationKey', 'translationKey.translationKeyID', '=', 'translation.translationKeyID')
                ->get();
        foreach ($arrAllTranslations as &$translation) {
            $translation->createdAt = date('d/m/Y', strtotime($translation->createdAt));
        }
        return $arrAllTranslations;
    }

    /**
     * This function returns translation details on translationID
     * @return type array of translation object
     */
    protected function readTranslationDetailsOnID($translationID) {
        $translationObj = $this::select('translation.*', 'language.name as language', 'language.iso', 'language.align', 'translationkey.name as translationKey')
                ->join('language', 'language.languageID', '=', 'translation.languageID')
                ->join('translationKey', 'translationKey.translationKeyID', '=', 'translation.translationKeyID')
                ->where('translation.translationID', '=', $translationID)
                ->first();
        return $translationObj;
    }

    /**
     * This function adds the translation details in system
     * @param type $request
     * @param type $response
     * @return type $response object
     */
    protected function add($request, $response) {
        try {
            $newObject = $this->createObject($request, new Translation());

            DB::transaction(function () use ($newObject) {
                $newObject->save();
            });

            $response->status = "SUCCESS";
            $response->message = "Translation added.";
            $response->data = $this::readAll();
        } catch (Exception $ex) {
            $response->status = "ERROR";
            $response->message = "ERROR OCCURRED " . $ex->getMessage();
        }
        return $response;
    }

    /**
     * This function updates the existed translation details 
     * @param type $translationObj
     * @param type $request
     * @param type $response
     * @return type $response object
     */
    protected function updateDetails($translationObj, $request, $response) {
        try {
            $translationObject = $this->createObject($request, $translationObj);
            DB::transaction(function () use ($translationObject) {
                $translationObject->save();
            });

            $response->status = "SUCCESS";
            $response->message = "Translation details updated.";
        } catch (Exception $ex) {
            $response->status = "ERROR";
            $response->message = "ERROR OCCURRED " . $ex->getMessage();
        }
        return $response;
    }

    /**
     * This function marks the existed translation as deleted 
     * @param type $translationObj
     * @param type $response
     * @return type $response object
     */
    protected function markAsDeleted($translationObj, $response) {
        try {
            $translationObj->status = $this::TRANSLATION_DELETED;

            DB::transaction(function () use ($translationObj) {
                $translationObj->save();
            });

            $response->status = "SUCCESS";
            $response->message = "Key marked as deleted.";
            $response->data = $this::readAll();
        } catch (Exception $ex) {
            $response->status = "ERROR";
            $response->message = "ERROR OCCURRED " . $ex->getMessage();
        }
        return $response;
    }
}
