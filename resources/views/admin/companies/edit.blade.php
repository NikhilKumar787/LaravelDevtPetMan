@extends('layouts.admin')
@section('content')
    <div class="bg-white p-3">
     <h5> {{ trans('global.edit') }} {{ trans('cruds.company.title_singular') }}</h5>
        <div class="">
            <form method="POST" action="{{ route("admin.companies.update", [$company->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="bg-light p-3 mb-3">
                    <h6 class="form-sub-heading">Business Information</h6>
                    <div class="form-row mt-3">
                        <div class="form-group col-9">
                            <label class="required" for="company_type">{{ trans('cruds.company.fields.business_type') }}</label>
                            <select
                                class="form-control company_type select2 {{ $errors->has('company_type_id') ? 'is-invalid' : '' }}"
                                name="company_type_id" id="company_type_id" required>
                                @foreach ($companyTypes as $id => $entry)
                                <option value="{{ $id }}" {{ old('company_type_id') == $id || $company->company_type_id == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="required" for="owner_limit">Owner Limitation</label>
                            <input type="text" name="owner_limit" id="owner_limit" class="form-control py-0 owner_limit" value="{{$company->owner_limit}}" required >
                        </div>
                        
                        <div class="form-group col-12">
                            <div class="col-md-2" style="margin-left: 899px ; margin-top:-9px" >
                                <button class="btn btn btn-success clone-user-btn btn-block" id="clone-user-btn" type="button">Add+</button>
                            </div>
                            @foreach($companyRoleUser as $ruKey => $ru)
                        <div class="row company-user-div align-items-end justify-content-between" style="margin-top: -6px">
                                <div class="col-md-5">
                                    <label for="">Role</label>
                                    <select class="form-control select2 company_role {{ $errors->has('company_type_id') ? 'is-invalid' : '' }}"
                                        name="company_role[]" id="company_role" required>
                                        <option value="{{$ru->company_role_id}}">{{$ru->company_role}}</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label for="">Users</label>
                                    <select class="form-control select2 customer_id {{ $errors->has('company_type_id') ? 'is-invalid' : '' }}"
                                        name="customer_id[]" id="customer_id" required>
                                        <option value="{{$ru->id}}">{{$ru->name}}</option>
                                    </select>
                                </div>
                                @if($ruKey == 0)
                                <div class="col-md-2 clone-user-div">
                                    <button class="btn btn btn-danger remove-user-btn remove_owner btn-block d-block" cust_id="{{$ru->id}}"  type="button">Remove</button>
                                </div>
                                @else 
                                <div class="col-md-2">
                                    <button class="btn btn btn-danger remove-user-btn remove_owner btn-block d-block" cust_id="{{$ru->id}}"  type="button">Remove</button>
                                </div>
                                @endif
                        </div>
                        @endforeach
                        </div>
                       
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3" id="company_name_container">
                            <label class="required" for="company_name">{{ trans('cruds.company.fields.business_entity') }}</label>
                            <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', $company->company_name) }}" required>
                            @if ($errors->has('company_name'))
                                <span class="text-danger">{{ $errors->first('company_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.business_name_helper') }}</span>
                            <span style="color:red" id="popupFormErrorCompany_name"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="required" for="gstin">{{ trans('cruds.company.fields.gstin') }}</label>
                            <input class="form-control {{ $errors->has('gstin') ? 'is-invalid' : '' }}" type="text" name="gstin" id="gstin" value="{{ old('gstin', $company->gstin) }}" required>

                            @if ($errors->has('gstin'))
                                <span class="text-danger">{{ $errors->first('gstin') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.gstin_helper') }}</span>
                            <span style="color:red" id="popupFormErrorCompany_gstin"></span>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="required"
                                for="address_line_1">{{ trans('cruds.company.fields.address_line_1') }}</label>
                                <input class="form-control {{ $errors->has('address_line_1') ? 'is-invalid' : '' }}" type="text" name="address_line_1" id="address_line_1" value="{{ old('address_line_1', $company->address_line_1) }}" required>
                            @if ($errors->has('address_line_1'))
                                <span class="text-danger">{{ $errors->first('address_line_1') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.address_line_1_helper') }}</span>
                        </div>
                        <div class="form-group col-12">
                            <span class="btn btn-xs btn-light" id="add_custom_field_btn" style="margin-left:58pc"><i class="bi bi-journal-plus"></i> Add Custom Field</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required"
                                for="address_line_2">{{ trans('cruds.company.fields.address_line_2') }}</label>
                                <input class="form-control {{ $errors->has('address_line_2') ? 'is-invalid' : '' }}" type="text" name="address_line_2" id="address_line_2" value="{{ old('address_line_2', $company->address_line_2) }}" required>
                            @if ($errors->has('address_line_2'))
                                <span class="text-danger">{{ $errors->first('address_line_2') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.address_line_2_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="city_id" class="required">{{ trans('cruds.company.fields.city') }}</label>
                            <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id"
                                id="city_id" required>
                                @foreach($cities as $id => $entry)
                                <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $company->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                            </select>
                            @if ($errors->has('city'))
                                <span class="text-danger">{{ $errors->first('city') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.city_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="required" for="state_id">{{ trans('cruds.company.fields.state') }}</label>
                            <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state_id"
                                id="state_id" required>
                                @foreach($states as $id => $entry)
                        <option value="{{ $id }}" {{ (old('state_id') ? old('state_id') : $company->state->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                            </select>
                            @if ($errors->has('state'))
                                <span class="text-danger">{{ $errors->first('state') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.state_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pin_code" class="d-block">Pincode</label>
                            <input class="form-control {{ $errors->has('pin_code') ? 'is-invalid' : '' }}" type="text" name="pin_code" id="pin_code" value="{{$company->pin_code}}">
                        </div>
                        <div class="form-group col-md-3" id="cin_container">
                            <label class="required" for="cin">CIN</label>
                            <input class="form-control {{ $errors->has('cin') ? 'is-invalid' : '' }}" type="text" name="cin" id="cin" value="{{ old('cin', $company->cin) }}" required>
    
                            @if ($errors->has('cin'))
                                <span class="text-danger">{{ $errors->first('cin') }}</span>
                            @endif
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label  class="required" for="team_limit">Team Limitation</label>
                            <input type="text" name="team_limit" id="team_limit" value="{{$company->team_limit}}" class="form-control py-0 team_limit" >
                        </div>
                        @foreach($company_custom_fields as $key => $value)
                        <div class="form-group col-md-3">
                            <label  class="required">{{$value->custom_field_label}}</label>
                            <input type="text" name="custom_field" value="{{$value->custom_field_value}}" class="form-control py-0 team_limit" >
                        </div>
                        @endforeach
                        <div class="row list_custom_fields">
                    
                        </div> 
                    </div>
                </div>


                <div class="bg-light p-3 mb-3">
                    <h6 class="form-sub-heading">Billing Information</h6>
                    <div class="form-row mt-3">
                        <div class="form-group col-md-3">
                            <label for="username_for_pan_tan">{{ trans('cruds.company.fields.username_for_pan_tan') }}</label>
                            <input class="form-control {{ $errors->has('username_for_pan_tan') ? 'is-invalid' : '' }}" type="text" name="username_for_pan_tan" id="username_for_pan_tan" value="{{ old('username_for_pan_tan', $company->username_for_pan_tan) }}">
                            @if ($errors->has('username_for_pan_tan'))
                                <span class="text-danger">{{ $errors->first('username_for_pan_tan') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.username_for_pan_tan_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="password_for_pan_tan">{{ trans('cruds.company.fields.password_for_pan_tan') }}</label>
                            <input class="form-control {{ $errors->has('password_for_pan_tan') ? 'is-invalid' : '' }}"
                                type="text" name="password_for_pan_tan" id="password_for_pan_tan"
                                value="{{ old('password_for_pan_tan', '') }}">
                            @if ($errors->has('password_for_pan_tan'))
                                <span class="text-danger">{{ $errors->first('password_for_pan_tan') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.password_for_pan_tan_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label
                                for="username_for_gst_vat_icegate_dgft">{{ trans('cruds.company.fields.username_for_gst_vat_icegate_dgft') }}</label>
                                <input class="form-control {{ $errors->has('username_for_gst_vat_icegate_dgft') ? 'is-invalid' : '' }}" type="text" name="username_for_gst_vat_icegate_dgft" id="username_for_gst_vat_icegate_dgft" value="{{ old('username_for_gst_vat_icegate_dgft', $company->username_for_gst_vat_icegate_dgft) }}">
                            @if ($errors->has('username_for_gst_vat_icegate_dgft'))
                                <span class="text-danger">{{ $errors->first('username_for_gst_vat_icegate_dgft') }}</span>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.company.fields.username_for_gst_vat_icegate_dgft_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label
                                for="password_for_gst_vat_icegate_dgft">{{ trans('cruds.company.fields.password_for_gst_vat_icegate_dgft') }}</label>
                                <input class="form-control {{ $errors->has('password_for_gst_vat_icegate_dgft') ? 'is-invalid' : '' }}" type="text" name="password_for_gst_vat_icegate_dgft" id="password_for_gst_vat_icegate_dgft" value="{{ old('password_for_gst_vat_icegate_dgft', $company->password_for_gst_vat_icegate_dgft) }}">
                            @if ($errors->has('password_for_gst_vat_icegate_dgft'))
                                <span class="text-danger">{{ $errors->first('password_for_gst_vat_icegate_dgft') }}</span>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.company.fields.password_for_gst_vat_icegate_dgft_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label
                                for="username_for_e_way_e_invoicing">{{ trans('cruds.company.fields.username_for_e_way_e_invoicing') }}</label>
                                <input class="form-control {{ $errors->has('username_for_e_way_e_invoicing') ? 'is-invalid' : '' }}" type="text" name="username_for_e_way_e_invoicing" id="username_for_e_way_e_invoicing" value="{{ old('username_for_e_way_e_invoicing', $company->username_for_e_way_e_invoicing) }}">
                            @if ($errors->has('username_for_e_way_e_invoicing'))
                                <span class="text-danger">{{ $errors->first('username_for_e_way_e_invoicing') }}</span>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.company.fields.username_for_e_way_e_invoicing_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label
                                for="password_for_e_way_e_invoicing">{{ trans('cruds.company.fields.password_for_e_way_e_invoicing') }}</label>
                                <input class="form-control {{ $errors->has('password_for_e_way_e_invoicing') ? 'is-invalid' : '' }}" type="text" name="password_for_e_way_e_invoicing" id="password_for_e_way_e_invoicing" value="{{ old('password_for_e_way_e_invoicing', $company->password_for_e_way_e_invoicing) }}">

                            @if ($errors->has('password_for_e_way_e_invoicing'))
                                <span class="text-danger">{{ $errors->first('password_for_e_way_e_invoicing') }}</span>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.company.fields.password_for_e_way_e_invoicing_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="username_for_traces">{{ trans('cruds.company.fields.username_for_traces') }}</label>
                            <input class="form-control {{ $errors->has('username_for_traces') ? 'is-invalid' : '' }}" type="text" name="username_for_traces" id="username_for_traces" value="{{ old('username_for_traces', $company->username_for_traces) }}">

                            @if ($errors->has('username_for_traces'))
                                <span class="text-danger">{{ $errors->first('username_for_traces') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.username_for_traces_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="password_for_traces">{{ trans('cruds.company.fields.password_for_traces') }}</label>
                            <input class="form-control {{ $errors->has('password_for_traces') ? 'is-invalid' : '' }}" type="text" name="password_for_traces" id="password_for_traces" value="{{ old('password_for_traces', $company->password_for_traces) }}">

                            @if ($errors->has('password_for_traces'))
                                <span class="text-danger">{{ $errors->first('password_for_traces') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.password_for_traces_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label
                                for="username_for_pf_esi_and_other_labour_law">{{ trans('cruds.company.fields.username_for_pf_esi_and_other_labour_law') }}</label>
                                <input class="form-control {{ $errors->has('username_for_pf_esi_and_other_labour_law') ? 'is-invalid' : '' }}" type="text" name="username_for_pf_esi_and_other_labour_law" id="username_for_pf_esi_and_other_labour_law" value="{{ old('username_for_pf_esi_and_other_labour_law', $company->username_for_pf_esi_and_other_labour_law) }}">

                            @if ($errors->has('username_for_pf_esi_and_other_labour_law'))
                                <span class="text-danger">{{ $errors->first('username_for_pf_esi_and_other_labour_law') }}</span>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.company.fields.username_for_pf_esi_and_other_labour_law_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label
                                for="password_for_pf_esi_and_other_labour_law">{{ trans('cruds.company.fields.password_for_pf_esi_and_other_labour_law') }}</label>
                                <input class="form-control {{ $errors->has('password_for_pf_esi_and_other_labour_law') ? 'is-invalid' : '' }}" type="text" name="password_for_pf_esi_and_other_labour_law" id="password_for_pf_esi_and_other_labour_law" value="{{ old('password_for_pf_esi_and_other_labour_law', $company->password_for_pf_esi_and_other_labour_law) }}">

                            @if ($errors->has('password_for_pf_esi_and_other_labour_law'))
                                <span class="text-danger">{{ $errors->first('password_for_pf_esi_and_other_labour_law') }}</span>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.company.fields.password_for_pf_esi_and_other_labour_law_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label
                                for="username_for_reporting_portal">{{ trans('cruds.company.fields.username_for_reporting_portal') }}</label>
                                <input class="form-control {{ $errors->has('username_for_reporting_portal') ? 'is-invalid' : '' }}" type="text" name="username_for_reporting_portal" id="username_for_reporting_portal" value="{{ old('username_for_reporting_portal', $company->username_for_reporting_portal) }}">

                            @if ($errors->has('username_for_reporting_portal'))
                                <span class="text-danger">{{ $errors->first('username_for_reporting_portal') }}</span>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.company.fields.username_for_reporting_portal_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="password_for_reporting_portal">{{ trans('cruds.company.fields.password_for_reporting_portal') }}</label>
                            <input class="form-control {{ $errors->has('password_for_reporting_portal') ? 'is-invalid' : '' }}" type="text" name="password_for_reporting_portal" id="password_for_reporting_portal" value="{{ old('password_for_reporting_portal', $company->password_for_reporting_portal) }}">

                            @if ($errors->has('password_for_reporting_portal'))
                                <span class="text-danger">{{ $errors->first('password_for_reporting_portal') }}</span>
                            @endif
                            <span
                                class="help-block">{{ trans('cruds.company.fields.password_for_reporting_portal_helper') }}</span>
                        </div>
                    </div>
                </div>


                <div class="bg-light p-3 mb-3">
                    <h6 class="form-sub-heading">Company Logos & Certificate</h6>
                    <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="company_logo">{{ trans('cruds.company.fields.business_logo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('company_logo') ? 'is-invalid' : '' }}"
                            id="company_logo-dropzone">
                        </div>
                        @if ($errors->has('company_logo'))
                            <span class="text-danger">{{ $errors->first('company_logo') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.company.fields.business_logo_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="copy_of_pan_tan">{{ trans('cruds.company.fields.copy_of_pan_tan') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('copy_of_pan_tan') ? 'is-invalid' : '' }}"
                            id="copy_of_pan_tan-dropzone">
                        </div>
                        @if ($errors->has('copy_of_pan_tan'))
                            <span class="text-danger">{{ $errors->first('copy_of_pan_tan') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.company.fields.copy_of_pan_tan_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="gst_certificate">{{ trans('cruds.company.fields.gst_certificate') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('gst_certificate') ? 'is-invalid' : '' }}"
                            id="gst_certificate-dropzone">
                        </div>
                        @if ($errors->has('gst_certificate'))
                            <span class="text-danger">{{ $errors->first('gst_certificate') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.company.fields.gst_certificate_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="vat_certficate">{{ trans('cruds.company.fields.vat_certficate') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('vat_certficate') ? 'is-invalid' : '' }}"
                            id="vat_certficate-dropzone">
                        </div>
                        @if ($errors->has('vat_certficate'))
                            <span class="text-danger">{{ $errors->first('vat_certficate') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.company.fields.vat_certficate_helper') }}</span>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label
                            for="msme_registration_certificate">{{ trans('cruds.company.fields.msme_registration_certificate') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('msme_registration_certificate') ? 'is-invalid' : '' }}"
                            id="msme_registration_certificate-dropzone">
                        </div>
                        @if ($errors->has('msme_registration_certificate'))
                            <span class="text-danger">{{ $errors->first('msme_registration_certificate') }}</span>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.company.fields.msme_registration_certificate_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label
                            for="shop_establishment_certificate">{{ trans('cruds.company.fields.shop_establishment_certificate') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('shop_establishment_certificate') ? 'is-invalid' : '' }}"
                            id="shop_establishment_certificate-dropzone">
                        </div>
                        @if ($errors->has('shop_establishment_certificate'))
                            <span class="text-danger">{{ $errors->first('shop_establishment_certificate') }}</span>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.company.fields.shop_establishment_certificate_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="address_proof">{{ trans('cruds.company.fields.address_proof') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('address_proof') ? 'is-invalid' : '' }}"
                            id="address_proof-dropzone">
                        </div>
                        @if ($errors->has('address_proof'))
                            <span class="text-danger">{{ $errors->first('address_proof') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.company.fields.address_proof_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="stamp_and_sign">Stamp and Signature</label>
                        <div class="needsclick dropzone" id="stamp_and_sign-dropzone">
                        </div>
                        @if ($errors->has('stamp_and_sign'))
                            <div class="invalid-feedback">
                                {{ $errors->first('stamp_and_sign') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.company.fields.copy_of_pan_tan_helper') }}</span> --}}
                    </div>
                </div>
                </div>
                <div class="form-row">
                    {{-- <div class="form-group col-md-12">
                        <label for="taxtube_teams">Taxtube's Team</label>
                        <select class="form-control select2 {{ $errors->has('taxtube_teams') ? 'is-invalid' : '' }}" name="taxtube_teams"
                            id="taxtube_teams">
                            @foreach ($taxtubeTeams as $id => $team)
                                <option value="{{ $id }}">{{ $team }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('taxtube_teams'))
                            <span class="text-danger">{{ $errors->first('taxtube_teams') }}</span>
                        @endif
                        <span class="help-block"></span>
                    </div> --}}
                    <div class="form-group col-md-3">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                   
                </div>
            </form>
        </div>
    </div>
    <!-- Customer Modal -->
    <div class="modal fade" id="exampleModal" style="margin-left: 135px" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Customer information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="overflow-y: scroll;height:600px">
                    <input type="hidden" name="" id="hdnRoleId">
                    <form method="" action="" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-row">
                                    {{-- <div class="form-group col-md-2">
                                        <label for="title" class="required">Title</label>
                                        <select class="form-control py-0" name="title" id="title" required>
                                            <option value disabled {{ old('title', null) === null ? 'selected' : '' }}>
                                                {{ trans('global.pleaseSelect') }}</option>
                                            @foreach (App\Models\Customer::TITLE_SELECT as $key => $label)
                                                <option value="{{ $key }}"
                                                    {{ old('title', 'Mr') === (string) $key ? 'selected' : '' }}>
                                                    {{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    
                                    <div class="form-group col-md-3">
                                        <label for="first_name" class="required">First name</label>
                                        <input class="form-control" type="text" name="first_name" id="first_name"
                                            value="{{ old('first_name', '') }}" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="middle_name">Middle name</label>
                                        <input class="form-control" type="text" name="middle_name" id="middle_name"
                                            value="{{ old('middle_name', '') }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="last_name">Last name</label>
                                        <input class="form-control" type="text" name="last_name" id="last_name"
                                            value="{{ old('last_name', '') }}">
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="mobile" class="required">Mobile</label>
                                        <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}"
                                            type="text" name="mobile" id="mobile"
                                            value="{{ old('mobile', '') }}">
                                    </div>
                                    {{-- <div class="form-group col-md-2">
                            <label for="inputEmail4">Suffix</label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div> --}}


                                    {{-- <div class="form-group col-md-6">
                            <a class="btn btn-link p-0 m-0" href="#">What is GST registration type?</a>
                        </div> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="email" class="required">Email</label>
                                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                            type="email" name="email" id="email" value="{{ old('email') }}" autocomplete="false">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required"
                                            for="password">{{ trans('cruds.user.fields.password') }}</label>
                                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                            type="password" name="password" id="password" autocomplete="false" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="identity_proof">{{ trans('cruds.user.fields.identity_proof') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('identity_proof') ? 'is-invalid' : '' }}"
                                    id="identity_proof-dropzone">
                                </div>
                                @if ($errors->has('identity_proof'))
                                    <span class="text-danger">{{ $errors->first('identity_proof') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.identity_proof_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="address_proof">{{ trans('cruds.user.fields.address_proof') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('address_proof') ? 'is-invalid' : '' }}"
                                    id="address_proof-dropzone">
                                </div>
                                @if ($errors->has('address_proof'))
                                    <span class="text-danger">{{ $errors->first('address_proof') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.address_proof_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label
                                    for="passport_size_photo">{{ trans('cruds.user.fields.passport_size_photo') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('passport_size_photo') ? 'is-invalid' : '' }}"
                                    id="passport_size_photo-dropzone">
                                </div>
                                @if ($errors->has('passport_size_photo'))
                                    <span class="text-danger">{{ $errors->first('passport_size_photo') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.user.fields.passport_size_photo_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <span style="color:red" id="popupFormError"></span>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-light rounded-pill" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-link p-0 m-0 text-dark small" href="">Privacy</a>
                    <button type="submit" id="customerSave" class="btn btn-primary rounded-pill" globalDivId="">Save</button>
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-sm" id="addCustomFieldModel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" style="max-width: 350px; margin-top:-66px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Custom Fields</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="idsTxtField6" label="Name">Name </label>
                            <input class="form-control" type="text" id="custom_field_name">
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="add_field_save" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
@endsection

@section('scripts')
    <script>
        var uploadedIdentityProofMap = {}
        Dropzone.options.identityProofDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="identity_proof[]" value="' + response.name + '">')
                uploadedIdentityProofMap[file.name] = response.name
            },
            removedfile: function(file) {
                console.log(file)
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedIdentityProofMap[file.name]
                }
                $('form').find('input[name="identity_proof[]"][value="' + name + '"]').remove()
            },
            init: function() {

            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        var uploadedAddressProofMap = {}
        Dropzone.options.addressProofDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="address_proof[]" value="' + response.name + '">')
                uploadedAddressProofMap[file.name] = response.name
            },
            removedfile: function(file) {
                console.log(file)
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedAddressProofMap[file.name]
                }
                $('form').find('input[name="address_proof[]"][value="' + name + '"]').remove()
            },
            init: function() {

            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.passportSizePhotoDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="passport_size_photo"]').remove()
                $('form').append('<input type="hidden" name="passport_size_photo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="passport_size_photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {

            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.companyLogoDropzone = {
            url: '{{ route('admin.companies.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="company_logo"]').remove()
                $('form').append('<input type="hidden" name="company_logo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="company_logo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($company) && $company->company_logo)
                    var file = {!! json_encode($company->company_logo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="company_logo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.copyOfPanTanDropzone = {
            url: '{{ route('admin.companies.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="copy_of_pan_tan"]').remove()
                $('form').append('<input type="hidden" name="copy_of_pan_tan" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="copy_of_pan_tan"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($company) && $company->copy_of_pan_tan)
                    var file = {!! json_encode($company->copy_of_pan_tan) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="copy_of_pan_tan" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
        $("#gstin").change(function() {
            var gst_no = $(this).val();
            $.ajax({
                url: "{{ route('admin.customers.gst') }}",
                type: "get",
                data: {
                    'gst_no': gst_no,
                    '_token': $('input[name="_token"]').val()
                },
                success: function(data) {
                    console.log(data)
                    $("#address_line_1").val(data.taxpayerInfo.pradr.addr.bno)
                    $("#address_line_2").val(data.taxpayerInfo.pradr.addr.loc + ', ' + data.taxpayerInfo
                        .pradr.addr.dst + ', ' + data.taxpayerInfo.pradr.addr.stcd + ', ' + data
                        .taxpayerInfo.pradr.addr.pncd)
                    // $("#pin_code").val(data.taxpayerInfo.pradr.addr.pncd)
                    // $("#gst_customer_name").val(data.taxpayerInfo.lgnm)
                    // $("#pan_no").val(data.taxpayerInfo.panNo)
                    // $("#city_id").val(data.taxpayerInfo.pradr.addr.dst)
                    // $("#state_id").val(data.taxpayerInfo.pradr.addr.stcd)
                    $("#company_name").val(data.taxpayerInfo.tradeNam)


                },
                error: function(error) {
                    console.log(error, 'err');
                    alert("Error occured");
                }
            })
        })
    </script>
    <script>
        Dropzone.options.stampAndSignDropzone = {
            url: '{{ route('admin.companies.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="stamp_and_sign"]').remove()
                $('form').append('<input type="hidden" name="stamp_and_sign" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="stamp_and_sign"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($company) && $company->stamp_and_sign)
                    var file = {!! json_encode($company->stamp_and_sign) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="stamp_and_sign" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.gstCertificateDropzone = {
            url: '{{ route('admin.companies.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="gst_certificate"]').remove()
                $('form').append('<input type="hidden" name="gst_certificate" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="gst_certificate"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($company) && $company->gst_certificate)
                    var file = {!! json_encode($company->gst_certificate) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="gst_certificate" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.vatCertficateDropzone = {
            url: '{{ route('admin.companies.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="vat_certficate"]').remove()
                $('form').append('<input type="hidden" name="vat_certficate" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="vat_certficate"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($company) && $company->vat_certficate)
                    var file = {!! json_encode($company->vat_certficate) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="vat_certficate" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.msmeRegistrationCertificateDropzone = {
            url: '{{ route('admin.companies.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="msme_registration_certificate"]').remove()
                $('form').append('<input type="hidden" name="msme_registration_certificate" value="' + response
                    .name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="msme_registration_certificate"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($company) && $company->msme_registration_certificate)
                    var file = {!! json_encode($company->msme_registration_certificate) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="msme_registration_certificate" value="' + file
                        .file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.shopEstablishmentCertificateDropzone = {
            url: '{{ route('admin.companies.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="shop_establishment_certificate"]').remove()
                $('form').append('<input type="hidden" name="shop_establishment_certificate" value="' + response
                    .name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="shop_establishment_certificate"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($company) && $company->shop_establishment_certificate)
                    var file = {!! json_encode($company->shop_establishment_certificate) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="shop_establishment_certificate" value="' + file
                        .file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.addressProofDropzone = {
            url: '{{ route('admin.companies.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="address_proof"]').remove()
                $('form').append('<input type="hidden" name="address_proof" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="address_proof"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($company) && $company->address_proof)
                    var file = {!! json_encode($company->address_proof) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="address_proof" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        $('.company_type').on('change', function() {
            let company_id = $(this).val();
            if(company_id == 4){
                $("#gst_label").removeClass('required')
            //     $("#company_name_container").hide()
            //     $("#cin_container").hide()
            //     $("#company_name").removeAttr('required');
            //     $("#cin").removeAttr('required');
            }
            else{
                $("#gst_label").addClass('required')
            //     $("#company_name_container").show()
            //     $("#cin_container").show()
            //     $("#company_name").attr('required',true);
            //     $("#cin").attr('required',true)
            }
            if(company_id == 8){
                $("#gst_container").hide()
                $("#company_name_container").hide()
                $("#cin_container").hide()
                $("#company_name").removeAttr('required');
                $("#cin").removeAttr('required');
            }else{
                $("#gst_container").show()
                $("#company_name_container").show()
                $("#cin_container").show()
                $("#company_name").attr('required',true);
                $("#cin").attr('required',true)
            }
            $.get('{{ route('admin.companies.get-role') }}', {
                    "type_id": company_id
                },
                function(data) {
                    if (data) {
                        var html = '';
                        $.each(data, function(key, value) {
                            html += '<option value=' + key + '>' + value + '</option>';
                        })
                        $('#company_role').html(html);
                    }

                })

                if(company_id == 2 || company_id == 3 ){ 
                $(document).on('change', '#company_name', function() {
                    var comp_name = $("#company_name").val();
                    $.ajax({
                        url: "{{ route('admin.companies.check-comp_name') }}",
                        type: "get",
                        data: {
                            'comp_name': comp_name
                        },
                        success: function(data) {
                            console.log(data);
                            if (data.status == 0) {
                             $('#popupFormErrorCompany_name').text(data.message)
                            }
                            if(data.status == 1){
                                $('#popupFormErrorCompany_name').text(data.message)
                            }

                        },
                        error: function(error) {
                            console.log(error, 'err');
                            // alert("Error occured");
                        }
                    })
                })
                }
        });        

        $(document).ready(function() {
            var comp_type_id = $('#company_type_id').val();
            if(comp_type_id == 2 || comp_type_id == 3 ){ 
            $(document).on('change', '#company_name', function() {
                    var comp_name = $("#company_name").val();
                    $.ajax({
                        url: "{{ route('admin.companies.check-comp_name') }}",
                        type: "get",
                        data: {
                            'comp_name': comp_name
                        },
                        success: function(data) {
                            console.log(data);
                            if (data.status == 0) {
                             $('#popupFormErrorCompany_name').text(data.message)
                            }
                            if(data.status == 1){
                                $('#popupFormErrorCompany_name').text(data.message)
                            }

                        },
                        error: function(error) {
                            console.log(error, 'err');
                            // alert("Error occured");
                        }
                    })
                })
            customerSearch();

        }  
        $('.clone-user-btn').on('click',function() {
                var owner_limit = $('#owner_limit').val()
                let length = $('.company-user-div').length;
                if(owner_limit == length){
                  $(this).prop("disabled",true);
                }else{
                  $(this).prop("disabled",false);
                }
            });
        })

        $(document).on('change','.customer_id',function(){
            if ($(this).val() == 0) {
                var globalDivId = $(this).attr('id');
                $('#customerSave').attr('globalDivId',globalDivId);
                $("#exampleModal").modal('show');
                $('#hdnRoleId').val($(this).closest('.company-user-div').find('.company_role').val());
            } else {}
        })
        function customerSearch(){
            $('.customer_id').select2({
                placeholder: "Please Select",
                minimumInputLength: 1,
                ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                    url: "{{ route('admin.companies.get-user-ajax') }}",
                    dataType: 'json',
                    quietMillis: 250,
                    data: function(term, page) {
                        return {
                            q: term, // search term
                        };
                    },

                    processResults: function(data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;

                        return {
                            results: data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            },
                            //text:'Please Select',
                        };
                    },
                    cache: true
                },
                escapeMarkup: function(markup) {
                    return markup;
                },
                minimumInputLength: 3,
                templateResult: function(data) {
                    return '<span>' + (data.name != null ? data.name : '') + (data.phone_no ? (
                        ' - ' + data.phone_no) : (data.email ? ' - ' + data.email : '')) + '</span>';

                },
                templateSelection: formatRepoSelection
            });

            function formatRepoSelection(repo) {
                return (repo.name && repo.name != null ? repo.name : repo.email ? repo.email : repo.text);
            }
        }

        $("#customerSave").click(function() {
            $('#popupFormError').text('');
            var role_id = $('#hdnRoleId').val();
            var first_name = $("#first_name").val();
            var middle_name = $("#middle_name").val();
            var last_name = $("#last_name").val();
            
            var email = $("#email").val()
            var mobile = $("#mobile").val();
            var globalDivId = $(this).attr('globalDivId');
            if(first_name == '' || email == '' || mobile == ''){
                $('#popupFormError').text('fill the mandatory fields')
                return false;
            }
            $.ajax({
                url: "{{ route('admin.companies.store-user') }}",
                type: "get",
                data: {
                    '_token': $('input[name="_token"]').val(),
                    'name': first_name+' '+middle_name+' '+last_name,
                    'email': email,
                    'phone_no': mobile,
                    'role_id':role_id
                },

                success: function(data) {
                    $('#companyForm').append('<input type="hidden" name="added_user[]" value="'+data.id+'">');
                    if (data.status == 0) {
                        $('#popupFormError').text(data.message)
                    } else {
                        $('#'+globalDivId).append("<option value='" + data.id + "' selected>" + data.name + "</option> ");
                        sweetAlert("Thanks", "User successfully created!", "success");
                        $("#exampleModal").modal('hide');
                    }
                },
                error: function(error) {
                    console.log(error, 'err');
                    alert("Error occured");
                }
            })
        })
        $(document).on('change', '#gstin', function() {
            var gstin = $("#gstin").val();
                    $.ajax({
                        url: "{{ route('admin.companies.check-gstin') }}",
                        type: "get",
                        data: {
                            'gstin': gstin
                        },
                        success: function(data) {
                            console.log(data);
                            if (data.status == 0) {
                             $('#popupFormErrorCompany_gstin').text(data.message)
                            }
                            if(data.status == 1){
                                $('#popupFormErrorCompany_gstin').text(data.message)
                            }

                        },
                        error: function(error) {
                            console.log(error, 'err');
                            // alert("Error occured");
                        }
                    })
        });
        $("#city_id").change(function() {
                var city = $("#city_id").val();
                $.ajax({
                    url: "{{ route('admin.companies.get-city') }}",
                    type: "get",
                    data: {
                        'city': city,
                        '_token': $('input[name="_token"]').val()
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.length != 0) {
                        $('#state_id').val(data.id).trigger('change');  
                        
                        }
                    },
                    error: function(error) {
                        console.log(error, 'err');
                        alert("Error occured");
                    }
                })
            });
        $('#exampleModal').on('hidden.bs.modal', function() {
                $(this).find('form').trigger('reset');
            })

        $('.clone-user-btn').click(function(){
            $('.company_role').select2('destroy');
            $('.customer_id').select2('destroy');
            let clone = $('.company-user-div').eq(0).clone();
            let length = $('.company-user-div').length;
            clone.find('#company_role').attr('id','company_role_'+length);
            clone.find('#customer_id').attr('id','customer_id_'+length);
            clone.find('.customer_id').val('');
            clone.find('.clone-user-div').html('<button type="button" class="btn btn-danger remove-user-btn">Remove</button>');
            
            $('.company-user-div').last().after(clone);
            $('.company_role').select2();
            $('.customer_id').select2();
            customerSearch();
        })

        $(document).on('click','.remove-user-btn',function(){
            let length = $('.company-user-div').length;
            if(length == 1){
              sweetAlert('Alert!!','Please First Add User Then Try To Remove','warning');
            }else{
                $(this).closest('.row').remove();
            }
        })
        function disableBtn(){
            document.getElementById("companySave").disabled = true;
        }
        $(document).on('click','.remove_owner',function(){
            var owner_id = $(this).attr('cust_id');
            $.ajax({
                    url: "{{ route('admin.companies.remove-owner') }}",
                    type: "get",
                    data: {
                        'cust_id': owner_id,
                        '_token': $('input[name="_token"]').val()
                    },
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(error) {
                        console.log(error, 'err');
                        alert("Error occured");
                    }
                })

        })

        $(document).on('change','#owner_limit',function(){
            $('.clone-user-btn').prop("disabled",false);
            $('.clone-user-btn').on('click',function() {
                var owner_limit = $('#owner_limit').val()
                let length = $('.company-user-div').length;
                if(owner_limit == length){
                  $(this).prop("disabled",true);
                }else{
                  $(this).prop("disabled",false);
                }
            });
        })

        $("#add_custom_field_btn").click(function() {
            $("#addCustomFieldModel").modal('show');
        });

        $("#add_field_save").click(function(){
        var custom_field_name = $("#custom_field_name").val();
        $.ajax({
                url: "{{ route('admin.company_custom_fields.store') }}",
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    'custom_field_name': custom_field_name,
                },
                success: function(data) {
                    console.log(data);
                $("#addCustomFieldModel").modal('hide');
                $('.list_custom_fields').before("<div class='form-group col-md-3' id='remove_"+data.id+"'><label class='required'>"+ data.custom_field_label +"</label>"+"<input type='text' class='form-control' id='custom_field_id["+data.id+"]' name='custom_field_id["+data.id+"]'required></div>");
                },
                error: function(error) {
                    console.log(error, 'err');
                    alert("Error occured");
                }
            });
            
            done(function () { location.reload() })
        });


    </script>
@endsection
