 <div class="modal fade" id="myModal">
    <form method="post" enctype="multipart/form-data" autocomplete="off" action="{{ route('add-reassign-permit-task-process') }}">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Reassign Task</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    <h7>Please select make sure all fields are completed.</h7>
                    <div class="row g-4" style="margin-top:5px ">
                        <div class="col mb-0">
                            <label for="emailBasic" class="form-label"><b>Select Assignee</b></label>
                            <select class="form-control" name="staff" >
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
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                    </div>
                    
                    <input type="hidden" name="task_id" id="taskID"/>
                    <input type="hidden" name="permitID" id="appID"/>
                    <input type="hidden" name="region_id" id="regionId"/>
                     <!-- Modal footer -->
                    <div class="modal-footer" style="float: right">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Save changes</button>
                    </div>
                </div>
               
               
            </div>
        </div>   
   </form>
</div>

