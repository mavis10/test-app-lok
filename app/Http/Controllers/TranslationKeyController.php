<?php

namespace App\Http\Controllers;

use App\Models\TranslationKey;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use stdClass;
use function GuzzleHttp\json_encode;
use function view;

class TranslationKeyController extends Controller {

    /**
     * This function renders the view list of all keys 
     * @return type view
     */
    public function index() {
        $arrAllTranslationKeys = TranslationKey::readAll();
        return view('translationKey.index', compact('arrAllTranslationKeys'));
    }

    /**
     * This function stores the new key details in system
     * @param type $request
     * @return type $response object
     */
    public function store(Request $request) {
        $response = new stdClass();
        if (TranslationKey::where('name', $request->get('name'))->exists()) {
            $response->statusTranslationKeyName = "EXIST";
            $response->messageTranslationKeyNameExist = "Translation key already exists.";
        }

        if (empty((array) $response)) {
            $response = TranslationKey::add($request, $response);
        }
        echo json_encode($response);
    }

    /**
     * This function renders translation key details view
     * @param type $translationKeyID
     * @return type view
     */
    public function show($translationKeyID) {
        if (TranslationKey::findOrFail($translationKeyID)) {
            $arrStatus = TranslationKey::getENUMStatus();
            $arrTranslationKeyDetails = TranslationKey::find($translationKeyID);
            return view('translationKey.show', compact('arrTranslationKeyDetails', 'arrStatus'));
        }
    }

    /**
     * This function updates translation key details
     * @param Request $request
     * @return type JSON
     */
    public function update(Request $request) {
        $response = new stdClass();
         if (TranslationKey::where('name', $request->get('name'))->where('translationKeyID', '!=', $request->get('translationKeyID'))->exists()) {
            $response->statusTranslationKeyName = "EXIST";
            $response->messageTranslationKeyNameExist = "Key already exists.";
        }

        if (empty((array) $response)) {
            $translationKeyObj = TranslationKey::find($request->input('translationKeyID'));
            if ($translationKeyObj) {
                $response = TranslationKey::updateDetails($translationKeyObj, $request, $response);
            } else {
                $response->status = "ERROR";
                $response->message = "Error occurred.";
            }
        }
        echo json_encode($response);
    }

    
    /**
     * This function mark the translation key as deleted 
     * @param Request $request
     * @return type JSON
     */
    public function destroy(Request $request) {
        $response = new stdClass();
        $response->status = "ERROR";
        $response->message = "Error occurred.";

        $keyObj = TranslationKey::find($request->input('keyID'));

        if ($keyObj) {
            $response = TranslationKey::markAsDeleted($keyObj, $response);
        }
        echo json_encode($response);
    }

}
