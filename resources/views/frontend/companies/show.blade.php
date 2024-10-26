@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.company.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.companies.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $company->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.copy_of_pan_tan') }}
                                    </th>
                                    <td>
                                        @if($company->copy_of_pan_tan)
                                            <a href="{{ $company->copy_of_pan_tan->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $company->copy_of_pan_tan->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.gst_certificate') }}
                                    </th>
                                    <td>
                                        @if($company->gst_certificate)
                                            <a href="{{ $company->gst_certificate->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $company->gst_certificate->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.vat_certficate') }}
                                    </th>
                                    <td>
                                        @if($company->vat_certficate)
                                            <a href="{{ $company->vat_certficate->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $company->vat_certficate->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.username_for_pan_tan') }}
                                    </th>
                                    <td>
                                        {{ $company->username_for_pan_tan }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.password_for_pan_tan') }}
                                    </th>
                                    <td>
                                        {{ $company->password_for_pan_tan }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.username_for_gst_vat_icegate_dgft') }}
                                    </th>
                                    <td>
                                        {{ $company->username_for_gst_vat_icegate_dgft }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.password_for_gst_vat_icegate_dgft') }}
                                    </th>
                                    <td>
                                        {{ $company->password_for_gst_vat_icegate_dgft }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.username_for_e_way_e_invoicing') }}
                                    </th>
                                    <td>
                                        {{ $company->username_for_e_way_e_invoicing }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.password_for_e_way_e_invoicing') }}
                                    </th>
                                    <td>
                                        {{ $company->password_for_e_way_e_invoicing }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.username_for_traces') }}
                                    </th>
                                    <td>
                                        {{ $company->username_for_traces }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.password_for_traces') }}
                                    </th>
                                    <td>
                                        {{ $company->password_for_traces }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.username_for_pf_esi_and_other_labour_law') }}
                                    </th>
                                    <td>
                                        {{ $company->username_for_pf_esi_and_other_labour_law }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.password_for_pf_esi_and_other_labour_law') }}
                                    </th>
                                    <td>
                                        {{ $company->password_for_pf_esi_and_other_labour_law }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.username_for_reporting_portal') }}
                                    </th>
                                    <td>
                                        {{ $company->username_for_reporting_portal }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.password_for_reporting_portal') }}
                                    </th>
                                    <td>
                                        {{ $company->password_for_reporting_portal }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.msme_registration_certificate') }}
                                    </th>
                                    <td>
                                        @if($company->msme_registration_certificate)
                                            <a href="{{ $company->msme_registration_certificate->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $company->msme_registration_certificate->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.shop_establishment_certificate') }}
                                    </th>
                                    <td>
                                        @if($company->shop_establishment_certificate)
                                            <a href="{{ $company->shop_establishment_certificate->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $company->shop_establishment_certificate->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.address_proof') }}
                                    </th>
                                    <td>
                                        @if($company->address_proof)
                                            <a href="{{ $company->address_proof->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $company->address_proof->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.company_name') }}
                                    </th>
                                    <td>
                                        {{ $company->company_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.gstin') }}
                                    </th>
                                    <td>
                                        {{ $company->gstin }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.address_line_1') }}
                                    </th>
                                    <td>
                                        {{ $company->address_line_1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.address_line_2') }}
                                    </th>
                                    <td>
                                        {{ $company->address_line_2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $company->city->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.company.fields.state') }}
                                    </th>
                                    <td>
                                        {{ $company->state->state ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.companies.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection