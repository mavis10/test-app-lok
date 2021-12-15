<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use stdClass;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class Language extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'language';

    /**
     * The primary key associated with the table.
     *
     * @var integer
     */
    protected $primaryKey = 'languageID';
    public $timestamps = false; //by default timestamp false

    const LANGUAGE_DELETED = "DELETED";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'iso',
        'align',
        'status',
        'createdAt'
    ];

    /**
     * 
     * @return status array
     */
    protected function getENUMStatus() {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM language WHERE Field = 'status'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);

        $arrStatus = [];
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $arrStatus[] = $v;
        }
        return $arrStatus;
    }

    /**
     * 
     * @return status array
     */
    protected function getENUMAlign() {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM language WHERE Field = 'align'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);

        $arrAlign = [];
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $arrAlign[] = $v;
        }
        return $arrAlign;
    }

    /**
     * This functions returns the language object
     * @param type $request
     * @param type $languageObject
     * @return type language object
     */
    private function createObject($request, $languageObject) {
        if (isset($languageObject->languageID)) {
            $languageObject->status = $request->get('status');
        } else {
            $languageObject->createdAt = date('Y-m-d H:i:s');
        }
        $languageObject->name = $request->get('name');
        $languageObject->iso = $request->get('iso');
        $languageObject->align = $request->get('align');
        return $languageObject;
    }

    /**
     * This function returns all languages records 
     * @return type array of language objects
     */
    protected function readAll() {
        $arrAllLanguages = $this::all();
        foreach ($arrAllLanguages as &$language) {
            $language->createdAt = date('d/m/Y', strtotime($language->createdAt));
        }
        return $arrAllLanguages;
    }

    /**
     * This function adds the language details in system
     * @param type $request
     * @param type $response
     * @return type $response object
     */
    protected function add($request, $response) {
        try {
            $newObject = $this->createObject($request, new Language());

            DB::transaction(function () use ($newObject) {
                $newObject->save();
            });

            $response->status = "SUCCESS";
            $response->message = "Language added.";
            $response->data = $this::readAll();
        } catch (Exception $ex) {
            $response->status = "ERROR";
            $response->message = "ERROR OCCURRED " . $ex->getMessage();
        }
        return $response;
    }

    /**
     * This function updates the existed language details 
     * @param type $languageObj
     * @param type $request
     * @param type $response
     * @return type $response object
     */
    protected function updateDetails($languageObj, $request, $response) {
        try {
            $languageObject = $this->createObject($request, $languageObj);
            DB::transaction(function () use ($languageObject) {
                $languageObject->save();
            });

            $response->status = "SUCCESS";
            $response->message = "Language details updated.";
        } catch (Exception $ex) {
            $response->status = "ERROR";
            $response->message = "ERROR OCCURRED " . $ex->getMessage();
        }
        return $response;
    }

    /**
     * This function marks the existed language as deleted 
     * @param type $languageObj
     * @param type $response
     * @return type $response object
     */
    protected function markAsDeleted($languageObj, $response) {
        try {
            $languageObj->status = $this::LANGUAGE_DELETED;

            DB::transaction(function () use ($languageObj) {
                $languageObj->save();
            });

            $response->status = "SUCCESS";
            $response->message = "Language marked as deleted.";
            $response->data = $this::readAll();
        } catch (Exception $ex) {
            $response->status = "ERROR";
            $response->message = "ERROR OCCURRED " . $ex->getMessage();
        }
        return $response;
    }

}
