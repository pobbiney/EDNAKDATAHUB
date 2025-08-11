<?php

namespace App\Http\Controllers\BillPayment;

use App\Http\Controllers\Controller;
use App\Models\AppBill;
use App\Models\BillItem;
use App\Models\Formsale;
use App\Models\PermitRegistration;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Crypt;

class BillPaymentController  extends Controller implements HasMiddleware
{
        public static function middleware(): array
    {
        return ['auth'];
    }

    public function index(){

        return view('bill-payment.bill-payment');
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

                $table .= '<td><a style="color:white;" target="_blank" href="'.route('billPayment-print-bill',Crypt::encrypt($item->id)).'" class="btn btn-success btn-sm">Generate Bill</a></td>';

                $table .= '</tr>';

             }
   
            $table .= '</tbody>';
    
            $table .='</table>';
    
            return $table;

         }else{

            return "no_data";
         }

    }

    public function printBillView ($id){
        

        $decode = Crypt::decrypt($id);

        $formData = PermitRegistration::find($decode);

        $billItemsList = AppBill::where('formId',$decode)->get();

        return view('bill-payment.printBill',[
            'formData' => $formData,
            'billItemsList' => $billItemsList
        ]);
    }
}
