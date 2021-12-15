@extends('layouts.page')
@section('content')
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Language</span> List</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <div class="text-right">
                    <button type="button" class="btn bg-primary" id="btnOpenAddNewModal" data-toggle="modal" data-target="#addNewModal"><span>Add new language</span> <i class="icon-play3 ml-2"></i></button>
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
                        <th>Language ID</th>
                        <th>Name</th>
                        <th>ISO</th>
                        <th>Align</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty(@arrAllLanguages)) 
                    @foreach($arrAllLanguages as $key => $language)
                    <tr data-languageid="{{$language->languageID}}" data-languagename="{{$language->name}}"> 
                        <td>{{$language->languageID}}</td>
                        <td>{{$language->name}}</td>
                        <td>{{$language->iso}}</td>
                        <td>{{$language->align}}</td>
                        <td>{{$language->createdAt}}</td>
                        <td>
                            @if($language->status ==="ACTIVE") 
                            <span class="badge bg-success">{{$language->status}}</span>
                            @endif
                            @if($language->status ==="DELETED") 
                            <span class="badge bg-danger">{{$language->status}}</span>
                            @endif 
                            @if($language->status ==="INACTIVE") 
                            <span class="badge bg-primary">{{$language->status}}</span>
                            @endif 
                        </td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="/language/show/{{$language->languageID}}" class="dropdown-item text-primary-600"><i class="icon-pencil7"></i>View</a>
                                        @if($language->status ==="ACTIVE") 
                                        <a href="#" class="dropdown-item text-danger-600" data-toggle="modal" data-target="#deleteModal" id="btnOpenDeleteModal"><i class="icon-trash"></i>Delete</a>
                                        @endif 
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
    @include('language.addNewModalTemplate')
    @include('language.deleteModalTemplate')
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
<script src="/js/modules/language/index.js"></script>
@endsection



