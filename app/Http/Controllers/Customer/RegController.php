<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use App\Models\Region;
use App\Models\Drawing;
use App\Models\Tracker;
use App\Models\District;
use App\Models\Formsale;
use App\Models\Screening;
use App\Models\ProjectType;
use App\Models\PermitReview;
use Illuminate\Http\Request;
use App\Models\Drawingupload;
use App\Models\ProjectSector;
use App\Models\ProjectCategory;
use App\Models\PermitRegistration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class RegController extends Controller
{
    public function getApplicationView(){
        if (!Session::has('formsale_id')) {
                return redirect()->route('customer-login');
            }
        $formsale= Formsale::find(Session::get('formsale_id'));

        $listApp = PermitRegistration::where('contact_number',$formsale->tell)->get();
        return view('customer.registration.MyApplication',['listApp'=>$listApp]);

    }

    public function openEditPermitApplicationView($id){

        $decodeID = Crypt::decrypt($id);
        
        $data = PermitRegistration::find($decodeID);
        return view('customer.registration.edit-permit-registration-form-application',
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

        return view('customer.registration.success-message', [
        'redirectUrl' => route('customer.registration.edit-permit-registration-form-project',Crypt::encrypt($insertApp->id))
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
        
        return view('customer.registration.edit-permit-registration-form-project',
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

        
        return view('customer.registration.success-message', [
            'redirectUrl' => route('customer.registration.edit-permit-registration-form-infrastructure',Crypt::encrypt($insertApp->id))
        ]);

    }

    public function openEditPermitInfrastructureView($id){
        $decodeID = Crypt::decrypt($id);
        
        $user = PermitRegistration::find($decodeID);
    
        return view('customer.registration.edit-permit-registration-form-infrastructure',
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
    
    return view('customer.registration.success-message', [
        'redirectUrl' => route('customer.registration.edit-permit-registration-form-declaration',Crypt::encrypt($insertApp->id))
    ]);
    }

    public function openEditPermitDeclarationView($id){
        $decodeID = Crypt::decrypt($id);
        
        $user = PermitRegistration::find($decodeID);
    
        return view('customer.registration.edit-permit-registration-form-declaration',
        ['user'=>$user,'id'=>$id ]);
    }

    public function editDeclaration(Request $request,$id)
    {
        $decodeID = Crypt::decrypt($id);
        $request->validate([
            'applied_by' => 'required',
        
            
        ]);

        $insertApp = PermitRegistration::findOrFail($decodeID);
        $insertApp->applied_by = $request->applied_by;
        
        $insertApp->updated_by = 0; 
        
        $insertApp->save();
    
    return $insertApp? back()->with('message_success','Application  updated Successfully'): back()->with('message_error','Something went wrong, please try again.');
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


    
    public function viewApplication($id){
        $decodeID = Crypt::decrypt($id);
        $project = PermitRegistration::where('formId',$decodeID)->first();
        $listscreen = Screening::where('formId',$decodeID)->first();
         $list = PermitReview::where('formId',$decodeID)->first();
         $documents = Drawingupload::where('appId',$project->id)->get();
        return view('customer.registration.view-application',[
            'project' => $project,'listscreen'=>$listscreen,'list'=>$list,'documents' => $documents
        ]);
    }

    

     public function customerFindProjectTypeyData(Request $request){
  
        $data=ProjectType::select('name','id')->where('category_id',$request->id)->get();
        return response()->json($data);//then sent this data to ajax success
	}

    public function customerFindCategoryData(Request $request){
    
            $data=ProjectCategory::select('name','id')->where('sector_id',$request->id)->get();
            return response()->json($data);//then sent this data to ajax success
        }

    public function customerFindRegionData(Request $request){
    
            $data=District::select('name','id')->where('region_id',$request->id)->get();
            return response()->json($data);//then sent this data to ajax success
        }

    public function openPermitForm($id)
    {
           if (!Session::has('formsale_id')) {
                return redirect()->route('customer-login');
            }
          $decodeID = Crypt::decrypt($id);

        $data = Formsale::find($decodeID);

        $regionsList = Region::orderBy('name','ASC')->get();
        $districtList = District::orderBy('name','ASC')->get();
      

        return view('customer.registration.permit-registration-form-application',[
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

        $data = Formsale::where('id', $request->application_id)->first(); // get first item

        $regionId = $data ? $data->regionId : 0;

        $track = new Tracker();
        $track->formID = $request->application_id;
        $track->activity = "2";
        $track->createdOn =Carbon::now();
        $track->createdBy = 0; 
        $track->activity_type = "1";
        $track->regionId= $regionId;
        $track->save();

        // Store the user ID in session to use in step 2 and 3
        Session::put('incomplete_user_id', $insertApp->id);
            return view('customer.registration.success-message', [
                'redirectUrl' => route('customer-registration.permit-registration-form-project')
            ]);


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

            return view('customer.registration.permit-registration-form-project', compact('user','regionsList','data','sec','catlist','typelist'));
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
            return view('customer.registration.success-message', [
                'redirectUrl' => route('customer-registration.permit-registration-form-project')
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
                return view('customer.registration.success-message', [
                    'redirectUrl' => route('customer-registration.permit-registration-form-infrastructure')
                ]);


        }

        public function openPermitInfrastructureView()
        {
        if (!Session::has('formsale_id')) {
                    return redirect()->route('customer-login');
                }
            $regionsList = Region::orderBy('name','ASC')->get();
            $data = District::orderBy('name','ASC')->get();
        

            return view('customer.registration.permit-registration-form-infrastructure',[
                
                'regionsList' => $regionsList,
                'data' => $data,
            
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
            return view('customer.registration.success-message', [
                'redirectUrl' => route('customer-registration.permit-registration-form-declaration')
            ]);

    }

    public function openPermitDeclarationView(){
        return view('customer.registration.permit-registration-form-declaration');
    }

    public function addDeclaration(Request $request){
        $request->validate([
            'applied_by' => 'required',
        ]);

        $insertApp = PermitRegistration::findOrFail(Session::get('incomplete_user_id'));
        $insertApp->applied_by = $request->applied_by;
        $insertApp->declaration = "assigned";
        $insertApp->created_by = 0; 
        $insertApp->registration_step = "completed";
        $insertApp->save();

    
        // Store the user ID in session to use in step 2 and 3
        Session::put('incomplete_user_id', $insertApp->id);
        return $insertApp? back()->with('message_success','Application  Completed Successfully'): back()->with('message_error','Something went wrong, please try again.');
    }

     public function getStep1Back()
        {
            $user = null;

            if (Session::has('incomplete_user_id')) {
                $user = PermitRegistration::find(Session::get('incomplete_user_id'));
                
                $regionsList = Region::orderBy('name','ASC')->get();
                $data = District::orderBy('name','ASC')->get();
            }

            return view('customer.registration.permit-registration-form-app', compact('user','regionsList','data'));
        }




}
