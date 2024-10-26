@extends('layouts.customer')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.customer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('customer.subcustomers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.id') }}
                        </th>
                        <td>
                            {{ $customer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.title') }}
                        </th>
                        <td>
                            {{ App\Models\Customer::TITLE_SELECT[$customer->title] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.first_name') }}
                        </th>
                        <td>
                            {{ $customer->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.middle_name') }}
                        </th>
                        <td>
                            {{ $customer->middle_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.last_name') }}
                        </th>
                        <td>
                            {{ $customer->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.gstin') }}
                        </th>
                        <td>
                            {{ $customer->gstin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.gst_type') }}
                        </th>
                        <td>
                            {{ App\Models\Customer::GST_TYPE_SELECT[$customer->gst_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.gst_customer_name') }}
                        </th>
                        <td>
                            {{ $customer->gst_customer_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.mobile') }}
                        </th>
                        <td>
                            {{ $customer->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.address') }}
                        </th>
                        <td>
                            {{ $customer->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.city') }}
                        </th>
                        <td>
                            {{ $customer->city->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.state') }}
                        </th>
                        <td>
                            {{ $customer->state->state ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.country') }}
                        </th>
                        <td>
                            {{ $customer->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.pin_code') }}
                        </th>
                        <td>
                            {{ $customer->pin_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.company') }}
                        </th>
                        <td>
                            {{ $customer->company }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.other') }}
                        </th>
                        <td>
                            {{ $customer->other }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.website') }}
                        </th>
                        <td>
                            {{ $customer->website }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.phone') }}
                        </th>
                        <td>
                            {{ $customer->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.term') }}
                        </th>
                        <td>
                            {{ $customer->term->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.notes') }}
                        </th>
                        <td>
                            {{ $customer->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.pan_no') }}
                        </th>
                        <td>
                            {{ $customer->pan_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.tan') }}
                        </th>
                        <td>
                            {{ $customer->tan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.payment_method') }}
                        </th>
                        <td>
                            {{ App\Models\Customer::PAYMENT_METHOD_SELECT[$customer->payment_method] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.delivery_method') }}
                        </th>
                        <td>
                            {{ App\Models\Customer::DELIVERY_METHOD_SELECT[$customer->delivery_method] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.attachment') }}
                        </th>
                        <td>
                            @if($customer->attachment)
                                <a href="{{ $customer->attachment->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.optional_data_1') }}
                        </th>
                        <td>
                            {{ $customer->optional_data_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.optional_data_2') }}
                        </th>
                        <td>
                            {{ $customer->optional_data_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.email') }}
                        </th>
                        <td>
                            {{ $customer->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customer.fields.is_my_vendor') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $customer->is_my_vendor ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('customer.subcustomers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
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
            @includeIf('customer.subcustomers.relationships.customerUserAddresses', ['userAddresses' => $customer->customerUserAddresses])
        </div>
        <div class="tab-pane" role="tabpanel" id="customers_groups">
            @includeIf('customer.subcustomers.relationships.customersGroups', ['groups' => $customer->customersGroups])
        </div>
    </div>
</div>

@endsection