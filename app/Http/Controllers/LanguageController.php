<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;
use function GuzzleHttp\json_encode;
use function view;

class LanguageController extends Controller {

    /**
     * This function renders the view list of all languages 
     * @return type view
     */
    public function index() {
        $arrAlign = Language::getENUMAlign();
        $arrAllLanguages = Language::readAll();
        return view('language.index', compact('arrAlign', 'arrAllLanguages'));
    }

    /**
     * This function stores the new language details in system
     * @param type $request
     * @return type $response object
     */
    public function store(Request $request) {
        $response = new stdClass();
        if (Language::where('name', $request->get('name'))->exists()) {
            $response->statusName = "EXIST";
            $response->messageNameExist = "Language Name already exists.";
        }
        if (Language::where('iso', $request->get('iso'))->exists()) {
            $response->statusIso = "EXIST";
            $response->messageIsoExist = "Language iso already exists.";
        }
        if (empty((array) $response)) {
            $response = Language::add($request, $response);
        }
        echo json_encode($response);
    }

    /**
     * This function renders language details view
     * @param type $languageID
     * @return type view
     */
    public function show($languageID) {
        if (Language::findOrFail($languageID)) {
            $arrStatus = Language::getENUMStatus();
            $arrAlign = Language::getENUMAlign();
            $arrLanguageDetails = Language::find($languageID);
            return view('language.show', compact('arrLanguageDetails', 'arrStatus', 'arrAlign'));
        }
    }

    /**
     * This function updates language details
     * @param Request $request
     * @return type JSON
     */
    public function update(Request $request) {
        $response = new stdClass();
        if (Language::where('name', $request->get('name'))->where('languageID', '!=', $request->get('languageID'))->exists()) {
            $response->statusName = "EXIST";
            $response->messageNameExist = "Language Name already exists.";
        }
        if (Language::where('iso', $request->get('iso'))->where('languageID', '!=', $request->get('languageID'))->exists()) {
            $response->statusIso = "EXIST";
            $response->messageIsoExist = "Language iso already exists.";
        }

        if (empty((array) $response)) {
            $languageObj = Language::find($request->input('languageID'));
            if ($languageObj) {
                $response = Language::updateDetails($languageObj, $request, $response);
            } else {
                $response->status = "ERROR";
                $response->message = "Error occurred.";
            }
        }
        echo json_encode($response);
    }

    /**
     * This function mark the language as deleted 
     * @param Request $request
     * @return type JSON
     */
    public function destroy(Request $request) {
        $response = new stdClass();
        $response->status = "ERROR";
        $response->message = "Error occurred.";

        $languageObj = Language::find($request->input('languageID'));

        if ($languageObj) {
            $response = Language::markAsDeleted($languageObj, $response);
        }
        echo json_encode($response);
    }

}
