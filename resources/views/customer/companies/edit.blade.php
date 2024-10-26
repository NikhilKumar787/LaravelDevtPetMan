@extends('layouts.customer')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.company.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.companies.update", [$company->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="company_type">{{ trans('cruds.company.fields.company_type') }}</label>
                <select
                    class="form-control company_type select2 {{ $errors->has('company_type_id') ? 'is-invalid' : '' }}"
                    name="company_type_id" id="company_type_id" required>
                    @foreach ($companyTypes as $id => $entry)
                        <option value="{{ $id }}" {{ old('company_type_id') == $id || $company->company_type_id == $id ? 'selected' : '' }}>
                            {{ $entry }}</option>
                    @endforeach
                </select>
            </div>
            @foreach($companyRoleUser as $ruKey => $ru)
            <div class="row company-user-div">
                
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
                        <button class="btn btn-success clone-user-btn" type="button">Add+</button>
                    </div>
                    @else 
                    <div class="col-md-2">
                        <button class="btn btn-danger remove-user-btn" type="button">Remove</button>
                    </div>
                    @endif
                
            </div>
            @endforeach
            <div class="form-group">
                <label for="copy_of_pan_tan">{{ trans('cruds.company.fields.copy_of_pan_tan') }}</label>
                <div class="needsclick dropzone {{ $errors->has('copy_of_pan_tan') ? 'is-invalid' : '' }}" id="copy_of_pan_tan-dropzone">
                </div>
                @if($errors->has('copy_of_pan_tan'))
                    <span class="text-danger">{{ $errors->first('copy_of_pan_tan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.copy_of_pan_tan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gst_certificate">{{ trans('cruds.company.fields.gst_certificate') }}</label>
                <div class="needsclick dropzone {{ $errors->has('gst_certificate') ? 'is-invalid' : '' }}" id="gst_certificate-dropzone">
                </div>
                @if($errors->has('gst_certificate'))
                    <span class="text-danger">{{ $errors->first('gst_certificate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.gst_certificate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vat_certficate">{{ trans('cruds.company.fields.vat_certficate') }}</label>
                <div class="needsclick dropzone {{ $errors->has('vat_certficate') ? 'is-invalid' : '' }}" id="vat_certficate-dropzone">
                </div>
                @if($errors->has('vat_certficate'))
                    <span class="text-danger">{{ $errors->first('vat_certficate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.vat_certficate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="username_for_pan_tan">{{ trans('cruds.company.fields.username_for_pan_tan') }}</label>
                <input class="form-control {{ $errors->has('username_for_pan_tan') ? 'is-invalid' : '' }}" type="text" name="username_for_pan_tan" id="username_for_pan_tan" value="{{ old('username_for_pan_tan', $company->username_for_pan_tan) }}">
                @if($errors->has('username_for_pan_tan'))
                    <span class="text-danger">{{ $errors->first('username_for_pan_tan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.username_for_pan_tan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="password_for_pan_tan">{{ trans('cruds.company.fields.password_for_pan_tan') }}</label>
                <input class="form-control {{ $errors->has('password_for_pan_tan') ? 'is-invalid' : '' }}" type="text" name="password_for_pan_tan" id="password_for_pan_tan" value="{{ old('password_for_pan_tan', $company->password_for_pan_tan) }}">
                @if($errors->has('password_for_pan_tan'))
                    <span class="text-danger">{{ $errors->first('password_for_pan_tan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.password_for_pan_tan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="username_for_gst_vat_icegate_dgft">{{ trans('cruds.company.fields.username_for_gst_vat_icegate_dgft') }}</label>
                <input class="form-control {{ $errors->has('username_for_gst_vat_icegate_dgft') ? 'is-invalid' : '' }}" type="text" name="username_for_gst_vat_icegate_dgft" id="username_for_gst_vat_icegate_dgft" value="{{ old('username_for_gst_vat_icegate_dgft', $company->username_for_gst_vat_icegate_dgft) }}">
                @if($errors->has('username_for_gst_vat_icegate_dgft'))
                    <span class="text-danger">{{ $errors->first('username_for_gst_vat_icegate_dgft') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.username_for_gst_vat_icegate_dgft_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="password_for_gst_vat_icegate_dgft">{{ trans('cruds.company.fields.password_for_gst_vat_icegate_dgft') }}</label>
                <input class="form-control {{ $errors->has('password_for_gst_vat_icegate_dgft') ? 'is-invalid' : '' }}" type="text" name="password_for_gst_vat_icegate_dgft" id="password_for_gst_vat_icegate_dgft" value="{{ old('password_for_gst_vat_icegate_dgft', $company->password_for_gst_vat_icegate_dgft) }}">
                @if($errors->has('password_for_gst_vat_icegate_dgft'))
                    <span class="text-danger">{{ $errors->first('password_for_gst_vat_icegate_dgft') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.password_for_gst_vat_icegate_dgft_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="username_for_e_way_e_invoicing">{{ trans('cruds.company.fields.username_for_e_way_e_invoicing') }}</label>
                <input class="form-control {{ $errors->has('username_for_e_way_e_invoicing') ? 'is-invalid' : '' }}" type="text" name="username_for_e_way_e_invoicing" id="username_for_e_way_e_invoicing" value="{{ old('username_for_e_way_e_invoicing', $company->username_for_e_way_e_invoicing) }}">
                @if($errors->has('username_for_e_way_e_invoicing'))
                    <span class="text-danger">{{ $errors->first('username_for_e_way_e_invoicing') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.username_for_e_way_e_invoicing_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="password_for_e_way_e_invoicing">{{ trans('cruds.company.fields.password_for_e_way_e_invoicing') }}</label>
                <input class="form-control {{ $errors->has('password_for_e_way_e_invoicing') ? 'is-invalid' : '' }}" type="text" name="password_for_e_way_e_invoicing" id="password_for_e_way_e_invoicing" value="{{ old('password_for_e_way_e_invoicing', $company->password_for_e_way_e_invoicing) }}">
                @if($errors->has('password_for_e_way_e_invoicing'))
                    <span class="text-danger">{{ $errors->first('password_for_e_way_e_invoicing') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.password_for_e_way_e_invoicing_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="username_for_traces">{{ trans('cruds.company.fields.username_for_traces') }}</label>
                <input class="form-control {{ $errors->has('username_for_traces') ? 'is-invalid' : '' }}" type="text" name="username_for_traces" id="username_for_traces" value="{{ old('username_for_traces', $company->username_for_traces) }}">
                @if($errors->has('username_for_traces'))
                    <span class="text-danger">{{ $errors->first('username_for_traces') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.username_for_traces_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="password_for_traces">{{ trans('cruds.company.fields.password_for_traces') }}</label>
                <input class="form-control {{ $errors->has('password_for_traces') ? 'is-invalid' : '' }}" type="text" name="password_for_traces" id="password_for_traces" value="{{ old('password_for_traces', $company->password_for_traces) }}">
                @if($errors->has('password_for_traces'))
                    <span class="text-danger">{{ $errors->first('password_for_traces') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.password_for_traces_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="username_for_pf_esi_and_other_labour_law">{{ trans('cruds.company.fields.username_for_pf_esi_and_other_labour_law') }}</label>
                <input class="form-control {{ $errors->has('username_for_pf_esi_and_other_labour_law') ? 'is-invalid' : '' }}" type="text" name="username_for_pf_esi_and_other_labour_law" id="username_for_pf_esi_and_other_labour_law" value="{{ old('username_for_pf_esi_and_other_labour_law', $company->username_for_pf_esi_and_other_labour_law) }}">
                @if($errors->has('username_for_pf_esi_and_other_labour_law'))
                    <span class="text-danger">{{ $errors->first('username_for_pf_esi_and_other_labour_law') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.username_for_pf_esi_and_other_labour_law_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="password_for_pf_esi_and_other_labour_law">{{ trans('cruds.company.fields.password_for_pf_esi_and_other_labour_law') }}</label>
                <input class="form-control {{ $errors->has('password_for_pf_esi_and_other_labour_law') ? 'is-invalid' : '' }}" type="text" name="password_for_pf_esi_and_other_labour_law" id="password_for_pf_esi_and_other_labour_law" value="{{ old('password_for_pf_esi_and_other_labour_law', $company->password_for_pf_esi_and_other_labour_law) }}">
                @if($errors->has('password_for_pf_esi_and_other_labour_law'))
                    <span class="text-danger">{{ $errors->first('password_for_pf_esi_and_other_labour_law') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.password_for_pf_esi_and_other_labour_law_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="username_for_reporting_portal">{{ trans('cruds.company.fields.username_for_reporting_portal') }}</label>
                <input class="form-control {{ $errors->has('username_for_reporting_portal') ? 'is-invalid' : '' }}" type="text" name="username_for_reporting_portal" id="username_for_reporting_portal" value="{{ old('username_for_reporting_portal', $company->username_for_reporting_portal) }}">
                @if($errors->has('username_for_reporting_portal'))
                    <span class="text-danger">{{ $errors->first('username_for_reporting_portal') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.username_for_reporting_portal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="password_for_reporting_portal">{{ trans('cruds.company.fields.password_for_reporting_portal') }}</label>
                <input class="form-control {{ $errors->has('password_for_reporting_portal') ? 'is-invalid' : '' }}" type="text" name="password_for_reporting_portal" id="password_for_reporting_portal" value="{{ old('password_for_reporting_portal', $company->password_for_reporting_portal) }}">
                @if($errors->has('password_for_reporting_portal'))
                    <span class="text-danger">{{ $errors->first('password_for_reporting_portal') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.password_for_reporting_portal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="msme_registration_certificate">{{ trans('cruds.company.fields.msme_registration_certificate') }}</label>
                <div class="needsclick dropzone {{ $errors->has('msme_registration_certificate') ? 'is-invalid' : '' }}" id="msme_registration_certificate-dropzone">
                </div>
                @if($errors->has('msme_registration_certificate'))
                    <span class="text-danger">{{ $errors->first('msme_registration_certificate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.msme_registration_certificate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shop_establishment_certificate">{{ trans('cruds.company.fields.shop_establishment_certificate') }}</label>
                <div class="needsclick dropzone {{ $errors->has('shop_establishment_certificate') ? 'is-invalid' : '' }}" id="shop_establishment_certificate-dropzone">
                </div>
                @if($errors->has('shop_establishment_certificate'))
                    <span class="text-danger">{{ $errors->first('shop_establishment_certificate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.shop_establishment_certificate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_proof">{{ trans('cruds.company.fields.address_proof') }}</label>
                <div class="needsclick dropzone {{ $errors->has('address_proof') ? 'is-invalid' : '' }}" id="address_proof-dropzone">
                </div>
                @if($errors->has('address_proof'))
                    <span class="text-danger">{{ $errors->first('address_proof') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.address_proof_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="company_name">{{ trans('cruds.company.fields.company_name') }}</label>
                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', $company->company_name) }}" required>
                @if($errors->has('company_name'))
                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.company_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="gstin">{{ trans('cruds.company.fields.gstin') }}</label>
                <input class="form-control {{ $errors->has('gstin') ? 'is-invalid' : '' }}" type="text" name="gstin" id="gstin" value="{{ old('gstin', $company->gstin) }}" required>
                @if($errors->has('gstin'))
                    <span class="text-danger">{{ $errors->first('gstin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.gstin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address_line_1">{{ trans('cruds.company.fields.address_line_1') }}</label>
                <input class="form-control {{ $errors->has('address_line_1') ? 'is-invalid' : '' }}" type="text" name="address_line_1" id="address_line_1" value="{{ old('address_line_1', $company->address_line_1) }}" required>
                @if($errors->has('address_line_1'))
                    <span class="text-danger">{{ $errors->first('address_line_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.address_line_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address_line_2">{{ trans('cruds.company.fields.address_line_2') }}</label>
                <input class="form-control {{ $errors->has('address_line_2') ? 'is-invalid' : '' }}" type="text" name="address_line_2" id="address_line_2" value="{{ old('address_line_2', $company->address_line_2) }}" required>
                @if($errors->has('address_line_2'))
                    <span class="text-danger">{{ $errors->first('address_line_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.address_line_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city_id">{{ trans('cruds.company.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id">
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $company->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="state_id">{{ trans('cruds.company.fields.state') }}</label>
                <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state_id" id="state_id" required>
                    @foreach($states as $id => $entry)
                        <option value="{{ $id }}" {{ (old('state_id') ? old('state_id') : $company->state->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('state'))
                    <span class="text-danger">{{ $errors->first('state') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.company.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="cin">CIN</label>
                <input class="form-control {{ $errors->has('cin') ? 'is-invalid' : '' }}" type="text" name="cin" id="cin" value="{{ old('cin', $company->cin) }}" required>
                @if($errors->has('cin'))
                    <span class="text-danger">{{ $errors->first('cin') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label for="stamp_and_sign">Stamp and Signature</label>
                <div class="needsclick dropzone" id="stamp_and_sign-dropzone">
                </div>
                @if($errors->has('stamp_and_sign'))
                    <div class="invalid-feedback">
                        {{ $errors->first('stamp_and_sign') }}
                    </div>
                @endif
                {{-- <span class="help-block">{{ trans('cruds.company.fields.copy_of_pan_tan_helper') }}</span> --}}
            </div>
            <div class="form-group">
                <label for="users">Users</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('users') ? 'is-invalid' : '' }}" name="users[]" id="users" multiple>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ (in_array($id, old('users', [])) || $company->users->contains($id)) ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('users'))
                    <span class="text-danger">{{ $errors->first('users') }}</span>
                @endif
                <span class="help-block">   </span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <label for="mobile">Mobile</label>
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
                                    <label for="email">Email</label>
                                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                        type="email" name="email" id="email" value="{{ old('email') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="required"
                                        for="password">{{ trans('cruds.user.fields.password') }}</label>
                                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                        type="password" name="password" id="password" required>

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

@endsection

@section('scripts')
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
    success: function (file, response) {
      $('form').find('input[name="copy_of_pan_tan"]').remove()
      $('form').append('<input type="hidden" name="copy_of_pan_tan" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="copy_of_pan_tan"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
    @if(isset($company) && $company->copy_of_pan_tan)
        var file = {!! json_encode($company->copy_of_pan_tan) !!}
            this.options.addedfile.call(this, file)
        this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
        file.previewElement.classList.add('dz-complete')
        $('form').append('<input type="hidden" name="copy_of_pan_tan" value="' + file.file_name + '">')
        this.options.maxFiles = this.options.maxFiles - 1
    @endif
    },
    error: function (file, response) {
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

    $("#gstin").change(function(){
        var gst_no = $(this).val();
        $.ajax({
            url: "{{ route('admin.customers.gst')}}",
            type: "get",
            data: {'gst_no':gst_no,'_token':$('input[name="_token"]').val()},
            success: function(data) {
            console.log(data)
            $("#address_line_1").val(data.taxpayerInfo.pradr.addr.bno)
            $("#address_line_2").val(data.taxpayerInfo.pradr.addr.loc + ', '+data.taxpayerInfo.pradr.addr.dst + ', '+data.taxpayerInfo.pradr.addr.stcd +', '+ data.taxpayerInfo.pradr.addr.pncd)
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
        success: function (file, response) {
          $('form').find('input[name="stamp_and_sign"]').remove()
          $('form').append('<input type="hidden" name="stamp_and_sign" value="' + response.name + '">')
        },
        removedfile: function (file) {
          file.previewElement.remove()
          if (file.status !== 'error') {
            $('form').find('input[name="stamp_and_sign"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
          }
        },
        init: function () {
            @if(isset($company) && $company->stamp_and_sign)
                var file = {!! json_encode($company->stamp_and_sign) !!}
                    this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="stamp_and_sign" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
            @endif
        },
        error: function (file, response) {
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
    success: function (file, response) {
      $('form').find('input[name="gst_certificate"]').remove()
      $('form').append('<input type="hidden" name="gst_certificate" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="gst_certificate"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($company) && $company->gst_certificate)
      var file = {!! json_encode($company->gst_certificate) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="gst_certificate" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
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
    success: function (file, response) {
      $('form').find('input[name="vat_certficate"]').remove()
      $('form').append('<input type="hidden" name="vat_certficate" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="vat_certficate"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($company) && $company->vat_certficate)
      var file = {!! json_encode($company->vat_certficate) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="vat_certficate" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
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
    success: function (file, response) {
      $('form').find('input[name="msme_registration_certificate"]').remove()
      $('form').append('<input type="hidden" name="msme_registration_certificate" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="msme_registration_certificate"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($company) && $company->msme_registration_certificate)
      var file = {!! json_encode($company->msme_registration_certificate) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="msme_registration_certificate" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
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
    success: function (file, response) {
      $('form').find('input[name="shop_establishment_certificate"]').remove()
      $('form').append('<input type="hidden" name="shop_establishment_certificate" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="shop_establishment_certificate"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($company) && $company->shop_establishment_certificate)
      var file = {!! json_encode($company->shop_establishment_certificate) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="shop_establishment_certificate" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
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
    success: function (file, response) {
      $('form').find('input[name="address_proof"]').remove()
      $('form').append('<input type="hidden" name="address_proof" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="address_proof"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($company) && $company->address_proof)
      var file = {!! json_encode($company->address_proof) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="address_proof" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
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
    });

    $(document).ready(function() {
        customerSearch();

        
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
            minimumInputLength: 10,
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
        var role_id = $('#hdnRoleId').val();
        var first_name = $("#first_name").val();
        var middle_name = $("#middle_name").val();
        var last_name = $("#last_name").val();
        
        var email = $("#email").val();
        var mobile = $("#mobile").val();
        var globalDivId = $(this).attr('globalDivId');
        $.ajax({
            url: "{{ route('admin.companies.store-user') }}",
            type: "get",
            data: {
                '_token': $('input[name="_token"]').val(),
                'name': first_name+' '+middle_name+' '+last_name,
                'email': email,
                'mobile': mobile,
                'role_id':role_id
            },

            success: function(data) {
                $('#companyForm').append('<input type="hidden" name="added_user[]" value="'+data.id+'">');
                $("#exampleModal").modal('hide');
                if (data.length != 0) {
                    $('#'+globalDivId).append("<option value='" + data.id + "' selected>" + data.name + "</option> ");

                }
            },
            error: function(error) {
                console.log(error, 'err');
                alert("Error occured");
            }
        })
    })

    $('.clone-user-btn').click(function(){
        $('.company_role').select2('destroy');
        $('.customer_id').select2('destroy');
        let clone = $('.company-user-div').eq(0).clone();
        let length = $('.company-user-div').length;
        clone.find('#company_role').attr('id','company_role_'+length);
        clone.find('#customer_id').attr('id','customer_id_'+length);
        clone.find('.clone-user-div').html('<button type="button" class="btn btn-danger remove-user-btn">Remove</button>');
        
        $('.company-user-div').last().after(clone);
        $('.company_role').select2();
        customerSearch();
    })

    $(document).on('click','.remove-user-btn',function(){
        $(this).closest('.row').remove();
    })
</script>

@endsection
