<div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 600px;">
            <div class="modal-header">
                <div class="col-md-10 offset-md-1" style='text-align: center'>
                    <h5 class="modal-title" id="exampleModalLabel">Add new language</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#"  id="frmLanguage" data-parsley-validate="">
                    @include('language.langaugeForm')
                </form>
            </div> 
            <div class="modal-footer">
                 <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                 <button type="button" class="btn bg-teal btn-ladda btn-ladda-spinner" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" id='btnAddNew'>
                    <span class="ladda-label">Save <i class="icon-diff-added ml-2"></i></span>
                </button>
            </div>
        </div>
    </div>
</div>