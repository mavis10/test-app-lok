<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="col-12" align='center' style='margin-bottom:16px;'>
            <legend class="font-weight-semibold"><i class="icon-grid6 mr-2"></i> Translation details</legend>
        </div>
        <fieldset>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Language:</label>
                <div class="col-lg-9">
                    <select name="languageID" id="inputLanguage" data-placeholder="Select language" class="form-control select-search form-control-select2">
                        <option></option>
                        @if(!empty(@$arrAllLanguages))
                        @foreach($arrAllLanguages as $key => $language)
                        <option value="{{@$language->languageID}}" {{(isset($arrTranslationDetails->languageID) && $arrTranslationDetails->languageID === $language->languageID)? 'selected': '' }}>{{@$language->name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Key:</label>
                <div class="col-lg-9">
                    <select name="translationKeyID" id="inputTranslationKey" data-placeholder="Select Status" class="form-control select-search form-control-select2">
                        @if(!empty(@$arrAllTranslationKeys))
                        @foreach($arrAllTranslationKeys as $key => $translationKey)
                        <option value="{{@$translationKey->translationKeyID}}" {{(isset($arrTranslationDetails->translationKeyID) && $arrTranslationDetails->translationKeyID === $translationKey->translationKeyID)? 'selected': '' }}>{{@$translationKey->name}}</option>
                        @endforeach
                        @endif
                    </select>
                     <span id="spanTranslationExist" class="parsley-required" style="color: #bf3636;"></span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Locale:</label>
                <div class="col-lg-9">
                    <input  class="form-control" placeholder="locale" id="inputTranslationText" name="locale" 
                           data-parsley-required="true" data-parsley-required-message="Translation locale is required." value='{{isset($arrTranslationDetails->locale)? $arrTranslationDetails->locale: ''}}'>
                   
                </div>
            </div>

            @if(!empty(@$arrStatus))
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Status:</label>
                <div class="col-lg-9">
                    <select name="status" id="inputStatus" data-placeholder="Select Status" class="form-control select-search form-control-select2">
                        @foreach($arrStatus as $key => $status)
                        <option value="{{@$status}}" {{(isset($arrTranslationDetails->status) && $arrTranslationDetails->status === $status)? 'selected': '' }}>{{@$status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endif
        </fieldset>
    </div>
</div>
