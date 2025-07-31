<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Formsale;
use App\Models\PermitRegistration;
use App\Models\ProjectCategory;
use App\Models\ProjectSector;
use App\Models\ProjectType;
use App\Models\Region;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class RegistrationController extends Controller
{
    public function getRegistrationFormView()
    {
        return view('registration.search-form');
    }

     public function searchFomrsProcess (Request $request){
        $field = $request->field;
        $operation = $request->operator;
        $parameter = $request->search_parameter;

        $result = [];

        

        $table = "";

        if($operation == "equal"){
 
            $result = Formsale::where($field,$parameter)->get();
    
           }else{
    
            $result = Formsale::where($field,'LIKE','%'.$parameter.'%')->get();
    
         }


         if(count($result) > 0){

            $table .= '<table id="example" class="table  ">';
    
            $table .= '<thead> <tr> <th>Applicant Name</th> <th>Telephone</th> <th>Form Type</th> <th>Amount</th> <th>Sold On</th> <th>Action</th></tr></thead>';
    
            $table .= '<tbody>';

            foreach ($result as $item) {

                $table .= '<tr>';

                $table .= '<td><b>'.$item->applicantName.'</b></td>';
                $table .= '<td>'.$item->tell.'</td>';
                $table .= '<td>'.$item->formTypeDetails()->formName.'</td>';
                $table .= '<td> GHC '.number_format($item->amountPaid,2).'</td>';
                $table .= '<td>'.$item->createdOn.'</td>';

                if ($item->formType == 1) {

                    if ($item->hasRecords() == true) {
                    $table .= '<td><a target="_blank" href="'.route('application-edit-certificate-forms',Crypt::encrypt($item->id)).'" class="btn btn-success  ">Edit</a></td>';
                    } else {
                        $table .= '<td><a target="_blank" href="'.route('registration-open-permit-forms',Crypt::encrypt($item->id)).'" class="btn btn-success ">Open</a></td>';
                    }
                }elseif($item->formType == 2){

                     if ($item->hasPermitRecords() == true) {
                            $table .= '<td><a target="_blank" href="'.route('application-edit-permit-forms',Crypt::encrypt($item->id)).'" class="btn btn-success  ">Edit</a></td>';
                        } else {
                            $table .= '<td><a target="_blank" href="'.route('registration-open-permit-forms',Crypt::encrypt($item->id)).'" class="btn btn-success  ">Open</a></td>';
                        }

                }else{
                    if ($item->hasRecords() == true) {
                    $table .= '<td><a target="_blank" href="'.route('application-edit-certificate-forms',Crypt::encrypt($item->id)).'" class="btn btn-success  ">Edit</a></td>';
                    } else {
                        $table .= '<td><a target="_blank" href="'.route('application-open-certificate-forms',Crypt::encrypt($item->id)).'" class="btn btn-success  ">Open</a></td>';
                    }
                }

                $table .= '</tr>';

             }
   
            $table .= '</tbody>';
    
            $table .='</table>';
    
            return $table;

         }else{

            return "no_data";
         }

    }

    public function openPermitForm($id)
    {
          $decodeID = Crypt::decrypt($id);

        $data = Formsale::find($decodeID);

        $regionsList = Region::orderBy('name','ASC')->get();
        $districtList = District::orderBy('name','ASC')->get();
      

        return view('registration.permit-registration-form-application',[
            'data' => $data,
            'regionsList' => $regionsList,
            'districtList' => $districtList,
           
        ]);
    }

    public function addPermitApplication(Request $request)
{
      $request->validate([
        'proponent_name' => 'required',
        'email' => 'required|email|email',
        'contact_person' => 'required',
        'city' => 'required',
        'address' => 'required',
        'position' => 'required',
        'contact_number' => 'required',
    ]);

    $insertApp = New PermitRegistration();
    $insertApp->proponent_name = $request->proponent_name;
    $insertApp->contact_person = $request->contact_person;
    $insertApp->city = $request->city;
    $insertApp->email = $request->email;
    $insertApp->address = $request->address;
    $insertApp->position = $request->position;
    $insertApp->contact_number = $request->contact_number;
    $insertApp->formID = $request->application_id;
    $insertApp->registration_step = "Step1";
    $insertApp->save();

      // Store the user ID in session to use in step 2 and 3
    Session::put('incomplete_user_id', $insertApp->id);
   return view('registration.success-message', [
    'redirectUrl' => route('registration.permit-registration-form-project')
]);


}

public function openPermitProjectView()
{
      

        $regionsList = Region::orderBy('name','ASC')->get();
        $data = District::orderBy('name','ASC')->get();
        $sec = ProjectSector::all();
        $catlist = ProjectCategory::all();
        $typelist = ProjectType::all();
        
        return view('registration.permit-registration-form-project',[
            
            'regionsList' => $regionsList,
            'data' => $data,'sec'=>$sec,'catlist'=>$catlist,'typelist'=>$typelist
           
        ]);
}

public function openPermitApplicationView($id)
{
      $decodeID = Crypt::decrypt($id);

        $data = Formsale::find($decodeID);
        $regionsList = Region::orderBy('name','ASC')->get();
        
        return view('registration.permit-registration-form-application',[
            
            'regionsList' => $regionsList,
            'data' => $data,
           
        ]);
}


    public function addPermitProject(Request $request)
{
      $request->validate([
        'project_title' => 'required',
        'plot_number' => 'required',
        'street_name' => 'required',
        'project_description' => 'required',
        'scope' => 'required',
        'gps' => 'required',
        'town' => 'required',
        'region' => 'required',
        'district' => 'required',
        'site_description' => 'required',
        'sector' => 'required',
        'type' => 'required',
        'category' => 'required',
    ]);

    

    $insertApp = PermitRegistration::findOrFail(Session::get('incomplete_user_id'));
    $insertApp->project_title = $request->project_title;
    $insertApp->plot_number = $request->plot_number;
    $insertApp->street_name = $request->street_name;
    $insertApp->project_description = $request->project_description;
    $insertApp->scope = $request->scope;
    $insertApp->gps = $request->gps;
    $insertApp->town = $request->town;
    $insertApp->region = $request->region;
    $insertApp->district = $request->district;
    $insertApp->landmark = $request->landmark;
    $insertApp->land_uses = $request->land_uses;
    $insertApp->site_description = $request->site_description;
    $insertApp->sector_id = $request->sector;
    $insertApp->cat_id = $request->category;
    $insertApp->type_id = $request->type;
    $insertApp->registration_step = "Step2";
    $insertApp->save();

      // Store the user ID in session to use in step 2 and 3
    Session::put('incomplete_user_id', $insertApp->id);
   return view('registration.success-message', [
    'redirectUrl' => route('registration.permit-registration-form-infrastructure')
]);


}

 
public function openPermitInfrastructureView()
{
      

        $regionsList = Region::orderBy('name','ASC')->get();
        $data = District::orderBy('name','ASC')->get();
      

        return view('registration.permit-registration-form-infrastructure',[
            
            'regionsList' => $regionsList,
            'data' => $data,
           
        ]);
}

 public function getStep1Back()
{
    $user = null;

    if (Session::has('incomplete_user_id')) {
        $user = PermitRegistration::find(Session::get('incomplete_user_id'));
        
          $regionsList = Region::orderBy('name','ASC')->get();
        $data = District::orderBy('name','ASC')->get();
    }

    return view('registration.permit-registration-form-app', compact('user','regionsList','data'));
}

public function getStep2Back()
{
    $user = null;

    if (Session::has('incomplete_user_id')) {
        $user = PermitRegistration::find(Session::get('incomplete_user_id'));
          $regionsList = Region::orderBy('name','ASC')->get();
        $data = District::orderBy('name','ASC')->get();
        $sec = ProjectSector::all();
        $catlist = ProjectCategory::all();
        $typelist = ProjectType::all();
        
    }

    return view('registration.permit-registration-form-project', compact('user','regionsList','data','sec','catlist','typelist'));
}

public function getStep3Back()
{
    $user = null;

    if (Session::has('incomplete_user_id')) {
        $user = PermitRegistration::find(Session::get('incomplete_user_id'));
          
    }

    return view('registration.permit-registration-form-infrastructure', compact('user'));
}

    public function addPermitApp(Request $request)
{
      $request->validate([
        'proponent_name' => 'required',
        'email' => 'required|email|email',
        'contact_person' => 'required',
        'city' => 'required',
        'address' => 'required',
        'position' => 'required',
        'contact_number' => 'required',
    ]);

    $insertApp = PermitRegistration::findOrFail(Session::get('incomplete_user_id'));
    $insertApp->proponent_name = $request->proponent_name;
    $insertApp->contact_person = $request->contact_person;
    $insertApp->city = $request->city;
    $insertApp->email = $request->email;
    $insertApp->address = $request->address;
    $insertApp->position = $request->position;
    $insertApp->contact_number = $request->contact_number;
    $insertApp->formID = $request->application_id;
    $insertApp->registration_step = "Step1";
    $insertApp->save();

      // Store the user ID in session to use in step 2 and 3
    Session::put('incomplete_user_id', $insertApp->id);
   return view('registration.success-message', [
    'redirectUrl' => route('registration.permit-registration-form-project')
]);


}

public function addPermitInfrastructure(Request $request){

    $request->validate([
        'structures' => 'required',
        'water' => 'required',
        'power' => 'required',
        'drainage' => 'required',
        'water_body' => 'required',
        'road_access' => 'required',
        
    ]);

    $insertApp = PermitRegistration::findOrFail(Session::get('incomplete_user_id'));
    $insertApp->structures = $request->structures;
    $insertApp->water = $request->water;
    $insertApp->power = $request->power;
    $insertApp->drainage = $request->drainage;
    $insertApp->water_body = $request->water_body;
    $insertApp->road_access = $request->road_access;
    $insertApp->other = $request->other;
    
    $insertApp->registration_step = "Step3";
    $insertApp->save();

      // Store the user ID in session to use in step 2 and 3
    Session::put('incomplete_user_id', $insertApp->id);
   return view('registration.success-message', [
    'redirectUrl' => route('registration.permit-registration-form-declaration')
]);

}

public function openPermitDeclarationView(){
    
      

        return view('registration.permit-registration-form-declaration');
}

public function addDeclaration(Request $request){
    $request->validate([
        'structures' => 'applied_by',
       
        
    ]);

    $insertApp = PermitRegistration::findOrFail(Session::get('incomplete_user_id'));
    $insertApp->applied_by = $request->applied_by;
    $insertApp->declaration = "assigned";
    $insertApp->created_by = Auth::user()->id; 
     
    
    $insertApp->registration_step = "completed";
    $insertApp->save();

      // Store the user ID in session to use in step 2 and 3
    Session::put('incomplete_user_id', $insertApp->id);
   return $insertApp? back()->with('message_success','Application  Completed Successfully'): back()->with('message_error','Something went wrong, please try again.');
}

public function getApplicationView(){

    $listApp = PermitRegistration::all();
    return view('registration.MyApplication',['listApp'=>$listApp]);

}

public function resume($id)
{
    $user = PermitRegistration::findOrFail($id);

    // Store ID in session for multi-step tracking
    Session::put('incomplete_user_id', $user->id);

    // Redirect to next step based on `registration_step`
    switch ($user->registration_step) {
        case 'Step1':
            return redirect()->route('registration.permit-registration-form-project'); // Step 2
        case 'Step2':
            return redirect()->route('registration.permit-registration-form-infrastructure');   // Step 3
        case 'Step3':
            return redirect()->route('registration.permit-registration-form-declaration');        // Review
        default:
            return redirect()->route('registration.permit-registration-form-application'); // Step 1
    }
}

public function openEditPermitApplicationView($id){

    $decodeID = Crypt::decrypt($id);
     
    $data = PermitRegistration::find($decodeID);
    return view('registration.edit-permit-registration-form-application',
    ['data'=>$data,'id'=>$id]);
}

public function editPermitApplication(Request $request, $id)
{
     $decodeID = Crypt::decrypt($id);
    $request->validate([
        'proponent_name' => 'required',
        'email' => 'required|email|email',
        'contact_person' => 'required',
        'city' => 'required',
        'address' => 'required',
        'position' => 'required',
        'contact_number' => 'required',
    ]);

    $insertApp = PermitRegistration::findOrFail($decodeID);
    $insertApp->proponent_name = $request->proponent_name;
    $insertApp->contact_person = $request->contact_person;
    $insertApp->city = $request->city;
    $insertApp->email = $request->email;
    $insertApp->address = $request->address;
    $insertApp->position = $request->position;
    $insertApp->contact_number = $request->contact_number;
   
   
    $insertApp->save();

     
    return view('registration.success-message', [
    'redirectUrl' => route('registration.edit-permit-registration-form-project',Crypt::encrypt($insertApp->id))
]);
}

public function openEditPermitProjectView($id){
    
    $decodeID = Crypt::decrypt($id);
     
    $datas = PermitRegistration::find($decodeID);
    $regionsList  = Region::all();
    $data  = District::all();
    $sec = ProjectSector::all();
    $catlist = ProjectCategory::all();
    $typelist = ProjectType::all();
    
    return view('registration.edit-permit-registration-form-project',
    ['datas'=>$datas,'id'=>$id,'regionsList'=>$regionsList,'data'=>$data,'sec'=>$sec,'catlist'=>$catlist,'typelist'=>$typelist]);
}

public function editPermitProject(Request $request, $id){

     $decodeID = Crypt::decrypt($id);
      $request->validate([
        'project_title' => 'required',
        'plot_number' => 'required',
        'street_name' => 'required',
        'project_description' => 'required',
        'scope' => 'required',
        'gps' => 'required',
        'town' => 'required',
        'region' => 'required',
        'district' => 'required',
        'site_description' => 'required',
        'type' => 'required',
        'sector' => 'required',
        'category' => 'required',
    ]);

    

   $insertApp = PermitRegistration::findOrFail($decodeID);
    $insertApp->project_title = $request->project_title;
    $insertApp->plot_number = $request->plot_number;
    $insertApp->street_name = $request->street_name;
    $insertApp->project_description = $request->project_description;
    $insertApp->scope = $request->scope;
    $insertApp->gps = $request->gps;
    $insertApp->town = $request->town;
    $insertApp->region = $request->region;
    $insertApp->district = $request->district;
    $insertApp->landmark = $request->landmark;
    $insertApp->land_uses = $request->land_uses;
    $insertApp->site_description = $request->site_description;
    $insertApp->sector_id = $request->sector;
    $insertApp->cat_id = $request->category;
    $insertApp->type_id = $request->type;
  
    $insertApp->save();

    
   return view('registration.success-message', [
    'redirectUrl' => route('registration.edit-permit-registration-form-infrastructure',Crypt::encrypt($insertApp->id))
]);

}

public function openEditPermitInfrastructureView($id){
     $decodeID = Crypt::decrypt($id);
     
    $user = PermitRegistration::find($decodeID);
  
    return view('registration.edit-permit-registration-form-infrastructure',
    ['user'=>$user,'id'=>$id ]);
}

public function editInfrastructure(Request $request,$id){
      $decodeID = Crypt::decrypt($id);
     $request->validate([
        'structures' => 'required',
        'water' => 'required',
        'power' => 'required',
        'drainage' => 'required',
        'water_body' => 'required',
        'road_access' => 'required',
        
    ]);

    $insertApp = PermitRegistration::findOrFail($decodeID);
    $insertApp->structures = $request->structures;
    $insertApp->water = $request->water;
    $insertApp->power = $request->power;
    $insertApp->drainage = $request->drainage;
    $insertApp->water_body = $request->water_body;
    $insertApp->road_access = $request->road_access;
    $insertApp->other = $request->other;
   
    $insertApp->save();
 
   return view('registration.success-message', [
    'redirectUrl' => route('registration.edit-permit-registration-form-declaration',Crypt::encrypt($insertApp->id))
]);
}

public function openEditPermitDeclarationView($id){
      $decodeID = Crypt::decrypt($id);
     
    $user = PermitRegistration::find($decodeID);
  
    return view('registration.edit-permit-registration-form-declaration',
    ['user'=>$user,'id'=>$id ]);
}

public function editDeclaration(Request $request,$id)
{
     $decodeID = Crypt::decrypt($id);
       $request->validate([
        'structures' => 'applied_by',
       
        
    ]);

    $insertApp = PermitRegistration::findOrFail($decodeID);
    $insertApp->applied_by = $request->applied_by;
    
    $insertApp->updated_by = Auth::user()->id; 
      
    $insertApp->save();
 
   return $insertApp? back()->with('message_success','Application  updated Successfully'): back()->with('message_error','Something went wrong, please try again.');
}

public function getAttachedDocView(){
    $listApp = PermitRegistration::where('registration_step', 'completed')->get();
    return view('registration.DocumentAttachment',['listApp'=>$listApp]);

}

     /*Get All Categories base on selected sector*/
    public function findProjectTypeyData(Request $request){
  
        $data=ProjectType::select('name','id')->where('category_id',$request->id)->get();
        return response()->json($data);//then sent this data to ajax success
	}

    public function viewApplication($id){
        $decodeID = Crypt::decrypt($id);
        $project = PermitRegistration::find($decodeID);
        return view('registration.view-application',[
            'project' => $project
        ]);
    }
}