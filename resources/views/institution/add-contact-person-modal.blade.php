<div class="modal fade" id="basicModal2" tabindex="-1" aria-hidden="true">
  <form method="post" enctype="multipart/form-data" autocomplete="off" action="{{route('add-contact-person-process')}}">
    @csrf
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel1">Add Contact Person</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              
                <div class="modal-body">
                      <div class="row g-4">
                          <div class="col mb-0">
                                <label for="nameBasic" class="form-label"><b>Name :</b></label>
                                <span id="inst_name2"></span> 
                          </div>
                          <div class="col mb-0">
                                <label for="nameBasic" class="form-label"><b>Email  :</b></label>
                                <span id="inst_email2"></span> 
                          </div>
                      </div><hr/>
                      <div class="row g-4" style="margin-top:5px ">
                          <div class="col mb-0">
                          <label for="emailBasic" class="form-label"><b>Location</b></label>
                          <span id="inst_loc2"></span> 
                          </div>
                          <div class="col mb-0">
                          <label for="dobBasic" class="form-label"><b>Phone</b></label>
                          <span id="inst_tel2"></span> 
                          </div>
                      </div><hr/>
                      
                       <div class="mb-3">
                          <label for="emailBasic" class="form-label"><b>Surname</b></label>
                          <input type="text" name="surname" class="form-control" placeholder="Enter Surname"/>
                           @error('surname') <small style="color:red"> {{ $message}}</small> @enderror
                      </div>
                      <div class="mb-3">
                          <label for="emailBasic" class="form-label"><b>First Name</b></label>
                          <input type="text" name="firstname" class="form-control" placeholder="Enter Firstname"/>
                           @error('firstname') <small style="color:red"> {{ $message}}</small> @enderror
                      </div>
                       <div class="mb-3">
                          <label for="emailBasic" class="form-label"><b>Designation</b></label>
                          <input type="text" name="designation" class="form-control" placeholder="Enter Designation"/>
                           @error('designation') <small style="color:red"> {{ $message}}</small> @enderror
                      </div>
                      <div class="mb-3">
                          <label for="emailBasic" class="form-label"><b>Email</b></label>
                          <input type="text" name="email" class="form-control" placeholder="Enter Email"/>
                           @error('email') <small style="color:red"> {{ $message}}</small> @enderror
                      </div>
                       <div class="mb-3">
                          <label for="emailBasic" class="form-label"><b>Telephone</b></label>
                          <input type="number" name="telephone" class="form-control" placeholder="Enter Telephone"/>
                           @error('telephone') <small style="color:red"> {{ $message}}</small> @enderror
                      </div>
                      <input type="hidden" name="institution_id" id="InstID2"/>
                </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
          </div>
          </div>
          </div>
          </div>
        </div>
    </form>
</div>
      
