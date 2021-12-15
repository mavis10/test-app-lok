<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use stdClass;
use TheSeer\Tokenizer\Exception;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class TranslationKey extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'translationKey';

    /**
     * The primary key associated with the table.
     *
     * @var integer
     */
    protected $primaryKey = 'translationKeyID';
    public $timestamps = false; //by default timestamp false

    const KEY_DELETED = "DELETED";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
        'createdAt'
    ];

    /**
     * 
     * @return status array
     */
    protected function getENUMStatus() {
      $type = DB::select(DB::raw("SHOW COLUMNS FROM translationKey WHERE Field = 'status'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);

        $arrStatus = [];
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $arrStatus[] = $v;
        }
        return $arrStatus;
    }

    /**
     * This functions returns the key object
     * @param type $request
     * @param type $translationKeyObject
     * @return type key object
     */
    private function createObject($request, $translationKeyObject) {
        if (isset($translationKeyObject->translationKeyID)) {
            $translationKeyObject->status = $request->get('status');
        } else {
            $translationKeyObject->createdAt = date('Y-m-d H:i:s');
        }
        $translationKeyObject->name = $request->get('name');
        return $translationKeyObject;
    }

    /**
     * This function returns all translation keys records 
     * @return type array of key objects
     */
    protected function readAll() {
        $arrAllKeys = $this::all();
        foreach ($arrAllKeys as &$key) {
            $key->createdAt = date('d/m/Y', strtotime($key->createdAt));
        }
        return $arrAllKeys;
    }

    /**
     * This function adds the key details in system
     * @param type $request
     * @param type $response
     * @return type $response object
     */
    protected function add($request, $response) {
        try {
            $newObject = $this->createObject($request, new TranslationKey());

            DB::transaction(function () use ($newObject) {
                $newObject->save();
            });

            $response->status = "SUCCESS";
            $response->message = "Translation key added.";
            $response->data = $this::readAll();
        } catch (Exception $ex) {
            $response->status = "ERROR";
            $response->message = "ERROR OCCURRED " . $ex->getMessage();
        }
        return $response;
    }

    /**
     * This function updates the existed key details 
     * @param type $translationKeyObj
     * @param type $request
     * @param type $response
     * @return type $response object
     */
    protected function updateDetails($translationKeyObj, $request, $response) {
        try {
            $translationKeyObject = $this->createObject($request, $translationKeyObj);
            DB::transaction(function () use ($translationKeyObject) {
                $translationKeyObject->save();
            });

            $response->status = "SUCCESS";
            $response->message = "Translation key details updated.";
        } catch (Exception $ex) {
            $response->status = "ERROR";
            $response->message = "ERROR OCCURRED " . $ex->getMessage();
        }
        return $response;
    }

    /**
     * This function marks the existed key as deleted 
     * @param type $translationKeyObj
     * @param type $response
     * @return type $response object
     */
    protected function markAsDeleted($translationKeyObj, $response) {
        try {
            $translationKeyObj->status = $this::KEY_DELETED;

            DB::transaction(function () use ($translationKeyObj) {
                $translationKeyObj->save();
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
