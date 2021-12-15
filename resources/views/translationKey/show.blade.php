@extends('layouts.page')
@section('content')
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Key</span> Edit</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
         <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <a href="/translationKeys" class="btn btn-link btn-float text-default"><i class="icon-grid6 text-primary"></i><span>View all keys</span></a>
            </div>
        </div>
    </div>
</div>
<div class="content">   
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title"></h6>
        </div>
        <div class="card-body">
            <form action="#"  id="frmTranslationKey" data-parsley-validate=""  data-translationkeyid ='{{$arrTranslationKeyDetails->translationKeyID}}'>
                <div class="row">
                    <div class="col-md-10">
                           @include('translationKey.keyForm')
                    </div>
                </div>
            </form>  
            <div class="text-right">
                <button type="button" class="btn bg-teal btn-ladda btn-ladda-spinner" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" id='btnUpdate'>
                    <span class="ladda-label">Save <i class="icon-download7 ml-2"></i></span>
                </button>
            </div>
        </div>

    </div>
</div>
@endsection

@section('stylesheet')
<link rel="stylesheet" href="/js/sweetAlert2/sweetalert2.min.css">
@endsection

@section('javascript')
<script src="/js/plugins/buttons/spin.min.js"></script>
<script src="/js/plugins/buttons/ladda.min.js"></script>
<script src="/js/demo_pages/components_buttons.js"></script>
<script src="/js/plugins/forms/selects/select2.min.js"></script>
<script src="/js/demo_pages/form_select2.js"></script>
<script src="/js/plugins/forms/styling/uniform.min.js"></script>
<script src="/js/plugins/forms/styling/switch.min.js"></script>
<script src="/js/demo_pages/form_checkboxes_radios.js"></script>
<script src="/js/parsley/parsley.min.js"></script>
<script src="/js/sweetAlert2/sweetalert2.min.js"></script>
<script src="/js/modules/translationKey/update.js"></script>
@endsection



