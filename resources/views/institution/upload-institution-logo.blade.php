<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
  <form method="post" enctype="multipart/form-data" autocomplete="off" action="{{route('upload-institution-photo-process')}}">
    @csrf
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel1">Upload Institution's  Logo</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              
                <div class="modal-body">
                      <div class="row g-4">
                          <div class="col mb-0">
                                <label for="nameBasic" class="form-label"><b>Name :</b></label>
                                <span id="inst_name"></span> 
                          </div>
                          <div class="col mb-0">
                                <label for="nameBasic" class="form-label"><b>Email  :</b></label>
                                <span id="inst_email"></span> 
                          </div>
                      </div><hr/>
                      <div class="row g-4" style="margin-top:5px ">
                          <div class="col mb-0">
                          <label for="emailBasic" class="form-label"><b>Location</b></label>
                          <span id="inst_loc"></span> 
                          </div>
                          <div class="col mb-0">
                          <label for="dobBasic" class="form-label"><b>Phone</b></label>
                          <span id="inst_tel"></span> 
                          </div>
                      </div><hr/>
                      
                      <div class="row g-4" style="margin-top:5px ">
                          <label for="emailBasic" class="form-label"><b>Photo</b></label>
                          <input type="file" name="logo" class="form-control"/>
                           @error('logo') <small style="color:red"> {{ $message}}</small> @enderror
                          
                      </div>
                      <input type="hidden" name="institution_id" id="InstID"/>
                </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </div>
          </div>
          </div>
          </div>
        </div>
    </form>
</div>
      
