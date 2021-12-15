@extends('layouts.page')
@section('content')
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Translation </span> List</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <div class="text-right">
                    <button type="button" class="btn bg-primary" id="btnOpenAddNewModal" data-toggle="modal" data-target="#addNewModal"><span>Add new translation</span> <i class="icon-play3 ml-2"></i></button>
                    <button type="button" class="btn bg-teal btn-ladda btn-ladda-spinner" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" id="btnExport" >
                       <span class="ladda-label">Export <i class="icon-diff-added ml-2"></i></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">   
    <div class="card">
        <div class="card-body">
            <!-- Basic datatable -->    
            <table class="table datatable-basic" id='tblLists' style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Language</th>
                        <th>Key</th>
                        <th>Translation text</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty(@arrAllTranslations)) 
                    @foreach($arrAllTranslations as $key => $translation)
                    <tr data-keyid="{{$translation->translationID}}"> 
                        <td>{{$translation->translationID}}</td>
                        <td>{{$translation->language}}</td>
                        <td>{{$translation->translationKey}}</td>
                        <td>{{$translation->locale}}</td>
                        <td>{{$translation->createdAt}}</td>
                        <td>
                            @if($translation->status ==="ACTIVE") 
                            <span class="badge bg-success">{{$translation->status}}</span>
                            @endif
                            @if($translation->status ==="DELETED") 
                            <span class="badge bg-danger">{{$translation->status}}</span>
                            @endif 
                            @if($translation->status ==="INACTIVE") 
                            <span class="badge bg-primary">{{$translation->status}}</span>
                            @endif 
                        </td>

                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="/translation/show/{{$translation->translationID}}" class="dropdown-item text-primary-600"><i class="icon-pencil7"></i>View</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach   
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <!-- /basic datatable -->
    @include('translation.addNewModalTemplate')
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
<script src="/js/demo_pages/datatables_basic.js"></script>
<script src="/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="/js/parsley/parsley.min.js"></script>
<script src="/js/sweetAlert2/sweetalert2.min.js"></script>
<script src="/js/modules/translation/index.js"></script>
@endsection



