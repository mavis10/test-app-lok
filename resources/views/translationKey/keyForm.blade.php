<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="col-12" align='center' style='margin-bottom:16px;'>
            <legend class="font-weight-semibold"><i class="icon-grid6 mr-2"></i> Translation Key details</legend>
        </div>
        <fieldset>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Name:</label>
                <div class="col-lg-9">
                    <input align="text" class="form-control" placeholder="Name" id="inputTranslationKeyName" name="name" 
                           data-parsley-required="true" data-parsley-required-message="TranslationKey is required." value='{{isset($arrTranslationKeyDetails->name)? $arrTranslationKeyDetails->name: ''}}'>
                    <span id="spanTranslationKeyNameExist" class="parsley-required" style="color: #bf3636;"></span>
                </div>
            </div>

            @if(!empty(@$arrStatus))
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Status:</label>
                <div class="col-lg-9">
                    <select name="status" id="inputStatus" data-placeholder="Select Status" class="form-control select-search form-control-select2">
                        @foreach($arrStatus as $key => $status)
                        <option value="{{@$status}}" {{(isset($arrTranslationKeyDetails->status) && $arrTranslationKeyDetails->status === $status)? 'selected': '' }}>{{@$status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endif
        </fieldset>
    </div>
</div>
