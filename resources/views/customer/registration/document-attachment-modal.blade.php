<div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Attach Drawings</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" autocomplete="off" action="{{ route('customer-application-attach-drawings-get-forms-process') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                        <p align="center" style="display: none; color: limegreen;" id="wait"><img src="{{ asset('images/spinner-grey.gif')}}" > fetching information, please wait ....</p>
                        <br>

                        <div class="table-responsive">
                        <div id="listRecords"></div>
                        </div>
                        <input type="hidden" name="formID" id="formID">   
                    
                 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="margin-left: 10px">Upload Document</button>
                    </div>
                </div>
            
            </form>
        </div>
    </div>
</div>