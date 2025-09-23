<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" autocomplete="off" action="{{ route('add-permit-change-request-process') }}">
      @csrf
          <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Change Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        
                        <div class="row g-4" style="margin-top:5px ">
                            <div class="col mb-0">
                                <label for="emailBasic" class="form-label"><b>Please make sure all fields are completed.</b></label>
                               <textarea class="form-control" name="change_request" placeholder="Enter Description"></textarea>
                                @error('change_request')<small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <input type="hidden" name="certID" id="certID"/>
                        
                        <div class="modal-footer" style="float: right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Save changes</button>
                        </div>
                    </div>
                    
                </div>
            </div>
    </form>
</div>