<div class="modal fade" id="basicModal2" tabindex="-1" aria-hidden="true">
  <form method="post" enctype="multipart/form-data" autocomplete="off" action="{{route('edit-agent-packages-process')}}">
    @csrf
        <div class="modal-dialog" role="document">
           <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel1">Update Packages</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
                    <div class="modal-body">
                        <div class="row g-4">
                            <div class="col mb-0">
                                    <label for="nameBasic" class="form-label"><b>Name :</b></label>
                                    <span id="prov_Name"></span> 
                            </div>
                            
                        </div><hr/>
                        
                        
                        <div class="mb-3">
                            <label for="emailBasic" class="form-label"><b>Package Name</b></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Package Name" id="pack_name">
                            @error('name') <small style="color:red"> {{ $message}}</small> @enderror
                            
                        </div>
                        <div class="mb-3">
                            <label for="emailBasic" class="form-label"><b>Amount</b></label>
                            <input type="number" name="amount" class="form-control" placeholder="Enter Amount " id="pack_amount">
                            @error('amount') <small style="color:red"> {{ $message}}</small> @enderror
                            
                        </div>
                        <input type="hidden" name="providers_id" id="Prover_ID"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
            </div>
        </div>    
    </form>
</div>
      
