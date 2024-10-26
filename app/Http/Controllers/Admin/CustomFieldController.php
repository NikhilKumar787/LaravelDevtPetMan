<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomFieldMapping;
use App\Models\CustomFields;
use App\Models\CustomFieldValue;
use Illuminate\Http\Request;

class CustomfieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        $request_type = $request->input('type');
        if($request_type == "invoice_create")
        {
            $custom_fields = CustomFields::where('company_id',$request->company_id)->where('active_status',1)->get();
        }
        elseif($request_type == "invoice_edit")
        {
           $custom_fields = CustomFields::withTrashed()->where('company_id',$request->company_id)->where('active_status',1)->get();
        }
        return view('admin.custom_fields.custom_fields_list',compact('custom_fields'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $custom_fields = CustomFields::create([
            'custom_field_name' => $request->custom_field_name,
            'is_printable' => $request->is_printable_invoice,
            'created_by_id' => auth()->user()->id,
            'company_id' => $request->company_id,
            'active_status' => '1',
        ]);
 
        if($request->sales_receipt_checker == 1){
            $custom_fields_mapping = CustomFieldMapping::create([
                'custom_field_id' => $custom_fields->id,
                'custom_field_request_type' => 'sales_receipt',
            ]);
        }
        if($request->estimate_checker == 1){
            $custom_fields_mapping = CustomFieldMapping::create([
                'custom_field_id' => $custom_fields->id,
                'custom_field_request_type' => 'estimate',
                
            ]);
        }
        if($request->invoice_request_checker == 1){
            $custom_fields_mapping = CustomFieldMapping::create([
                'custom_field_id' => $custom_fields->id,
                'custom_field_request_type' => 'invoice',
            ]);
        }
        if($request->credit_note_checker == 1){
            $custom_fields_mapping = CustomFieldMapping::create([
                'custom_field_id' => $custom_fields->id,
                'custom_field_request_type' => 'credit_note',
            ]);
        }
        if($request->refund_receipt_checker == 1){
            $custom_fields_mapping = CustomFieldMapping::create([
                'custom_field_id' => $custom_fields->id,
                'custom_field_request_type' => 'refund_receipt',
            ]);
        }
        if($request->purchase_order_checker == 1){
            $custom_fields_mapping = CustomFieldMapping::create([
                'custom_field_id' => $custom_fields->id,
                'custom_field_request_type' => 'purchase_order',
            ]);
        }

        return $custom_fields;
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
    public function edit($id)
    {
        $custom_fields = CustomFields::withTrashed()->where('id',$id)->first();
        $custom_field_mapps = CustomFieldMapping::withTrashed()->where('custom_field_id',$id)->pluck('custom_field_request_type');
        $data = [
            'custom_fields'=>$custom_fields,
            'custom_field_maps'=>$custom_field_mapps,
        ];           
        return $data;
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
        $custom_fields = CustomFields::where('id',$id)->first();
        $custom_fields->update([
            'custom_field_name' => $request->custom_field_name,
            'is_printable' => $request->is_printable_invoice,
        ]);
        $custom_fields_mapping = CustomFieldMapping::where('custom_field_id',$id)->delete();
        if($request->sales_receipt_checker == 1){
            $custom_fields_mapping = CustomFieldMapping::create([
                'custom_field_id' => $custom_fields->id,
                'custom_field_request_type' => 'sales_receipt',
            ]);
        }
        if($request->estimate_checker == 1){
            $custom_fields_mapping = CustomFieldMapping::create([
                'custom_field_id' => $custom_fields->id,
                'custom_field_request_type' => 'estimate',
                
            ]);
        }
        if($request->invoice_request_checker == 1){
            $custom_fields_mapping = CustomFieldMapping::create([
                'custom_field_id' => $custom_fields->id,
                'custom_field_request_type' => 'invoice',
            ]);
        }
        if($request->credit_note_checker == 1){
            $custom_fields_mapping = CustomFieldMapping::create([
                'custom_field_id' => $custom_fields->id,
                'custom_field_request_type' => 'credit_note',
            ]);
        }
        if($request->refund_receipt_checker == 1){
            $custom_fields_mapping = CustomFieldMapping::create([
                'custom_field_id' => $custom_fields->id,
                'custom_field_request_type' => 'refund_receipt',
            ]);
        }
        if($request->purchase_order_checker == 1){
            $custom_fields_mapping = CustomFieldMapping::create([
                'custom_field_id' => $custom_fields->id,
                'custom_field_request_type' => 'purchase_order',
            ]);
        }
        return $custom_fields;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $custom_fields = CustomFields::where('id',$id)->first();
        $custom_fields->delete();
        $custom_field_mapping = CustomFieldMapping::where('custom_field_id',$id)->delete();
        return true;
    }

    public function inactiveCustomField(Request $request)
    {
        $customfields = CustomFields::withTrashed()->where('id',$request->inactive_id)->first();
        if($request->custom_field_status == 0){
            $customfields->update(['active_status' => '0']);
        }else{
            $customfields->update(['active_status' => '1']);
        }
        return $customfields;
    }

}
