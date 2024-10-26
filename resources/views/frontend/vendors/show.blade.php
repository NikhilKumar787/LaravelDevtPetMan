@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.vendor.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.vendors.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $vendor->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.title') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Vendor::TITLE_SELECT[$vendor->title] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.first_name') }}
                                    </th>
                                    <td>
                                        {{ $vendor->first_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.middle_name') }}
                                    </th>
                                    <td>
                                        {{ $vendor->middle_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.last_name') }}
                                    </th>
                                    <td>
                                        {{ $vendor->last_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.company_name') }}
                                    </th>
                                    <td>
                                        {{ $vendor->company_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.gst_type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Vendor::GST_TYPE_SELECT[$vendor->gst_type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.gstin') }}
                                    </th>
                                    <td>
                                        {{ $vendor->gstin }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.address') }}
                                    </th>
                                    <td>
                                        {{ $vendor->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $vendor->city->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.state') }}
                                    </th>
                                    <td>
                                        {{ $vendor->state->state ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.pin_code') }}
                                    </th>
                                    <td>
                                        {{ $vendor->pin_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.mobile') }}
                                    </th>
                                    <td>
                                        {{ $vendor->mobile }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $vendor->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.pancard') }}
                                    </th>
                                    <td>
                                        {{ $vendor->pancard }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.other') }}
                                    </th>
                                    <td>
                                        {{ $vendor->other }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.website') }}
                                    </th>
                                    <td>
                                        {{ $vendor->website }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.notes') }}
                                    </th>
                                    <td>
                                        {{ $vendor->notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.payment_method') }}
                                    </th>
                                    <td>
                                        {{ $vendor->payment_method }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.term') }}
                                    </th>
                                    <td>
                                        {{ $vendor->term->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.account_no') }}
                                    </th>
                                    <td>
                                        {{ $vendor->account_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.tax_reg_no') }}
                                    </th>
                                    <td>
                                        {{ $vendor->tax_reg_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.effective_date') }}
                                    </th>
                                    <td>
                                        {{ $vendor->effective_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.apply_tds') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $vendor->apply_tds ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.entity') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Vendor::ENTITY_SELECT[$vendor->entity] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.section') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Vendor::SECTION_SELECT[$vendor->section] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.calculation_threshold') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $vendor->calculation_threshold ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vendor.fields.is_my_customer') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $vendor->is_my_customer ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.vendors.index') }}">
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