<?php

namespace App\Http\Controllers\Customer;

use App\Models\AppBill;
use App\Models\Payment;
use App\Models\Formsale;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class CustomerFinanceController extends Controller
{
      public function financeView(){
        if (!Session::has('formsale_id')) {
                return redirect()->route('customer-login');
            }
        $formsale= Formsale::find(Session::get('formsale_id'));

         $sales = Formsale::with('formtype')
                ->where('formsales.tell', $formsale->tell)
                ->orderBy('formsales.id', 'desc')
                ->get();
        return view('customer.finance.index', compact('sales'));
    }

      public function billDetailsView($id){
          if (!Session::has('formsale_id')) {
                return redirect()->route('customer-login');
            }

         $decodeID = Crypt::decrypt($id);

        $data = Formsale::with('formtype')->find($decodeID);
        
        $bills = AppBill::where('formId', $decodeID)
                ->get();
       
        return view('customer.finance.bill-details', [
            'data' => $data,
            'bills' => $bills,
        ]);
    }

     public function paymentDetailsView($id){
        if (!Session::has('formsale_id')) {
                return redirect()->route('customer-login');
         }

        $decodeID = Crypt::decrypt($id);

        $data = Formsale::find($decodeID);
        
        $payments = Payment::where('formId', $data->id)
                ->get();
       
        return view('customer.finance.payment-details', [
            'data' => $data,
            'payments' => $payments,
        ]);
    }

      public function downloadReceiptView($id)
        {
            if (!Session::has('formsale_id')) {
                    return redirect()->route('customer-login');
            }

            $decodeID = Crypt::decrypt($id);
            $payment = Payment::find( $decodeID);
                
            $data = Formsale::find($payment->formId);
            return view('customer.finance.print-receipt',[
                'data' => $data,
                'payment' => $payment,
                
            ]);
        }
}
