<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\BankDetail;
use App\Models\Company;
use Illuminate\Http\Request;

class BankDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->company_id != '' && $request->company_id != 0){
            $bank_details = BankDetail::where('company_id',$request->company_id)->get();
        }
        return view('customer.companies.banks_listing',compact('bank_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bank_details = BankDetail::create($request->all());

        return $bank_details;   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_bank = BankDetail::where('id',$id)->first();

        return $edit_bank; 
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
        if($request->company_id != '' && $request->company_id != 0){
            $edit_banks = BankDetail::where('company_id',$request->company_id)->get();
            foreach($edit_banks as $edit_bank){
                $edit_bank->update(['set_as_default' => 0]);
            }

            $update_bank = BankDetail::where('id',$id)->first();
            $update_bank-> update($request->all());
       
            $company = Company::where('id',$request->company_id)->first();
            $company->update(['selected_bank' => $update_bank->id]);
        }
        return $update_bank;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $remove_bank = BankDetail::where('id',$id)->delete();

        return true; 
    }
}
