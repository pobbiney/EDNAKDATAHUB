<?php

namespace App\Http\Controllers\Customer;

use App\Models\Enquiry;
use App\Models\Formsale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EnquiryServices;
use App\Models\EnquiryTypes;
use Illuminate\Support\Facades\Session;

class EnquiriesController extends Controller
{
    public function enquiriesView(){

         if (!Session::has('formsale_id')) {
            return redirect()->route('customer-login');
        }

        $user = Formsale::find(session('formsale_id'));

        $forms = Formsale::with(['formtype'])
                ->where('formsales.tell', $user->tell)
                ->get();  

        $pending= Enquiry::with(['type', 'service'])
                ->where('appId', session('formsale_id'))
                ->where('status', 'pending')
                ->get();

        $closed = Enquiry::with(['type', 'service'])
                ->where('appId', session('formsale_id'))
                ->where('status', 'closed')
                ->get();

        return view('customer.enquiries.index', [
            'forms' => $forms,
            'user' => $user,
            'pending' => $pending,
            'closed' => $closed
        ]);
                
    }

    public function newTicketView(){
        if (!Session::has('formsale_id')) {
            return redirect()->route('customer-login');
        }

         $user = Formsale::find(session('formsale_id'));

        $enquiries = Enquiry::with(['type','service'])
                    ->where('appId', session('formsale_id'))
                    ->get();
        
        $types = EnquiryTypes::where('status','active')->orderBy('name','ASC')->get();
        $services = EnquiryServices::where('status','active')->orderBy('name','ASC')->get();

        return view('customer.enquiries.new-ticket', [
            'enquiries' => $enquiries,
            'user' => $user,
            'types' => $types,
            'services' => $services
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'typeId' => 'required|exists:enquiry_types,id',
            'serviceId' => 'required|exists:enquiry_services,id',
        ]);

        $enquiry = new Enquiry();
        $enquiry->appId = session('formsale_id');
        $enquiry->typeId = $request->typeId;
        $enquiry->serviceId = $request->serviceId;
        $enquiry->subject = $request->subject;
        $enquiry->description = $request->description;
        $enquiry->status = 'pending'; 
        $enquiry->createdBy = 0; 
        $enquiry->response = null;
        $enquiry->responseBy = null;
        $enquiry->save();

        return redirect()->route('customer-new-ticket')->with('message_success', 'Enquiry submitted successfully.');
        
    }
}
