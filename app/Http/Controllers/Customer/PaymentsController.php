<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\InvoicePayment;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
      { 
        
        $invoice_payment_id = InvoicePayment::where('invoice_id',$request->invoice)->get();
        $invoices = Invoice::where('id',$request->invoice)->first();
        $customer_details = Customer::where('id', $invoices->customer_id)->first();
        $recieve_amount_details = InvoicePayment::where('invoice_id',$invoices->id)->count();
        $recieve_amount_date = InvoicePayment::where('invoice_id',$invoices->id)->first();
    
        $collection = InvoicePayment::where('invoice_id',$invoices->id)->get();


        $customer_name = $customer_details->first_name." ".$customer_details->last_name;
    
        return view('customer.payments.create',compact('invoices','customer_details','customer_name','recieve_amount_details','recieve_amount_date','collection','invoice_payment_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoicePayment= InvoicePayment::create([
            'invoice_id' => $request->invoice_id,
            'received_amount' => $request->payment,
            'customer_id' => $request->customer_id,
            'payment_method' => $request->payment_method,
            'reference_no'=>$request->reference_no,
            'deposit_to'=>$request->deposit_to,
            'deposited_by_id'=>auth()->user()->id,
            'description'=>$request->description,
            'company_id'=> $request->company_id,
        ]);
        $invoice = Invoice::where('id',$request->invoice_id)->first();
        $invoice->update([
            'remaining_payable_amount' => $invoice->remaining_payable_amount-$invoicePayment->received_amount,
        ]);
        
        if($invoice->remaining_payable_amount == 0.00){
            $invoice->update(['invoice_status' => '1']);
        }
        return redirect()->route('customer.invoices.index',['type'=> 'myrequests']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {   
        $payment = InvoicePayment::where('id',$id)->first();
        $invoices = Invoice::where('id',$payment->invoice_id)->first();
        $customer_details = Customer::where('id', $payment->customer_id)->first();
        $customer_name = $customer_details->first_name." ".$customer_details->last_name; 
        return view('customer.payments.edit',compact('invoices','customer_details','customer_name','payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoicePayment $invoicePayment,$id)
    {
        $invoicePayment=InvoicePayment::where('id',$id)->first();
        $invoice = Invoice::where('id',$invoicePayment->invoice_id)->first();
        $invoice->update([
            'remaining_payable_amount' => $invoice->remaining_payable_amount + $invoicePayment->received_amount

        ]);

        $invoicePayment->delete();

        return redirect()->route('customer.invoices.index',['type' => 'myrequests']);  
    }

    public function PaymentDelete(Request $request){
        $invoicePayment=InvoicePayment::where('id',$request->payment_id)->first();
        $invoice = Invoice::where('id',$invoicePayment->invoice_id)->first();
        $invoice->update([
            'remaining_payable_amount' => $invoice->remaining_payable_amount + $invoicePayment->received_amount

        ]);
        $invoicePayment->delete();


    }
    public function PaymentUpdate(Request $request){
        $invoicePayment = InvoicePayment::where('id',$request->payment_id)->first();
        $invoice_id = $request->invoice_id;
        $invoice_data = Invoice::where('id',$invoice_id)->first();
        $remaining_payable_amount = $invoice_data->total_payable_amount - $request->payment_amount;
        $invoice_data->remaining_payable_amount =  $remaining_payable_amount;
        $invoice_data->update();
        $customer_id = $request->customer_id;
        $payment_amount = $request->payment_amount;
        $params = array();
        parse_str($request->data, $params);
        $invoicePayment->update($params);
        $request = json_decode(json_encode($params), FALSE);
        $invoicePayment->invoice_id = $invoice_id;
        $invoicePayment->customer_id = $customer_id;
        $invoicePayment->received_amount = $payment_amount;
        $invoicePayment->update();
        return $invoicePayment;
    }
}
