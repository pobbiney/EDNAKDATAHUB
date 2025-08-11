<div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Issue Certificate </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" enctype="multipart/form-data" autocomplete="off" action="{{ route('add-issue-cert-process') }}">
                @csrf
                    
                              
                              <div class="modal-body">
                                 <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label ><strong>Company Name </strong></label>
                                          <span id="companyName"></span>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label ><strong>Applicant's Name </strong></label>
                                          <span id="applicantName"></span>
                                      </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label ><strong>Telephone </strong></label>
                                        <span id="telephone"></span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label ><strong>City </strong></label>
                                        <span id="cityName"></span>
                                    </div>
                                  </div>
                                 </div>
                               
                               <hr>
                               <div class="row">
                                  <div class="form-group">
                                      <label >Name of Person Interviewed</label>
                                      <input type="text" name="name" class="form-control" placeholder="Enter Name of Person">
                                      @error('name')<small class="text-danger">{{$message}}</small> @enderror
                                  </div>
                               </div>
                               <div class="row">
                                  <div class="form-group">
                                      <label >Telephone Number</label>
                                      <input type="number" name="telephone" class="form-control" placeholder="Enter Telephone Number">
                                      @error('telephone')<small class="text-danger">{{$message}}</small> @enderror
                                  </div>
                               </div>
                               <div class="row">
                                  <div class="form-group">
                                      <label >Email</label>
                                      <input type="text" name="email" class="form-control" placeholder="Enter Email Address">
                                      @error('email')<small class="text-danger">{{$message}}</small> @enderror
                                  </div>
                               </div>
                               <div class="row">
                                  <div class="form-group">
                                      <label >Address</label>
                                      <textarea class="form-control" name="address"></textarea>
                                      @error('address')<small class="text-danger">{{$message}}</small> @enderror
                                  </div>
                               </div>
                                  
                                  
                                  <input type="hidden" name="certID" id="certID"/>
                                  <input type="hidden" name="region_id" id="regionName"/>
                 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="margin-left: 10px">Issue Certificate</button>
                    </div>
                </div>
            
            </form>
        </div>
    </div>
</div>