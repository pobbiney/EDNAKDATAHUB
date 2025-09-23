<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" autocomplete="off" action="{{ route('add-permit-task-process') }}">
      @csrf
          <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Assign Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                       <h7>Please select make sure all fields are completed.</h7>
                        <div class="row g-4" style="margin-top:5px ">
                            <div class="col mb-0">
                                <label for="emailBasic" class="form-label"><b>Select Staff</b></label>
                                <select class="form-control" name="staff">
                                    <option value="" selected disabled>--Choose Option--</option>
                                    @foreach($staf as $list)
                                    <option value="{{ $list->staff_id }}" >{{$list->surname.' '.$list->firstname}}</option>
                                    @endforeach
                                </select>
                                @error('staff')<small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="row g-4" style="margin-top:5px ">
                            <div class="col mb-0">
                                <label for="emailBasic" class="form-label"><b>Description</b></label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                            
                        </div>
                       
                        <input type="hidden" name="permitID" id="certID"/>
                        <input type="hidden" name="regionId" id="regID"/>
                        <div class="modal-footer" style="float: right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Save changes</button>
                        </div>
                    </div>
                    
                </div>
            </div>
    </form>
</div>