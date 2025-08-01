<div id="standard-modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Reassign Task</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" enctype="multipart/form-data" autocomplete="off" action="{{ route('add-reassign-task-process') }}">
            @csrf
                <div class="modal-body">
                <h7>Please select make sure all fields are completed.</h7>
                        <div class="row g-4" style="margin-top:5px ">
                            <div class="col mb-0">
                                <label for="emailBasic" class="form-label"><b>Select Staff</b></label>
                                <select class="form-control" name="staff" id="assignee">
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
                    <input type="hidden" name="CertID" id="appID"/>
                    <input type="hidden" name="region_id" id="regionId"/>  
                    
                 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="margin-left: 10px">Assign Task</button>
                    </div>
                </div>
            
            </form>
        </div>
    </div>
</div>