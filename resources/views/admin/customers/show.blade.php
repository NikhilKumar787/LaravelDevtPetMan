@extends('layouts.admin')
@section('content')

<div class="page-show-wrapper">
    <div class="d-flex justify-content-between mb-2">
        <h5 class="page-heading">{{ trans('global.show') }} {{ trans('cruds.customer.title') }}</h5>
        <a class="back-to-list" href="{{ route('admin.customers.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.customer.fields.id') }}</h6>
                <p>{{ $customer->id }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.customer.fields.id') }}</h6>
                <p>{{ $customer->id }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.customer.fields.title') }}</h6>
                <p>{{ App\Models\Customer::TITLE_SELECT[$customer->title] ?? '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.customer.fields.first_name') }}</h6>
                <p>{{ $customer->first_name }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.customer.fields.middle_name') }}</h6>
                <p>  {{ $customer->middle_name }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.customer.fields.last_name') }}</h6>
                <p> {{ $customer->last_name }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.customer.fields.gstin') }}</h6>
                <p> {{ $customer->gstin }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.customer.fields.gst_type') }}</h6>
                <p> {{ App\Models\Customer::GST_TYPE_SELECT[$customer->gst_type] ?? '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.customer.fields.gst_customer_name') }}</h6>
                <p> {{ $customer->gst_customer_name }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.customer.fields.mobile') }}</h6>
                <p>{{ $customer->mobile }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.customer.fields.address') }}</h6>
                <p> {{ $customer->address }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>  {{ trans('cruds.customer.fields.city') }}</h6>
                <p> {{ $customer->city->name ?? '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.customer.fields.state') }}</h6>
                <p> {{ $customer->state->state ?? '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.customer.fields.country') }}</h6>
                <p> {{ $customer->country->name ?? '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.customer.fields.pin_code') }}</h6>
                <p>{{ $customer->pin_code }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.customer.fields.company') }}</h6>
                <p> {{ $customer->company }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.customer.fields.other') }}</h6>
                <p> {{ $customer->other }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.customer.fields.website') }}</h6>
                <p>{{ $customer->website }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.customer.fields.phone') }}</h6>
                <p> {{ $customer->phone }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.customer.fields.term') }}</h6>
                <p>{{ $customer->term->name ?? '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.customer.fields.notes') }}</h6>
                <p>{{ $customer->notes }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.customer.fields.pan_no') }}</h6>
                <p>{{ $customer->pan_no }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.customer.fields.tan') }}</h6>
                <p>{{ $customer->tan }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>  {{ trans('cruds.customer.fields.payment_method') }}</h6>
                <p>{{ App\Models\Customer::PAYMENT_METHOD_SELECT[$customer->payment_method] ?? '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.customer.fields.delivery_method') }}</h6>
                <p>{{ App\Models\Customer::DELIVERY_METHOD_SELECT[$customer->delivery_method] ?? '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.customer.fields.attachment') }}</h6>
                @if($customer->attachment)
                    <a href="{{ $customer->attachment->getUrl() }}" target="_blank">
                        {{ trans('global.view_file') }}
                    </a>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.customer.fields.optional_data_1') }}</h6>
                <p>{{ $customer->optional_data_1 }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.customer.fields.optional_data_2') }}</h6>
                <p> {{ $customer->optional_data_2 }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.customer.fields.email') }}</h6>
                <p> {{ $customer->email }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.customer.fields.is_my_vendor') }}</h6>
                <input type="checkbox" disabled="disabled" {{ $customer->is_my_vendor ? 'checked' : '' }}>
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
            <a class="nav-link" href="#customer_user_addresses" role="tab" data-toggle="tab">
                {{ trans('cruds.userAddress.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#customers_groups" role="tab" data-toggle="tab">
                {{ trans('cruds.group.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="customer_user_addresses">
            @includeIf('admin.customers.relationships.customerUserAddresses', ['userAddresses' => $customer->customerUserAddresses])
        </div>
        <div class="tab-pane" role="tabpanel" id="customers_groups">
            @includeIf('admin.customers.relationships.customersGroups', ['groups' => $customer->customersGroups])
        </div>
    </div>
</div>

@endsection