@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.customer.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.customers.index') }}">
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
                            <a class="btn btn-default" href="{{ route('frontend.customers.index') }}">
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