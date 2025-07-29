<?php

namespace App\Http\Controllers\ApplicationManager;

use App\Http\Controllers\Controller;
use App\Models\Accessroute;
use App\Models\Alarmandwarning;
use App\Models\Applicationaccessroute;
use App\Models\Applicationfirefighting;
use App\Models\Applicationform;
use App\Models\Applicationmeansofescape;
use App\Models\Applicationwarningdevice;
use App\Models\Buildingtype;
use App\Models\Businessclass;
use App\Models\Businesstype;
use App\Models\CertificateApp;
use App\Models\ConstructionType;
use App\Models\District;
use App\Models\Drawing;
use App\Models\Drawingupload;
use App\Models\Firefighting;
use App\Models\Formsale;
use App\Models\Meansofescape;
use App\Models\PermitApp;
use App\Models\Region;
use App\Models\Tracker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ApplicationManagerController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth'];
    }

    public function completeApplicationFormsView (){

        return view ('application-manager.complete-application-form');
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

            $table .= '<table id="example" class="table table-striped table-bordered">';
    
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
                    $table .= '<td><a target="_blank" href="'.route('application-edit-certificate-forms',Crypt::encrypt($item->id)).'" class="btn btn-success btn-sm">Edit</a></td>';
                    } else {
                        $table .= '<td><a target="_blank" href="'.route('application-open-certificate-forms',Crypt::encrypt($item->id)).'" class="btn btn-success btn-sm">Open</a></td>';
                    }
                }elseif($item->formType == 2){

                     if ($item->hasPermitRecords() == true) {
                            $table .= '<td><a target="_blank" href="'.route('application-edit-permit-forms',Crypt::encrypt($item->id)).'" class="btn btn-success btn-sm">Edit</a></td>';
                        } else {
                            $table .= '<td><a target="_blank" href="'.route('application-open-permit-forms',Crypt::encrypt($item->id)).'" class="btn btn-success btn-sm">Open</a></td>';
                        }

                }else{
                    if ($item->hasRecords() == true) {
                    $table .= '<td><a target="_blank" href="'.route('application-edit-certificate-forms',Crypt::encrypt($item->id)).'" class="btn btn-success btn-sm">Edit</a></td>';
                    } else {
                        $table .= '<td><a target="_blank" href="'.route('application-open-certificate-forms',Crypt::encrypt($item->id)).'" class="btn btn-success btn-sm">Open</a></td>';
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

    public function openCertificateForm($id){

        $decodeID = Crypt::decrypt($id);

        $data = Formsale::find($decodeID);

        $regionsList = Region::orderBy('name','ASC')->get();
        $districtList = District::orderBy('name','ASC')->get();
        $businessClassList = Businessclass::orderBy('name','ASC')->get();
        $buainessTypeList = Businesstype::orderBy('name','ASC')->get();
        $constructionTypeList = ConstructionType::orderBy('name','ASC')->get();
        $buildingTypeList = Buildingtype::orderBy('name','ASC')->get();
        $meanOfEscapeList = Meansofescape::orderBy('name','ASC')->get();
        $fireFighthingList = Firefighting::orderBy('name','ASC')->get();
        $alarmAndWarningList = Alarmandwarning::orderBy('name','ASC')->get();
        $accessRouteList = Accessroute::orderBy('name','ASC')->get();
        $applicationFormType = Applicationform::orderBy('formName','ASC')->get();

        return view('application-manager.certificate-application',[
            'data' => $data,
            'regionsList' => $regionsList,
            'districtList' => $districtList,
            'businessClassList' => $businessClassList,
            'buainessTypeList' => $buainessTypeList,
            'constructionTypeList' => $constructionTypeList,
            'buildingTypeList' => $buildingTypeList,
            'meanOfEscapeList' => $meanOfEscapeList,
            'fireFighthingList' => $fireFighthingList,
            'alarmAndWarningList' => $alarmAndWarningList,
            'accessRouteList' => $accessRouteList,
            'applicationFormType' => $applicationFormType
        ]);
    }

    public function addCertificateApplication(Request $request){


        $insertCert = new CertificateApp();
        $insertCert->firstname = $request->fname;
        $insertCert->surname = $request->sname;
        if(isset($request->oname)){
            $insertCert->othername = $request->oname;
        }
        $insertCert->plotNo = $request->pnumber;
        if(isset($request->location)){
            $insertCert->location = $request->location;
        }
        $insertCert->companyName = $request->companyName;
        $insertCert->businessType = $request->businessType;
        $insertCert->businessClass = $request->businessClass;
        if(isset($request->city)){
            $insertCert->city = $request->city;
        }
        $insertCert->region = $request->region_id;
        $insertCert->district = $request->district_id;
        if(isset($request->postalAddress)){
            $insertCert->address = $request->postalAddress;
        }
        if(isset($request->mobile)){
            $insertCert->mobile = $request->mobile;
        }
        if(isset($request->tel)){
            $insertCert->tel = $request->tel;
        }
        if(isset($request->email)){
            $insertCert->email = $request->email;
        }
        $insertCert->constType = $request->constructionType;
        $insertCert->buildType = $request->buildingType;
        $insertCert->buildingType = $request->buildingType;
        $insertCert->noFloor = $request->floor;
        if(isset($request->previous_use)){
            $insertCert->previousUse = $request->previous_use;
        }
        if(isset($request->occupants_no)){
            $insertCert->noOccupants = $request->occupants_no;
        }
        if(isset($request->current_use)){
            $insertCert->currentUse = $request->current_use;
        }
        if(isset($request->proposed_use)){
            $insertCert->proposedUse = $request->proposed_use;
        }
        $dob =$request->dob_yr . "-" . $request->dob_mon . "-" .$request->dob_day;

        $insertCert->constructionDate = date("Y-m-d h:i:s",strtotime($dob));
        $insertCert->status = 'pendingProcessing';
        $insertCert->createdOn = Carbon::now();
        $insertCert->formId = $request->formId;
        $insertCert->createdBy = Auth::User()->id;

        $insertTracker = new Tracker();
        $insertTracker->formID = $request->formId;
        $insertTracker->activity = '1';
       // $insertTracker->activity_type = 'certificateApplication';
        $insertTracker->activity_type = '1';
        $insertTracker->regionId = $request->region_id;
        $insertTracker->createdOn = Carbon::now();
        $insertTracker->createdBy = Auth::User()->id;

        $insertCert->formType = $request->cert_type;
        $insertCert->certificate_number = $request->cert_no;
        $insertCert->date_issue = $request->issue_date;

        $insertTracker->save();


        $status = $insertCert->save();

        if($status){

            $this->setupMeansOfEscape($request['means_escape'],$request['meansEscapeType'],$insertCert->id);
            $this->setupWarningDevices($request['warning_device'],$request['warningDeviceType'],$insertCert->id);
            $this->setupFireFighting($request['fire_fighting'],$request['fireFightingType'],$insertCert->id);
            $this->setUpAccessRoute($request['access_route'],$request['accessRouteType'],$insertCert->id);

            return 1;

        }else{

            return 0;


        }
        

    }


    private function setupMeansOfEscape($meansOfEscape,$meansType, $appId){
        Applicationmeansofescape::where('appId',$appId)->delete();
        for ($x= 0; $x<sizeof($meansOfEscape); $x++){
           
                if(isset($meansOfEscape[$x])){
                $insetRecord = new Applicationmeansofescape();
                $insetRecord->meansOfEscapeId =$meansOfEscape[$x];
                $insetRecord->appId =$appId;
                $insetRecord->createdOn =Carbon::now();
                $insetRecord->createdBy = Auth::User()->id;
                $insetRecord->save();

            }
        }
    }

    private function setupFireFighting($meansOfEscape,$meansType, $appId){
       Applicationfirefighting::where('appId',$appId)->delete();
        for ($x= 0; $x<sizeof($meansOfEscape); $x++){
            if(isset($meansOfEscape[$x])){
                $insetRecordTwo = new Applicationfirefighting();
                $insetRecordTwo->fireFightingId =$meansOfEscape[$x];
                $insetRecordTwo->appId =$appId;
                $insetRecordTwo->createdOn =Carbon::now();
                $insetRecordTwo->createdBy = Auth::User()->id;
                $insetRecordTwo->save();

           }
        }
    }

    private function setUpAccessRoute($meansOfEscape,$meansType, $appId){
        Applicationaccessroute::where('appId',$appId)->delete();
        for ($x= 0; $x<sizeof($meansOfEscape); $x++){
            if(isset($meansOfEscape[$x])){
                $insetRecordThree = new Applicationaccessroute();
                $insetRecordThree->accessRouteId =$meansOfEscape[$x];
                $insetRecordThree->appId =$appId;
                $insetRecordThree->createdOn =Carbon::now();
                $insetRecordThree->createdBy = Auth::User()->id;
                $insetRecordThree->save();

            }
        }
    }

    private function setupWarningDevices($meansOfEscape,$meansType, $appId){
        Applicationwarningdevice::where('appId',$appId)->delete();
        for ($x= 0; $x<sizeof($meansOfEscape); $x++){
            if(isset($meansOfEscape[$x])){
                $insetRecordFour = new Applicationwarningdevice();
                $insetRecordFour->warningDeviceId =$meansOfEscape[$x];
                $insetRecordFour->appId =$appId;
                $insetRecordFour->createdOn =Carbon::now();
                $insetRecordFour->createdBy = Auth::User()->id;
                $insetRecordFour->save();

            }
        }
    }

    public function editCertificateForm($id){

        $decodeID = Crypt::decrypt($id);

        $data = Formsale::find($decodeID);

    

        $certificateData = CertificateApp::where('formId',$data->id)->orderBy('id','DESC')->limit(1)->get()[0];

        $regionsList = Region::orderBy('name','ASC')->get();
        $districtList = District::orderBy('name','ASC')->get();
        $businessClassList = Businessclass::orderBy('name','ASC')->get();
        $buainessTypeList = Businesstype::orderBy('name','ASC')->get();
        $constructionTypeList = ConstructionType::orderBy('name','ASC')->get();
        $buildingTypeList = Buildingtype::orderBy('name','ASC')->get();
        $meanOfEscapeList = Meansofescape::orderBy('name','ASC')->get();
        $fireFighthingList = Firefighting::orderBy('name','ASC')->get();
        $alarmAndWarningList = Alarmandwarning::orderBy('name','ASC')->get();
        $accessRouteList = Accessroute::orderBy('name','ASC')->get();
        $applicationFormType = Applicationform::orderBy('formName','ASC')->get();

        return view('application-manager.edit-certificate-application',[
            'data' => $data,
            'regionsList' => $regionsList,
            'districtList' => $districtList,
            'businessClassList' => $businessClassList,
            'buainessTypeList' => $buainessTypeList,
            'constructionTypeList' => $constructionTypeList,
            'buildingTypeList' => $buildingTypeList,
            'meanOfEscapeList' => $meanOfEscapeList,
            'fireFighthingList' => $fireFighthingList,
            'alarmAndWarningList' => $alarmAndWarningList,
            'accessRouteList' => $accessRouteList,
            'certificateData' => $certificateData,
            'applicationFormType' => $applicationFormType
        ]);
    }


    public function updateCertificateApplication(Request $request){


        $insertCert = CertificateApp::find($request->idUpdate);
        $insertCert->firstname = $request->fname;
        $insertCert->surname = $request->sname;
        if(isset($request->oname)){
            $insertCert->othername = $request->oname;
        }
        $insertCert->plotNo = $request->pnumber;
        if(isset($request->location)){
            $insertCert->location = $request->location;
        }
        $insertCert->companyName = $request->companyName;
        $insertCert->businessType = $request->businessType;
        $insertCert->businessClass = $request->businessClass;
        if(isset($request->city)){
            $insertCert->city = $request->city;
        }
        $insertCert->region = $request->region_id;
        $insertCert->district = $request->district_id;
        if(isset($request->postalAddress)){
            $insertCert->address = $request->postalAddress;
        }
        if(isset($request->mobile)){
            $insertCert->mobile = $request->mobile;
        }
        if(isset($request->tel)){
            $insertCert->tel = $request->tel;
        }
        if(isset($request->email)){
            $insertCert->email = $request->email;
        }
        $insertCert->constType = $request->constructionType;
        $insertCert->buildType = $request->buildingType;
        $insertCert->buildingType = $request->buildingType;
        $insertCert->noFloor = $request->floor;
        if(isset($request->previous_use)){
            $insertCert->previousUse = $request->previous_use;
        }
        if(isset($request->occupants_no)){
            $insertCert->noOccupants = $request->occupants_no;
        }
        if(isset($request->current_use)){
            $insertCert->currentUse = $request->current_use;
        }
        if(isset($request->proposed_use)){
            $insertCert->proposedUse = $request->proposed_use;
        }
        $dob =$request->dob_yr . "-" . $request->dob_mon . "-" .$request->dob_day;

        $insertCert->constructionDate = date("Y-m-d h:i:s",strtotime($dob));
        $insertCert->updatedOn = Carbon::now();
        $insertCert->formId = $request->formId;
        $insertCert->updatedBy = Auth::User()->id;

        $insertCert->formType = $request->cert_type;
        $insertCert->certificate_number = $request->cert_no;
        $insertCert->date_issue = $request->issue_date;


        $status = $insertCert->update();

        if($status){

            $this->setupMeansOfEscape($request['means_escape'],$request['meansEscapeType'],$request->idUpdate);
            $this->setupWarningDevices($request['warning_device'],$request['warningDeviceType'],$request->idUpdate);
            $this->setupFireFighting($request['fire_fighting'],$request['fireFightingType'],$request->idUpdate);
            $this->setUpAccessRoute($request['access_route'],$request['accessRouteType'],$request->idUpdate);

            return 1;

        }else{

            return 0;


        }
        

    }

    public function attachDrawingsList (){

        $formList = Formsale::where('regionId',Auth::User()->region_id)->get();

        return view ('application-manager.attach-drawings',[
            'formList' => $formList
        ]);

    }

    public function getAttachDrawingForms (Request $request){

        $listDrawings = Drawing::get();

        $tableOne = '';

         $tableOne .= '<table class="table table-striped table-bordered">';
         
         foreach ($listDrawings as $key) {

            $tableOne .= '<tr>';

             $tableOne .= '<td>'.$key->name.'</td>';
             $tableOne .= '<td><input type="file" class="form-control" name="drawings'.$key->id.'"></td>';

             $tableOne .= '</tr>';
            
         }



         $tableOne .= '</table>';


          return $tableOne;

    }

    public function uploadAttachDrawingsProcess (Request $request){

        $listDrawings = Drawing::get();
        $documentCode = substr(rand(0,time()),0,9);

        $listCount = 0;

        foreach ($listDrawings as $key) {

            if(!empty($request["drawings".$key->id])){

               $listCount++; 

            }
            
        }

        if($listCount <= 0){


            return back()->with('message_error','No documents detected. Please upload at least one to proceed.');
        }

        $baseUrl = url('/').'/public/';

         foreach ($listDrawings as $keyTwo) {
            

            if($request->has("drawings".$keyTwo->id)){

            $docsName = 'drawingsUpload/'.$documentCode.'-drawings-'.time().rand(1,1000).'.'.$request->file('drawings'.$keyTwo->id)->extension();
            $request->file("drawings".$keyTwo->id)->move(public_path('drawingsUpload'),$docsName);

            $insertDrawings = new Drawingupload();
            $insertDrawings->path = $baseUrl.$docsName;
            $insertDrawings->uploadType = 'certificateApplication';
            $insertDrawings->drawingType = $keyTwo->id;
            $insertDrawings->createdOn =  Carbon::now();
            $insertDrawings->createdBy = Auth::User()->id;
            $insertDrawings->appId = $request->formID;
            $status = $insertDrawings->save();

            }

        }

        return $status ? back()->with('message_success','Document uploaded successfully') : back()->with('message_error','Something went wrong, please try again.'); 


    }


        public function getDistricts (Request $request){

        $result = "";

        $district = District::where('region_id',$request->region_id)->orderBy('name')->get();

        $result .= "<option value=''>-- Select Option --</option>";

        foreach ($district as $districtItem) {
            
            $result .= "<option value='".$districtItem->id."'>".$districtItem->name."</option>";  
        }

        return $result;


    }

        public function getBusinessType (Request $request){

        $result = "";

        $district = Businesstype::where('busClassId',$request->busClassId)->orderBy('name')->get();

        $result .= "<option value=''>-- Select Option --</option>";

        foreach ($district as $districtItem) {
            
            $result .= "<option value='".$districtItem->id."'>".$districtItem->name."</option>";  
        }

        return $result;


    }


    public function openPermitForm($id){

        $decodeID = Crypt::decrypt($id);

        $data = Formsale::find($decodeID);

        $regionsList = Region::orderBy('name','ASC')->get();
        $districtList = District::orderBy('name','ASC')->get();
        $businessClassList = Businessclass::orderBy('name','ASC')->get();
        $buainessTypeList = Businesstype::orderBy('name','ASC')->get();
        $constructionTypeList = ConstructionType::orderBy('name','ASC')->get();
        $buildingTypeList = Buildingtype::orderBy('name','ASC')->get();
        $meanOfEscapeList = Meansofescape::orderBy('name','ASC')->get();
        $fireFighthingList = Firefighting::orderBy('name','ASC')->get();
        $alarmAndWarningList = Alarmandwarning::orderBy('name','ASC')->get();
        $accessRouteList = Accessroute::orderBy('name','ASC')->get();
        $applicationFormType = Applicationform::orderBy('formName','ASC')->get();

        return view('application-manager.permit-application',[
            'data' => $data,
            'regionsList' => $regionsList,
            'districtList' => $districtList,
            'businessClassList' => $businessClassList,
            'buainessTypeList' => $buainessTypeList,
            'constructionTypeList' => $constructionTypeList,
            'buildingTypeList' => $buildingTypeList,
            'meanOfEscapeList' => $meanOfEscapeList,
            'fireFighthingList' => $fireFighthingList,
            'alarmAndWarningList' => $alarmAndWarningList,
            'accessRouteList' => $accessRouteList,
            'applicationFormType' => $applicationFormType
        ]);
    }

       public function addPermitApplication(Request $request){


        $insertCert = new PermitApp();
        $insertCert->firstname = $request->fname;
        $insertCert->surname = $request->sname;
        if(isset($request->oname)){
            $insertCert->othername = $request->oname;
            $insertCert->companyName = $request->oname;
        }
        $insertCert->plotNo = $request->pnumber;
        if(isset($request->location)){
            $insertCert->location = $request->location;
        }
        if(isset($request->city)){
            $insertCert->city = $request->city;
        }
        $insertCert->region = $request->region_id;
        $insertCert->district = $request->district_id;


        $insertCert->businessType = $request->businessType;
        $insertCert->businessClass = $request->businessClass;
        
     
        if(isset($request->postalAddress)){
            $insertCert->address = $request->postalAddress;
        }
        if(isset($request->mobile)){
            $insertCert->mobile = $request->mobile;
        }
        if(isset($request->tel)){
            $insertCert->tel = $request->tel;
        }
        if(isset($request->email)){
            $insertCert->email = $request->email;
        }
      
        $insertCert->buildType = $request->buildingType;
        $insertCert->buildingType = $request->buildingType;
        $insertCert->noFloor = $request->floor;
    
     
        $insertCert->status = 'pendingProcessing';
        $insertCert->createdOn = Carbon::now();
        $insertCert->formId = $request->formId;
        $insertCert->createdBy = Auth::User()->id;

        $insertTracker = new Tracker();
        $insertTracker->formID = $request->formId;
        $insertTracker->activity = '2';
       // $insertTracker->activity_type = 'permitApplication';
        $insertTracker->activity_type = '2';
        $insertTracker->regionId = $request->region_id;
        $insertTracker->createdOn = Carbon::now();
        $insertTracker->createdBy = Auth::User()->id;

        $insertCert->formType = $request->cert_type;
        

        $insertTracker->save();


        $status = $insertCert->save();

        if($status){

            return 1;

        }else{

            return 0;


        }
        

    }


     public function editPermitForm($id){

        $decodeID = Crypt::decrypt($id);

        $data = Formsale::find($decodeID);

        $permitData = PermitApp::where('formId',$data->id)->orderBy('id','DESC')->limit(1)->get()[0];

        $regionsList = Region::orderBy('name','ASC')->get();
        $districtList = District::orderBy('name','ASC')->get();
        $businessClassList = Businessclass::orderBy('name','ASC')->get();
        $buainessTypeList = Businesstype::orderBy('name','ASC')->get();
        $constructionTypeList = ConstructionType::orderBy('name','ASC')->get();
        $buildingTypeList = Buildingtype::orderBy('name','ASC')->get();
        $meanOfEscapeList = Meansofescape::orderBy('name','ASC')->get();
        $fireFighthingList = Firefighting::orderBy('name','ASC')->get();
        $alarmAndWarningList = Alarmandwarning::orderBy('name','ASC')->get();
        $accessRouteList = Accessroute::orderBy('name','ASC')->get();
        $applicationFormType = Applicationform::orderBy('formName','ASC')->get();

        return view('application-manager.edit-permit-application',[
            'data' => $data,
            'regionsList' => $regionsList,
            'districtList' => $districtList,
            'businessClassList' => $businessClassList,
            'buainessTypeList' => $buainessTypeList,
            'constructionTypeList' => $constructionTypeList,
            'buildingTypeList' => $buildingTypeList,
            'meanOfEscapeList' => $meanOfEscapeList,
            'fireFighthingList' => $fireFighthingList,
            'alarmAndWarningList' => $alarmAndWarningList,
            'accessRouteList' => $accessRouteList,
            'permitData' => $permitData,
            'applicationFormType' => $applicationFormType
        ]);
    }


           public function updatePermitApplication(Request $request){


        $insertCert =  PermitApp::find($request->idUpdate);;
        $insertCert->firstname = $request->fname;
        $insertCert->surname = $request->sname;
        if(isset($request->oname)){
            $insertCert->othername = $request->oname;
            $insertCert->companyName = $request->oname;
        }
        $insertCert->plotNo = $request->pnumber;
        if(isset($request->location)){
            $insertCert->location = $request->location;
        }
        if(isset($request->city)){
            $insertCert->city = $request->city;
        }
        $insertCert->region = $request->region_id;
        $insertCert->district = $request->district_id;


        $insertCert->businessType = $request->businessType;
        $insertCert->businessClass = $request->businessClass;
        
     
        if(isset($request->postalAddress)){
            $insertCert->address = $request->postalAddress;
        }
        if(isset($request->mobile)){
            $insertCert->mobile = $request->mobile;
        }
        if(isset($request->tel)){
            $insertCert->tel = $request->tel;
        }
        if(isset($request->email)){
            $insertCert->email = $request->email;
        }
      
        $insertCert->buildType = $request->buildingType;
        $insertCert->buildingType = $request->buildingType;
        $insertCert->noFloor = $request->floor;
    
     
        $insertCert->status = 'pendingProcessing';
        $insertCert->updatedOn = Carbon::now();
        $insertCert->updatedBy = Auth::User()->id;

        $insertCert->formType = $request->cert_type;
        
        $status = $insertCert->update();

        if($status){

            return 1;

        }else{

            return 0;


        }
        

    }



}
