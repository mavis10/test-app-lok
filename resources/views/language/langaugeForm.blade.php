<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="col-12" align='center' style='margin-bottom:16px;'>
            <legend class="font-weight-semibold"><i class="icon-grid6 mr-2"></i> Language details</legend>
        </div>
        <fieldset>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Name:</label>
                <div class="col-lg-9">
                    <input align="text" class="form-control" placeholder="Name" id="inputName" name="name" 
                           data-parsley-required="true" data-parsley-required-message="Language Name is required." value='{{isset($arrLanguageDetails->name)? $arrLanguageDetails->name: ''}}'>
                    <span id="spanNameExist" class="parsley-required" style="color: #bf3636;"></span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label">ISO:</label>
                <div class="col-lg-9">
                    <input align="text" class="form-control" placeholder="ISO" id="inputISO" name="iso" 
                           data-parsley-required="true" data-parsley-required-message="ISO is required." value='{{isset($arrLanguageDetails->iso)? $arrLanguageDetails->iso: ''}}'>
                    <span id="spanIsoExist" class="parsley-required" style="color: #bf3636;"></span>
                </div>
            </div>

            @if(!empty(@$arrAlign))
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Align:</label>
                <div class="col-lg-9">
                    <select name="align" id="inputAlign" data-placeholder="Select align" class="form-control select-search form-control-select2" data-parsley-required="true" data-parsley-required-message="Align is required.">
                        @foreach($arrAlign as $key => $align)
                        <option value="{{$align}}" {{(isset($arrLanguageDetails->align) && $arrLanguageDetails->align === $align)? 'selected': '' }}>{{$align}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endif

            @if(!empty(@$arrStatus))
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Status:</label>
                <div class="col-lg-9">
                    <select name="status" id="inputStatus" data-placeholder="Select Status" class="form-control select-search form-control-select2">
                        @foreach($arrStatus as $key => $status)
                        <option value="{{@$status}}" {{(isset($arrLanguageDetails->status) && $arrLanguageDetails->status === $status)? 'selected': '' }}>{{@$status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endif
        </fieldset>
    </div>
</div>
