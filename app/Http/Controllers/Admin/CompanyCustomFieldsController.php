<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyCustomFields;
use Illuminate\Http\Request;

class CompanyCustomFieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $companyCustomFields = CompanyCustomFields::create([
            'custom_field_label' => $request->custom_field_name,
            'company_id' => '',
            'company_value' => '',
        ]);

        return $companyCustomFields;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyCustomFields  $companyCustomFields
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyCustomFields $companyCustomFields)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyCustomFields  $companyCustomFields
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyCustomFields $companyCustomFields)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyCustomFields  $companyCustomFields
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyCustomFields $companyCustomFields)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyCustomFields  $companyCustomFields
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyCustomFields $companyCustomFields)
    {
        //
    }
}
