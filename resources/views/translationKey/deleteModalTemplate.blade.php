
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-10 offset-md-1" style='text-align: center'>
                    <h5 class="modal-title" id="exampleModalLabel">Delete language</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="col-12" align='center' style='margin-bottom:16px;'>
                            <legend class="font-weight-semibold"><i class="icon-user-check mr-2"></i> Confirm delete</legend>
                        </div>
                         <div class="col-12" align='center' >
                           Are you sure you want to delete the key <strong><span id="spanName"></span></strong>.
                        </div>   
                    </div> 
                </div> 
                <form action="#" id="frmKey" data-parsley-validate="" data-keyid="" data-keyname=""></form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="button" class="btn bg-teal btn-ladda btn-ladda-spinner" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" id='btnDelete'>
                    <span class="ladda-label">Confirm <i class="icon-paperplane ml-2"></i></span>
                </button>
            </div>
        </div>
    </div>
</div>