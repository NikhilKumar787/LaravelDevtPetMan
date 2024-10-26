@extends('layouts.admin')
@section('content')

<div class="page-show-wrapper">
    <div class="d-flex justify-content-between mb-2">
        <h5 class="page-heading">{{ trans('global.show') }} {{ trans('cruds.company.title') }}</h5>
        {{-- <a class="back-to-list" href="{{ route('admin.permissions.index') }}">
            {{ trans('global.back_to_list') }}
        </a> --}}
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.id') }}
                </h6>
                <p>
                    {{ $company->id }}
                </p>
            </div>
        </div>
         <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.business_type') }}
                </h6>
                <p>
                    @foreach($data as $data)
                    {{ $data->name }} 
                    @endforeach
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.user.fields.user_name') }}
                </h6>
                <p>
                @foreach($username as $username)
                    {{ $username->name }} 
                    @endforeach
                    @foreach($rolename as $rolename)
                    (
                    {{ $rolename->name }} 
                    )
                    @endforeach
                </p>
            </div>
        </div>
     
        <div class="col-md-3">
            <div class="info-show-box">
            <h6>
                {{ trans('cruds.company.fields.copy_of_pan_tan') }}
            </h6>
            @if($company->copy_of_pan_tan)
            <a href="{{ $company->copy_of_pan_tan->getUrl() }}" target="_blank" style="display: inline-block">
                <img src="{{ $company->copy_of_pan_tan->getUrl('thumb') }}">
            </a>
            @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.gst_certificate') }}
                </h6>
                @if($company->gst_certificate)
                <a href="{{ $company->gst_certificate->getUrl() }}" target="_blank" style="display: inline-block">
                    <img src="{{ $company->gst_certificate->getUrl('thumb') }}">
                </a>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.vat_certficate') }}
                </h6>
                @if($company->vat_certficate)
                <a href="{{ $company->vat_certficate->getUrl() }}" target="_blank" style="display: inline-block">
                    <img src="{{ $company->vat_certficate->getUrl('thumb') }}">
                </a>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.username_for_pan_tan') }}
                </h6>
                <p>
                    {{ $company->username_for_pan_tan }}
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.password_for_pan_tan') }}
                </h6>
                <p>
                    {{ $company->password_for_pan_tan }}
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.username_for_gst_vat_icegate_dgft') }}
                </h6>
                <p>
                    {{ $company->username_for_gst_vat_icegate_dgft }}
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.password_for_gst_vat_icegate_dgft') }}
                </h6>
                <p>
                    {{ $company->password_for_gst_vat_icegate_dgft }}
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.username_for_e_way_e_invoicing') }}
                </h6>
                <p>
                    {{ $company->username_for_e_way_e_invoicing }}
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.password_for_e_way_e_invoicing') }}
                </h6>
                <p>
                    {{ $company->password_for_e_way_e_invoicing }}
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.username_for_traces') }}
                </h6>
                <p>
                    {{ $company->username_for_traces }}
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.password_for_traces') }}
                </h6>
                <p>
                    {{ $company->password_for_traces }}
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
            <h6>
                {{ trans('cruds.company.fields.username_for_pf_esi_and_other_labour_law') }}
            </h6>
            <p>
                {{ $company->username_for_pf_esi_and_other_labour_law }}
            </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.password_for_pf_esi_and_other_labour_law') }}
                </h6>
                <p>
                    {{ $company->password_for_pf_esi_and_other_labour_law }}
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.username_for_reporting_portal') }}
                </h6>
                <p>
                    {{ $company->username_for_reporting_portal }}
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.password_for_reporting_portal') }}
                </h6>
                <p>
                    {{ $company->password_for_reporting_portal }}
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
            <h6>
                {{ trans('cruds.company.fields.msme_registration_certificate') }}
            </h6>
                @if($company->msme_registration_certificate)
                <a href="{{ $company->msme_registration_certificate->getUrl() }}" target="_blank" style="display: inline-block">
                   <img src="{{ $company->msme_registration_certificate->getUrl('thumb') }}">
                    </a>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
            <h6>
                {{ trans('cruds.company.fields.shop_establishment_certificate') }}
            </h6>
            @if($company->shop_establishment_certificate)
            <a href="{{ $company->shop_establishment_certificate->getUrl() }}" target="_blank" style="display: inline-block">
                <img src="{{ $company->shop_establishment_certificate->getUrl('thumb') }}">
                </a>
            @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.address_proof') }}
                </h6>
                @if($company->address_proof)
                <a href="{{ $company->address_proof->getUrl() }}" target="_blank" style="display: inline-block">
                <img src="{{ $company->address_proof->getUrl('thumb') }}">
                    </a>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.company_name') }}
                </h6>
                <p>
                    {{ $company->company_name }}
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.gstin') }}
                </h6>
                <p>
                    {{ $company->gstin }}
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.address_line_1') }}
                </h6>
                <p>
                    {{ $company->address_line_1 }}
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.address_line_2') }}
                </h6>
                <p>
                    {{ $company->address_line_2 }}
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
            <h6>
                {{ trans('cruds.company.fields.city') }}
            </h6>
            <p>
                {{ $company->city->name ?? '' }}
            </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>
                    {{ trans('cruds.company.fields.state') }}
                </h6>
                <p>
                    {{ $company->state->state ?? '' }}
                </p>
            </div>
        </div>
    </div>

   
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#company_assigned_tasks" role="tab" data-toggle="tab">
                {{ trans('cruds.assignedTask.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#company_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="company_assigned_tasks">
            @includeIf('admin.companies.relationships.companyAssignedTasks', ['assignedTasks' => $company->companyAssignedTasks])
        </div>
        <div class="tab-pane" role="tabpanel" id="company_users">
            @includeIf('admin.companies.relationships.companyUsers',['company_owner' => $company_owner])
        </div>

    </div>
</div>

@endsection