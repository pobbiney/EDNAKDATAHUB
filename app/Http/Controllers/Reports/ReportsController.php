<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Applicationform;
use App\Models\AssetAssignment;
use App\Models\Certapproval;
use App\Models\Formsale;
use App\Models\Incident;
use App\Models\IncidentCategory;
use App\Models\IncidentImage;
use App\Models\IncidentReport;
use App\Models\IncidentTask;
use App\Models\IncidentType;
use App\Models\PermitApp;
use App\Models\Permitapproval;
use App\Models\Region;
use App\Models\Station;
use App\Models\Tracker;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ReportsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth'];
    }

    public function salesSatisticReportView (){

        return view('reports.sales-satistics');
    }

    public function salesSatisticReportProcess (Request $request){

        $startdate = new DateTime(date('Y-m-d',strtotime($request->startdate)));
        $enddate = new DateTime(date('Y-m-d',strtotime($request->enddate))); 

        $table = '';

       $formtype = Applicationform::where('status','Active')->get();

        $table .= '<table id="example" class="table table-striped table-bordered">';

        $table .= '<thead>';

        $table .= '<tr>';

        $table .= '<th>Dates</th>';

        foreach ($formtype as $key) {

             $table .= '<th><b>'.$key->formName.'</b></th>';
            
        }

         

        $table .= '</tr>';

        $table .= '</thead>';

         $table .= '<tbody>';

        for ($i=$startdate; $i <= $enddate; $i->modify('+1 day')) { 

           $table .= '<tr>';

           $table .= '<td>'.$i->format('jS F Y').'</td>';

           foreach ($formtype as $keyTwo) {

            $getCount = Formsale::where([['formType',$keyTwo->id],['regionId',Auth::User()->region_id]])->whereDate('createdOn', '=', $i->format('Y-m-d'))->get()->count();

            if($getCount > 0){

                $table .= '<td align="center" style="color:red;"><b>'.$getCount.'<b></td>';

            }else{

                 $table .= '<td align="center">'.$getCount.'</td>';
            }

            
            
           }

           $table .= '</tr>';
            
        }

         $table .= '</tbody>';

        $table .='</table>';


        return $table;

        
    }

    public function salesYearReportProcess (Request $request){

        $table = '';

       $formtype = Applicationform::where('status','Active')->get();

        $table .= '<table id="example" class="table table-striped table-bordered">';

        $table .= '<thead>';

        $table .= '<tr>';

        $table .= '<th>Dates</th>';

        foreach ($formtype as $key) {

             $table .= '<th><b>'.$key->formName.'</b></th>';
            
        }

         

        $table .= '</tr>';

        $table .= '</thead>';

         $table .= '<tbody>';

        for ($i=1; $i <= 12 ; $i++) { 

           $table .= '<tr>';

           $table .= '<td>'.DateTime::createFromFormat('!m',$i)->format("F").'</td>';

           foreach ($formtype as $keyTwo) {

            $getCount = Formsale::where([['formType',$keyTwo->id],['regionId',Auth::User()->region_id]])->whereYear('createdOn', '=', $request->year)
              ->whereMonth('createdOn', '=', $i)
              ->get()->count();

            if($getCount > 0){

                $table .= '<td align="center" style="color:red;"><b>'.$getCount.'<b></td>';

            }else{

                 $table .= '<td align="center">'.$getCount.'</td>';
            }

            
            
           }

           $table .= '</tr>';
            
        }

         $table .= '</tbody>';

        $table .='</table>';


        return $table;

    }

    public function nationSaleReportView (){

        $regionList = Region::orderBy('name','ASC')->get();
        $applicationForm = Applicationform::get();

        return view ('reports.national-sale',[
            'regionList' => $regionList,
            'applicationForm' => $applicationForm
        ]);
    }

     public function nationalSalesReportProcess (Request $request){

        $regionList = Region::orderBy('name','ASC')->get();

        $table = '';

       $formtype = Applicationform::where('status','Active')->get();

        $table .= '<table id="example" class="table table-striped table-bordered">';

        $table .= '<thead>';

        $table .= '<tr>';

        $table .= '<th>Dates</th>';

        foreach ($formtype as $key) {

             $table .= '<th><b>'.$key->formName.'</b></th>';
            
        }

        $table .= '</tr>';

        $table .= '</thead>';

         $table .= '<tbody>';

        foreach ($regionList as $regionListItem) {

           $table .= '<tr>';

           $table .= '<td>'.$regionListItem->name.'</td>';

           foreach ($formtype as $keyTwo) {

            $getCount = Formsale::where([['formType',$keyTwo->id],['regionId',$regionListItem->id]])->get()->count();

            if($getCount > 0){

                $table .= '<td align="center" style="color:red;"><a target="_blank" href="'.route('report-nation-form-list',['formID' =>Crypt::encrypt($keyTwo->id),'regionID' => Crypt::encrypt($regionListItem->id) ]).'"><b>'.$getCount.'<b></a></td>';

            }else{

                 $table .= '<td align="center">'.$getCount.'</td>';
            }

            
            
           }

           $table .= '</tr>';
            
        }

         $table .= '</tbody>';

        $table .='</table>';


        return $table;

        
    }

    public function nationalFormListView($formID,$regionID){

         $decodeFormID = Crypt::decrypt($formID);
         $decodeRegionID = Crypt::decrypt($regionID);

         $formList = Formsale::where([['formType',$decodeFormID],['regionId',$decodeRegionID]])->get();

         return view('reports.national-form-list',[
            'formList' => $formList
         ]);


    }

    public function nationalRegionalReportProcess(Request $request){

        $startdate = new DateTime(date('Y-m-d',strtotime($request->startdate)));
        $enddate = new DateTime(date('Y-m-d',strtotime($request->enddate))); 

        $count = 1;

        $table = '';

        $data = Formsale::where([['regionId',$request->region],['formType',$request->formtype]])->whereBetween('createdOn',[$startdate,$enddate])->get();


        $table .= '<table id="example" class="table table-striped table-bordered">';

        $table .= '<thead><th>#</th><th>Date</th><th>Form No.</th><th>Applicant</th><th>Telephone</th><th>Form Type</th><th>Amount</th><th>Issue By</th></thead>';

         $table .= '<tbody>';

         foreach ($data as $key) {

            $table .= '<tr>';

             $table .= '<td><b>'.$count.'</b></td>';
             $table .= '<td><b>'.$key->createdOn.'</b></td>';
             $table .= '<td><b>'.$key->formNumber.'</b></td>';
              $table .= '<td><b>'.$key->applicantName.'</b></td>';
             $table .= '<td><b>'.$key->tell.'</b></td>';
             $table .= '<td><b>'.$key->formTypeDetails()->formName.'</b></td>';
             $table .= '<td><b> GHC '.number_format($key->amountPaid,2).'</b></td>';
             $table .= '<td><b>'.$key->createdByName().'</b></td>';

            $table .= '</tr>';

            $count++;


            
         }

          $table .= '</tbody>';


        $table .='</table>';



        return $table;

        


    }

     public function applicationSaleReportView (){

        $applicationForm = Applicationform::get();

        return view('reports.application-sale',[
            'applicationForm' => $applicationForm
        ]);
    }

        public function applicationReportProcess(Request $request){

        $startdate = new DateTime(date('Y-m-d',strtotime($request->startdate)));
        $enddate = new DateTime(date('Y-m-d',strtotime($request->enddate))); 

        $count = 1;

        $table = '';

        $data = Formsale::where([['formType',$request->formtype]])->whereBetween('createdOn',[$startdate,$enddate])->get();


        $table .= '<table id="example" class="table table-striped table-bordered">';

        $table .= '<thead><th>#</th><th>Date</th><th>Form No.</th><th>Applicant</th><th>Telephone</th><th>Form Type</th><th>Amount</th><th>Issue By</th></thead>';

         $table .= '<tbody>';

         foreach ($data as $key) {

            $table .= '<tr>';

             $table .= '<td><b>'.$count.'</b></td>';
             $table .= '<td><b>'.$key->createdOn.'</b></td>';
             $table .= '<td><b>'.$key->formNumber.'</b></td>';
              $table .= '<td><b>'.$key->applicantName.'</b></td>';
             $table .= '<td><b>'.$key->tell.'</b></td>';
             $table .= '<td><b>'.$key->formTypeDetails()->formName.'</b></td>';
             $table .= '<td><b> GHC '.number_format($key->amountPaid,2).'</b></td>';
             $table .= '<td><b>'.$key->createdByName().'</b></td>';

            $table .= '</tr>';

            $count++;


            
         }

          $table .= '</tbody>';


        $table .='</table>';



        return $table;

        


    }

    public function assignmentReportView (){

        $regionList = Region::get();
        $stationsList = Station::get();

        return view('reports.assignment-report',[
            'regionList' => $regionList,
            'stationsList' => $stationsList
        ]);
    }

    public function assignmentReportProcess (Request $request){

        $table = '';

        $data = AssetAssignment::where([['region_id',$request->region],['district_id',$request->district_id]])->get();

        if(count($data) > 0){

            $table = 'error';


        }else{

           $table = 'error'; 
        }

        return $table;

    }


    public function turnOverReportView(){

        return view('reports.turn-around');
    }

      public function certificateYearReportProcess (Request $request){

        $table = '';

        $regionList = Region::orderBy('name','ASC')->get();

        $table .= '<table id="example" class="table table-striped table-bordered">';

        $table .= '<thead>';

        $table .= '<tr>';

        $table .= '<th>Region</th>';
        $table .= '<th>Forms Sold</th>';
        $table .= '<th>Applications</th>';
        $table .= '<th>Approved</th>';
        $table .= '<th>Total Days</th>';
        $table .= '<th>Average Days</th>';
       

        $table .= '</tr>';

        $table .= '</thead>';

         $table .= '<tbody>';
        

         foreach ($regionList as $key) {

            $getCount = 0;  
            $totaldays = 0; 
            $total = 0;

            $date1 =  new DateTime();
            $date2 =  new DateTime();

            $totalave= 0;


            $getCount = Formsale::where([['regionId',$key->id],['formType',1]])->whereYear('createdOn', '=', $request->year)->get()->count();
            $trackerCount = Tracker::join('certificate_app','certificate_app.id','=','tracker.formID')->where([['tracker.regionId',$key->id],['tracker.activity',2]])->whereYear('tracker.createdOn', '=', $request->year)->get()->count();
            $trackerCountTwo = Certapproval::where([['region_id',$key->id]])->whereYear('createdOn', '=', $request->year)->get()->count();

            $trackerLoopOne = Tracker::join('certificate_app','certificate_app.id','=','tracker.formID')->where([['tracker.regionId',$key->id],['tracker.activity',2]])->whereYear('tracker.createdOn', '=', $request->year)->get();
            $trackerLoopTwo = Certapproval::where([['region_id',$key->id]])->whereYear('createdOn', '=', $request->year)->get();


           $table .= '<tr>';

           $table .= '<td align="center">'.$key->name.'</td>';

           $table .= '<td align="center"><a style="color:blue;" target="_blank" href="'.route('reports-turnover-list-application-view',['regionID' => Crypt::encrypt($key->id),'year' => $request->year,'formID' => 1]).'">'.$getCount.'</a></td>';

           $table .= '<td align="center"><a style="color:blue;" target="_blank" href="'.route('reports-turnover-list-tracker-view',['regionID' => Crypt::encrypt($key->id),'year' => $request->year,'activity' => 2]).'">'.$trackerCount.'</a></td>';

           $table .= '<td align="center"><a style="color:blue;" target="_blank" href="'.route('reports-turnover-list-tracker-view',['regionID' => Crypt::encrypt($key->id),'year' => $request->year,'activity' => 0]).'">'.$trackerCountTwo.'</a></td>';

           foreach ($trackerLoopTwo as $trackerLoopTwoKey) {
            
             $date2 =  new DateTime($trackerLoopTwoKey->createdOn);

           }

           foreach ($trackerLoopOne as $trackerLoopOneKey) {
            
             $date1 =  new DateTime($trackerLoopOneKey->createdOn);

           }

           $interval = $date1->diff($date2);

           $totaldays = $interval->days;
           $total = $total + $totaldays;

           $table .= '<td align="center">'.$total.'</td>';

           

           if ($trackerCountTwo == 0){
                $table .= '<td align="center">0</td>';
            }
            else{
                $totalave = $total/$trackerCountTwo;
                
                $table .= '<td align="center">'.round($totalave).'</td>';
                
            }

           
           $table .= '</tr>';
            
        }

         $table .= '</tbody>';

        $table .='</table>';


        return $table;

    }

    public function turnAroundListApplicationView($regionID,$year,$formID){

    $formList = Formsale::where([['regionId',Crypt::decrypt($regionID)],['formType',$formID]])->whereYear('createdOn', '=', $year)->get();

        return view('reports.list-application-report',[
            'formList' => $formList
        ]);


    }

     public function turnAroundListTrackerView($regionID,$year,$activity){

        if($activity != 0){

            $formList = Tracker::join('certificate_app','certificate_app.id','=','tracker.formID')->where([['tracker.regionId',Crypt::decrypt($regionID)],['tracker.activity',$activity]])->whereYear('tracker.createdOn', '=', $year)->get(['certificate_app.*']);


        }else{

            $formList = Certapproval::join('certificate_app','certificate_app.id','=','certapproval.appId')->where([['certapproval.region_id',Crypt::decrypt($regionID)]])->whereYear('certapproval.createdOn', '=', $year)->get(['certificate_app.*']);
        }

      

        

      

        return view('reports.list-application-report',[
            'formList' => $formList
        ]);


    }

     public function permitYearReportProcess (Request $request){

                $table = '';

        $regionList = Region::orderBy('name','ASC')->get();

        $table .= '<table id="example" class="table table-striped table-bordered">';

        $table .= '<thead>';

        $table .= '<tr>';

        $table .= '<th>Region</th>';
        $table .= '<th>Forms Sold</th>';
        $table .= '<th>Applications</th>';
        $table .= '<th>Total Days</th>';
        $table .= '<th>Average Days</th>';
       

        $table .= '</tr>';

        $table .= '</thead>';

         $table .= '<tbody>';
        

         foreach ($regionList as $key) {

            $getCount = 0;  
            $totaldays = 0; 
            $total = 0;

            $date1 =  new DateTime();
            $date2 =  new DateTime();

            $totalave= 0;


            $getCount = PermitApp::where([['region',$key->id]])->whereYear('createdOn', '=', $request->year)->get()->count();
            $trackerCount = Formsale::where([['regionId',$key->id],['formType',2]])->whereYear('createdOn', '=', $request->year)->get()->count();
            $trackerCountTwo = PermitApp::where([['region',$key->id]])->whereYear('createdOn', '=', $request->year)->get()->count();

            $trackerLoopOne = PermitApp::where([['region',$key->id]])->whereYear('createdOn', '=', $request->year)->get();
            $trackerLoopTwo = Permitapproval::where([['region_id',$key->id]])->whereYear('createdOn', '=', $request->year)->get();


           $table .= '<tr>';

           $table .= '<td align="center">'.$key->name.'</td>';

           $table .= '<td align="center"><a style="color:blue;" target="_blank" href="'.route('reports-turnover-list-permits-view',['regionID' => Crypt::encrypt($key->id),'year' => $request->year]).'">'.$getCount.'</a></td>';

           $table .= '<td align="center"><a style="color:blue;" target="_blank" href="'.route('reports-turnover-list-application-view',['regionID' => Crypt::encrypt($key->id),'year' => $request->year,'formID' => 2]).'">'.$trackerCount.'</a></td>';


           foreach ($trackerLoopTwo as $trackerLoopTwoKey) {
            
             $date2 =  new DateTime($trackerLoopTwoKey->createdOn);

           }

           foreach ($trackerLoopOne as $trackerLoopOneKey) {
            
             $date1 =  new DateTime($trackerLoopOneKey->createdOn);

           }

           $interval = $date1->diff($date2);

           $totaldays = $interval->days;
           $total = $total + $totaldays;

           $table .= '<td align="center">'.$total.'</td>';

           

           if ($trackerCountTwo == 0){
                $table .= '<td align="center">0</td>';
            }
            else{
                $totalave = $total/$trackerCountTwo;
                
                $table .= '<td align="center">'.round($totalave).'</td>';
                
            }

           
           $table .= '</tr>';
            
        }

         $table .= '</tbody>';

        $table .='</table>';


        return $table;


     }


         public function turnAroundListPermitView($regionID,$year){

        $formList = PermitApp::where([['region',Crypt::decrypt($regionID)]])->whereYear('createdOn', '=', $year)->get();

        return view('reports.list-permit-report',[
            'formList' => $formList
        ]);




    }

    public function getIncidentReportView(){
        $data = IncidentCategory::withCount('incidents')->get();
        $type = IncidentType::withCount('type')->get();
        $region = Region::withCount('reg')->get();
        return view('reports.IncidentReport',['data'=>$data,'type'=>$type,'region'=>$region]);
    }

    public function getIncidentReportDetailsView($id){
        $decodeId = Crypt::decrypt($id); // Decrypting Incident  id
        $datas = Incident::where('cat_id', $decodeId)->get();
        return view('reports.incident-details-report',['datas'=>$datas]);

    }

    public function getIncidentReportId($id)
    {
        $decodeId = Crypt::decrypt($id); // Decrypting Incident  id
        $incident = Incident::with('tasks')->findOrFail($decodeId);

        $incident = Incident::with('report')->findOrFail($decodeId);

        $incident = Incident::with('photo')->findOrFail($decodeId);
        
        return view('reports.view-details-incident-report', [
            'incident' => $incident,
            'tasks' => $incident->tasks,
            'report' => $incident->report,
            'photo' => $incident->photo

        ]);
    
    }

    public function getIncidentReportTypeDetailsView($id){

         $decodeId = Crypt::decrypt($id); // Decrypting Incident  id
        $datas = Incident::where('type_id', $decodeId)->get();
        return view('reports.incident-details-report',['datas'=>$datas]);

    }

    public function getIncidentReportRegionDetailsView($id){
        $decodeId = Crypt::decrypt($id); // Decrypting Incident  id
        $datas = Incident::where('region_id', $decodeId)->get();
        return view('reports.incident-details-report',['datas'=>$datas]);
        

    }
}
