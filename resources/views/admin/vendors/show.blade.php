@extends('layouts.admin')
@section('content')

<div class="page-show-wrapper">
    <div class="d-flex justify-content-between mb-2">
        <h5 class="page-heading">{{ trans('global.show') }} {{ trans('cruds.vendor.title') }}</h5>
        <a class="back-to-list" href="{{ route('admin.vendors.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.id') }}</h6>
                <p>{{ $vendor->id }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.title') }}</h6>
                <p> {{ App\Models\Vendor::TITLE_SELECT[$vendor->title] ?? '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.vendor.fields.first_name') }}</h6>
                <p> {{ $vendor->first_name }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.vendor.fields.middle_name') }}</h6>
                <p>{{ $vendor->middle_name }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.last_name') }}</h6>
                <p>{{ $vendor->last_name }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.company_name') }}</h6>
                <p>{{ $vendor->company_name }}<p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.vendor.fields.gst_type') }}</h6>
                <p>{{ App\Models\Vendor::GST_TYPE_SELECT[$vendor->gst_type] ?? '' }}</p>
            </div>
        </div><div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.gstin') }}</h6>
                <p>{{ $vendor->gstin }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.address') }}</h6>
                <p>{{ $vendor->address }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.vendor.fields.city') }}</h6>
                <p>{{ $vendor->city->name ?? '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.vendor.fields.state') }}</h6>
                <p> {{ $vendor->state->state ?? '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.pin_code') }}</h6>
                <p>{{ $vendor->pin_code }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.vendor.fields.mobile') }}</h6>
                <p>{{ $vendor->mobile }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.email') }}</h6>
                <p>{{ $vendor->email }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.vendor.fields.pancard') }}</h6>
                <p>{{ $vendor->pancard }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.vendor.fields.other') }}</h6>
                <p> {{ $vendor->other }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.vendor.fields.website') }}</h6>
                <p> {{ $vendor->website }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.notes') }}</h6>
                <p>{{ $vendor->notes }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.payment_method') }}</h6>
                <p> {{ $vendor->payment_method }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.term') }}</h6>
                <p> {{ $vendor->term->name ?? '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.account_no') }}</h6>
                <p>{{ $vendor->account_no }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.tax_reg_no') }}</h6>
                <p>{{ $vendor->tax_reg_no }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.effective_date') }}</h6>
                <p> {{ $vendor->effective_date }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.apply_tds') }}</h6>
                <input type="checkbox" disabled="disabled" {{ $vendor->apply_tds ? 'checked' : '' }}>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.vendor.fields.entity') }}</h6>
                <p> {{ App\Models\Vendor::ENTITY_SELECT[$vendor->entity] ?? '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.section') }}</h6>
                <p>  {{ App\Models\Vendor::SECTION_SELECT[$vendor->section] ?? '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.calculation_threshold') }}</h6>
                <input type="checkbox" disabled="disabled" {{ $vendor->calculation_threshold ? 'checked' : '' }}>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.vendor.fields.is_my_customer') }}</h6>
                <input type="checkbox" disabled="disabled" {{ $vendor->is_my_customer ? 'checked' : '' }}>
            </div>
        </div>
    </div>

   
</div>



@endsection