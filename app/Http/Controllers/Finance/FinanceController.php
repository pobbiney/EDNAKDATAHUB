<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Sms\SmsController;
use App\Models\AppBill;
use App\Models\Applicationform;
use App\Models\Applicationformtype;
use App\Models\BillItem;
use App\Models\BillType;
use App\Models\Currency;
use App\Models\Formsale;
use App\Models\Payment;
use App\Models\PermitBill;
use App\Models\PermitRegistration;
use App\Models\ProjectCategory;
use App\Models\ProjectSector;
use App\Models\ProjectType;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class FinanceController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth'];
    }

    public function index(){

        $listType = BillType::get();
        $currencyList = Currency::orderBy('name','ASC')->get();

        $listBill = BillItem::orderBy('name','ASC')->get();

        $listSetor = ProjectSector::get();
        $listProjectCatefory = ProjectCategory::orderBy('name','ASC')->get();

        return view ('finance-setup.setup',[
            'listType' => $listType,
            'currencyList' => $currencyList,
            'listBill' => $listBill,
            'listSetor' => $listSetor,
            'listProjectCatefory' => $listProjectCatefory
        ]);
    }

    public function insertBillTypeProcess (Request $request){

        $request->validate([
            'name' => 'required'
        ]);


        if(BillType::where('name',$request->classification)->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertCat = new BillType();
            $insertCat->name = trim($request->name);
            $insertCat->description = $request->description;  
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Type added successfully') : back()->with('message_error','Something went wrong, please try again.');


        }


    }


    public function editBillTypeView ($id){

        $decodeID = Crypt::decrypt($id);

        $data = BillType::find($decodeID);

        return view ('finance-setup.edit-bill-type',[
            'data' => $data,
            'id' => $id
        ]);



    }


    public function updateBillTypeProcess (Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);


       
        $insertCat = BillType::find($decodeID);
        $insertCat->name = trim($request->name);
        $insertCat->description = $request->description;  
        $insertCat->status = $request->status;
        $status = $insertCat->update();

        return $status ? back()->with('message_success','Type updated successfully') : back()->with('message_error','Something went wrong, please try again.');


    }

    public function insertBillProcess(Request $request){

        $request->validate([
            'bill_name' => 'required',
            'currency' => 'required',
            'bill_type' => 'required',
            'amount' => 'required'
        ]);

        if(BillItem::where([['name',$request->bill_name],['billType',$request->bill_type]])->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertBill = new BillItem();
            $insertBill->name = $request->bill_name;
            $insertBill->currency = $request->currency;
            $insertBill->description = $request->bill_description;
            $insertBill->status = 'Active';
            $insertBill->createdBy =  Auth::User()->id;
            $insertBill->amount =  $request->amount;
            $insertBill->billType = $request->bill_type;
            $insertBill->sector = $request->sector;
            $insertBill->category = $request->category;
            $insertBill->type = $request->types;
            $insertBill->updatedOn = Carbon::now();
            $status = $insertBill->save();

            return $status ? back()->with('message_success','Record saved successfully') : back()->with('message_error','Something went wrong, please try again.');


        }


    }

    public function editBillView ($id){

        $decodeID = Crypt::decrypt($id);

        $data = BillItem::find($decodeID);

        $listType = BillType::get();
        $currencyList = Currency::orderBy('name','ASC')->get();

        $listSetor = ProjectSector::get();
        $listProjectCatefory = ProjectCategory::orderBy('name','ASC')->get();
        $listProjectType = ProjectType::orderBy('name','ASC')->get();

        return view ('finance-setup.edit-bill',[
            'data' => $data,
            'id' => $id,
            'listType' => $listType,
            'currencyList' => $currencyList,
            'listSetor' => $listSetor,
            'listProjectCatefory' => $listProjectCatefory,
            'listProjectType' => $listProjectType
        ]);

    }


    public function updateBillProcess(Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        $request->validate([
            'bill_name' => 'required',
            'currency' => 'required',
            'bill_type' => 'required',
            'amount' => 'required'
        ]);

        $insertBill = BillItem::find($decodeID);
        $insertBill->name = $request->bill_name;
        $insertBill->currency = $request->currency;
        $insertBill->description = $request->bill_description;
        $insertBill->status = 'Active';
        $insertBill->amount =  $request->amount;
        $insertBill->updatedBy =  Auth::User()->id;
        $insertBill->billType = $request->bill_type;
        $insertBill->sector = $request->sector;
        $insertBill->category = $request->category;
        $insertBill->type = $request->types;
        $status = $insertBill->update();

        return $status ? back()->with('message_success','Record updated successfully') : back()->with('message_error','Something went wrong, please try again.');


    }

    public function applicationFormView (){

        
        $currencyList = Currency::orderBy('name','ASC')->get();

        $listForms = Applicationform::orderBy('formName','ASC')->get();

        return view ('finance-setup.application-form',[
            
            'currencyList' => $currencyList,
            'listForms' => $listForms
        ]);


    }


    public function insertAppicationFormProcess(Request $request){

        $request->validate([
            'form_name' => 'required',
            'currency' => 'required',
            'form_type' => 'required',
            'amount' => 'required'
        ]);

        if(Applicationform::where([['formName',$request->form_name],['formType',$request->form_type]])->get()->count() > 0){

            return back()->with('message_error','Record already exist');

        }else{

            $insertBill = new Applicationform();
            $insertBill->formName = $request->form_name;
            $insertBill->currency = $request->currency;
            $insertBill->status = 'Active';
            $insertBill->createdBy =  Auth::User()->id;
            $insertBill->amount =  $request->amount;
            $insertBill->formType = $request->form_type;
            $insertBill->createdOn = Carbon::now();
            $status = $insertBill->save();

            return $status ? back()->with('message_success','Record saved successfully') : back()->with('message_error','Something went wrong, please try again.');


        }


    }

    public function applicationFormEditView ($id){

        $decodeID = Crypt::decrypt($id);

        $data = Applicationform::find($decodeID);

        $currencyList = Currency::orderBy('name','ASC')->get();

        $listForms = Applicationform::orderBy('formName','ASC')->get();

  

        return view ('finance-setup.edit_form',[
            
            'currencyList' => $currencyList,
            'listForms' => $listForms,
            'data' => $data,
            'id' => $id
        ]);


    }


    public function updateAppicationFormProcess(Request $request,$id){

        $decodeID = Crypt::decrypt($id);

        $request->validate([
            'form_name' => 'required',
            'currency' => 'required',
            'form_type' => 'required',
            'amount' => 'required',
            'status' => 'required'
        ]);

        $insertBill =  Applicationform::find($decodeID);
        $insertBill->formName = $request->form_name;
        $insertBill->currency = $request->currency;
        $insertBill->status = $request->status;
        $insertBill->updatedBy =  Auth::User()->id;
        $insertBill->amount =  $request->amount;
        $insertBill->formType = $request->form_type;
        $insertBill->updatedOn = Carbon::now();
        $status = $insertBill->update();

        return $status ? back()->with('message_success','Record update successfully') : back()->with('message_error','Something went wrong, please try again.');


    }

    public function sellFormsView(){

        $listForm = Applicationform::orderBy('formName','ASC')->get();
        $regionList = Region::orderBy('name','ASC')->get();
        $listtype = Applicationformtype::all();


        return view ('finance-setup.sell-forms',[
            'listForm' => $listForm,
            'regionList' => $regionList,
            'listtype' =>$listtype,
        ]);
    }

    public function sellFormsProcess (Request $request){

        $sendSMS = new SmsController();

        $request->validate([
            'applicant_name' => 'required',
            'telephone' => 'required|regex:/[0-9]/',
            'location' => 'required',
            'form_type' => 'required',
            'region' => 'required',
            'permit_type' => 'required'
        ]);


        $regionData = Region::find($request->region);
        $formData = Applicationform::find($request->form_type);

        $formCount = Formsale::get()->count() + 1;


        $formNumber = $regionData->code.'-'.$regionData->id.' '.$formData->amount.'0'.$formCount;

        $pin = rand(1000, 9999).''.$formCount;


        $insertSale = new Formsale();
        $insertSale->applicantName = $request->applicant_name;
        $insertSale->tell = $request->telephone;
        $insertSale->formType = $request->form_type;
        $insertSale->serialNumber = base64_encode($formNumber);
        $insertSale->pin = base64_encode($pin);
        $insertSale->formNumber = $formNumber;
        $insertSale->regionId = $request->region;
        $insertSale->amountPaid = $formData->amount;
        $insertSale->password = sha1($pin);
        $insertSale->location = $request->location;
        $insertSale->permit_type = $request->permit_type;

        $insertSale->createdBy =  Auth::User()->id;
        $insertSale->createdOn = Carbon::now();
        $insertSale->status =  'Pending';

        $status =  $insertSale->save();

        if($status){

            $message = 'Your Form Number is '.$formNumber.' and your PIN is '.$pin.'. You purchased the '.$formData->formName.' Form at GHS '.number_format($formData->amount,2);

            $sendSMS->sendSMS($request->telephone,$message);

            return back()->with('message_success','Application Forms Sold Successfully');

        }else{

            return back()->with('message_error','Something went wrong, please try again.');


        }

    }

    public function printApplicationForm($id){

        $decodeID = Crypt::decrypt($id);

        $data = Formsale::find($decodeID);

        return view ('finance-setup.print-reciept',[
            'data' => $data 
         ]);

    }

    public function listFormsView(){

        $formList = Formsale::get();

        return view ('finance-setup.list-forms',[
           'formList' => $formList 
        ]);
    }


    public function makePaymentList (Request $request){

        $formList = Formsale::get();
        $billTypeList = BillType::where('status','Active')->get();

        return view ('finance-setup.make-payment',[
            'formList' => $formList,
            'billTypeList' => $billTypeList
        ]); 
        
    }

    public function getFormsInformations (Request $request){

        $tableOne = '';

        $data = PermitRegistration::find($request->formsID);

        $billItemList = AppBill::where([['formId',''.$data->id],['status','Active']])->get();

        $totalPaymentMade = Payment::where('formId',$data->formID)->sum('amount');
        $totalBill = AppBill::where([['formId',''.$data->formID],['status','Active']])->sum('bill_amount');

        $balance = $totalBill - $totalPaymentMade;


        $tableOne .= '<table class="table table-striped table-bordered">';

        $tableOne .= '<tbody>';

        $tableOne .= '<tr>';

        $tableOne .= '<td>Proponent Name : '.$data->proponent_name.'</td>';

        $tableOne .= '<td>Contact number : '.$data->contact_number.'</td>';

        $tableOne .= '</tr>';

        $tableOne .= '<tr>';

        $tableOne .= '<td>Project Title : '.$data->project_title.'</td>';

        $tableOne .= '<td>Town : '.$data->project_title.'</td>';

        $tableOne .= '</tr>';

        $tableOne .= '</tbody>';

        $tableOne .= '</table>';

        $tableOne .= '<br>';

        $tableOne .= '<table class="table table-striped table-bordered">';

        $tableOne .= '<thead>';

        $tableOne .= '<tr>';

        $tableOne .= '<th>Total Bill</th>';

        $tableOne .= '<th>Total Payments</th>';
        $tableOne .= '<th>Balance</th>';

        $tableOne .= '</tr>';

        $tableOne .= '</thead>';

        $tableOne .= '<tbody>';

        $tableOne .= '<tr>';
            $tableOne .= '<td> GHS '.number_format($totalBill,2).'</td>';
            $tableOne .= '<td> GHS '.number_format($totalPaymentMade,2).'</td>';
            $tableOne .= '<td> GHS '.number_format($balance,2).'</td>';
            $tableOne .= '</tr>';
        $tableOne .= '</tbody>';

        $tableOne .= '</table>';


        $tableOne .= '<br>';



        return $tableOne;


    }

    public function processPaymentProcess (Request $request){

        $sendSMS = new SmsController();

        $data = PermitRegistration::find($request->formId);

        $newPaymentRecord = new Payment();
        $newPaymentRecord->amount = $request->amountPaid;
        $newPaymentRecord->createdBy = Auth::User()->id;
        $newPaymentRecord->formId = $data->formID;
        $newPaymentRecord->payment_mode = $request->payment_mode;
        $newPaymentRecord->comment = $request->comment;
        $newPaymentRecord->type = 'certificateApplication';
        $newPaymentRecord->paymentDesc = 'certificate_app';
        $newPaymentRecord->bill_type_id = $request->bill_type;
        $status = $newPaymentRecord->save();

        if($request->bill_type == 1){

        $appBill = new AppBill();
        $appBill->formId = $data->formID;
        $appBill->bill_type = $request->bill_type;
        $appBill->bill_amount = $request->amountPaid;
        $appBill->createdBy = Auth::User()->id;
        $appBill->createdon = Carbon::now();
         $appBill->appnumber = $data->formID;
         $appBill->amt_paid = $request->amountPaid;
         $appBill->description = 'certificate_app';
         $appBill->currency = 'GHC';
         $appBill->save();

        }elseif($request->bill_type == 2){

        $appBill = new PermitBill();
        $appBill->formId = $data->formID;
        $appBill->bill_type = $request->bill_type;
        $appBill->bill_amount = $request->amountPaid;
        $appBill->createdBy = Auth::User()->id;
        $appBill->createdon = Carbon::now();
         $appBill->appnumber = $data->formID;
         $appBill->amt_paid = $request->amountPaid;
         $appBill->description = 'certificate_app';
         $appBill->currency = 'GHC';
         $appBill->save();


        }

       


        if($status){

            $message = 'Dear '.$data->proponent_name.', we have received your payment of GHC '.number_format($request->amountPaid,2).'. Thank you!';

            $sendSMS->sendSMS($data->contact_number,$message);

            return back()->with('message_success','Payment made successfully');


        }else{

            return back()->with('message_error','Something went wrong, please try again.');


        }

    }


    public function searchFomrsProcess (Request $request){
        $field = $request->field;
        $operation = $request->operator;
        $parameter = $request->search_parameter;

        $result = [];

        

        $table = "";

        if($operation == "equal"){
 
            $result = PermitRegistration::where($field,$parameter)->get();
    
           }else{
    
            $result = PermitRegistration::where($field,'LIKE','%'.$parameter.'%')->get();
    
         }


         if(count($result) > 0){

            $table .= '<table id="example" class="table table-striped table-bordered">';
    
            $table .= '<thead> <tr> <th>Proponent Name</th> <th>Telephone</th> <th>Town</th> <th>Project Title</th> <th>Applied By</th> <th>Action</th></tr></thead>';
    
            $table .= '<tbody>';

            foreach ($result as $item) {

                $table .= '<tr>';

                $table .= '<td><b>'.$item->proponent_name.'</b></td>';
                $table .= '<td>'.$item->contact_number.'</td>';
                $table .= '<td>'.$item->town.'</td>';
                $table .= '<td>'.$item->project_title.'</td>';
                $table .= '<td>'.$item->applied_by.'</td>';
                
                // if($item->formTypeDetails() != null){

                //     if(number_format($item->formTypeDetails()->amount,2) == number_format($item->amountPaid,2)){

                //         $table .= '<td><a id="makePaymentBtn" data-id="'.$item->id.'" data-bs-toggle="modal" data-bs-target="#basicModal" style="color:white;" class="btn btn-success btn-sm"><i class="fa fa-coins"></i> <small>Make Payment</small></a></td>';

                //     }else{
                //         $table .= '<td></td>';
                //     }

                // }else{

                //     $table .= '<td></td>';

                // }

                 $table .= '<td><a id="makePaymentBtn" data-id="'.$item->id.'" data-bs-toggle="modal" data-bs-target="#basicModal" style="color:white;" class="btn btn-success btn-sm"><i class="fa fa-coins"></i> <small>Make Payment</small></a></td>';

               

                $table .= '</tr>';

             }
   
            $table .= '</tbody>';
    
            $table .='</table>';
    
            return $table;

         }else{

            return "no_data";
         }

    }
    public function applicationformtypeview(){

        $listtype = Applicationformtype::all();
        return view('finance-setup.form-type',['listtype'=>$listtype]);
    }

    public function addApplicationformtype(Request $request){

         $request->validate([
            'name' => 'required',
         
            'status' => 'required',
             
        ]);

            $insertCat = new Applicationformtype();
            $insertCat->name = trim($request->name);
            $insertCat->status = $request->status;  
            $status = $insertCat->save();

            return $status ? back()->with('message_success','Application form Type added successfully') : back()->with('message_error','Something went wrong, please try again.');

    }

     public function editapplicationformtypeview($id){

         $decodeID = Crypt::decrypt($id);

        $data = Applicationformtype::find($decodeID);

        $listtype = Applicationformtype::all();
        return view('finance-setup.edit-form-type',['listtype'=>$listtype,'data'=>$data,'id'=>$id]);
    }

      public function editApplicationformtype(Request $request, $id){
          $decodeID = Crypt::decrypt($id);
         $request->validate([
            'name' => 'required',
         
            'status' => 'required',
             
        ]);

            $insertCat = Applicationformtype::find($decodeID);;
            $insertCat->name = trim($request->name);
            $insertCat->status = $request->status;  
            $status= $insertCat->update();

            return $status ? back()->with('message_success','Application form Type updated successfully') : back()->with('message_error','Something went wrong, please try again.');

    }

    public function getProjectType (Request $request){

        $result = "";

        $data = ProjectType::where([['category_id',$request->category_id]])->orderBy('name')->get();

        $result .= "<option value=''>-- Select Option --</option>";

        foreach ($data as $dataIteam) {
            
            $result .= "<option value='".$dataIteam->id."'>".$dataIteam->name."</option>";  
        }

        return $result;


    }

}
