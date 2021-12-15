<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Translation;
use App\Models\TranslationKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use stdClass;
use ZipArchive;
use function GuzzleHttp\json_encode;
use function public_path;
use function storage_path;
use function view;

class TranslationController extends Controller {

    /**
     * This function renders the view list of all translations
     * @return type view
     */
    public function index() {
        $arrAllLanguages = Language::readAll()->where("status", "=", "ACTIVE");
        $arrAllTranslationKeys = TranslationKey::readAll()->where("status", "=", "ACTIVE");
        $arrAllTranslations = Translation::readAll();

        return view('translation.index', compact('arrAllLanguages', 'arrAllTranslationKeys', 'arrAllTranslations'));
    }

    /**
     * This function stores the new translation details in system
     * @param type $request
     * @return type $response object
     */
    public function store(Request $request) {
        $response = new stdClass();

        if (Translation::where('languageID', $request->get('languageID'))->where('translationKeyID', $request->get('translationKeyID'))->exists()) {
            $response->statusTranslationName = "EXIST";
            $response->messageTranslationExist = "Transation for selected language and key already exists.";
        }

        if (empty((array) $response)) {
            $response = Translation::add($request, $response);
        }
        echo json_encode($response);
    }

    /**
     * This function renders translation details view
     * @param type $translationID
     * @return type view
     */
    public function show($translationID) {
        if (Translation::findOrFail($translationID)) {
            $arrAllLanguages = Language::readAll()->where("status", "=", "ACTIVE");
            $arrAllTranslationKeys = TranslationKey::readAll()->where("status", "=", "ACTIVE");

            $arrStatus = TranslationKey::getENUMStatus();
            $arrTranslationDetails = Translation::readTranslationDetailsOnID($translationID);
            return view('translation.show', compact('arrAllLanguages', 'arrAllTranslationKeys', 'arrTranslationDetails', 'arrStatus'));
        }
    }

    /**
     * This function updates translation details
     * @param Request $request
     * @return type JSON
     */
    public function update(Request $request) {
        $response = new stdClass();
        if (Translation::where('languageID', $request->get('languageID'))->where('translationKeyID', $request->get('translationID'))->where('translationID', '!=', $request->get('translationID'))->exists()) {
            $response->statusTranslationName = "EXIST";
            $response->messageTranslationExist = "Transation for selected language and key already exists.";
        }

        if (empty((array) $response)) {
            $translationObj = Translation::find($request->input('translationID'));
            if ($translationObj) {
                $response = Translation::updateDetails($translationObj, $request, $response);
            } else {
                $response->status = "ERROR";
                $response->message = "Error occurred.";
            }
        }
        echo json_encode($response);
    }

    /**
     * This function mark the translation as deleted 
     * @param Request $request
     * @return type JSON
     */
    public function destroy(Request $request) {
        $response = new stdClass();
        $response->status = "ERROR";
        $response->message = "Error occurred.";

        $keyObj = Translation::find($request->input('keyID'));

        if ($keyObj) {
            $response = Translation::markAsDeleted($keyObj, $response);
        }
        echo json_encode($response);
    }

    /**
     * This function mark the translation as deleted 
     * @param Request $request
     * @return type JSON
     */
    public function export() {
        $arrAllTranslations = Translation::readAll("status", "=", "ACTIVE");

        $arrTranslationPerLang = [];

        foreach ($arrAllTranslations as $translation) {
            $arrTranslationPerLang[$translation->language . "-" . $translation->iso][] = [$translation->translationKey => $translation->locale];
        }

        $folderName = '\export-' . date('d-m-Y-H-i-s');

        Storage::disk('public')->makeDirectory($folderName);

        $path = storage_path('app/public' . $folderName . "/");
        foreach ($arrTranslationPerLang as $key => $translation) {
            $fileName = $key . '.json';
            $json = json_encode($translation);
            file_put_contents($path . $fileName, $json);
        }

        $public_dir = storage_path('app/public');
        $zipFileName = $folderName . '.zip';
        $zip = new ZipArchive();
        if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
            $files = \File::files(storage_path('app/public' . $folderName . "/"));

            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }

            $zip->close();
        }
        
       return response()->download($public_dir."/".$zipFileName);
    }

}
