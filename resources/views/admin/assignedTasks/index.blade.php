@extends('layouts.admin')
@section('content')
<style>
    #DataTables_Table_0_filter{
        display: none;
    }
</style>
@can('assigned_task_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.assigned-tasks.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.assignedTask.title_singular') }}
        </a>
        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
            {{ trans('global.app_csvImport') }}
        </button>
        @include('csvImport.modal', ['model' => 'AssignedTask', 'route' => 'admin.assigned-tasks.parseCsvImport'])
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.assignedTask.title_singular') }} {{ trans('global.list') }}
    </div>
    <div class="p-4 bg-white d-flex justify-content-between align-items-center">
        <div class="form-group">
            <input type="hidden" id="selected_comp_id" value="{{$company_id}}">
            
            <div class="d-flex flex-row">
                <select class="form-control filters" aria-label=".form-select-lg example" id="customer-filters"
                    name="customer-filters">
                    <option value="customer">Customer</option>
                    @foreach($customer_details as $key => $label)
                    <option value="{{ $label->customer->id }}">
                        {{ $label->customer->first_name.' '.$label->customer->middle_name.' '.$label->customer->last_name }}
                    </option>
                    @endforeach
                </select>
                <select class="form-control filters" id="date-filters" name="date-filters">
                    <option value="date">Date</option>
                    <option value='today'>Today</option>
                    <option value='yesterday'>Yesterday</option>
                    <option value='this_week'>This Week</option>
                    <option value='last_week'>Last Week</option>
                    <option value='this_month'>This Month</option>
                    <option value='last_month'>Last Month</option>
                    <option value='this_year'>This Year</option>
                    <option value='last_year'>Last Year</option>
                </select>
                <select class="form-control filters" id="status-filters" name="status-filters">
                    <option value="status">Status</option>
                    <option value="2">Under Process</option>
                    <option value="4">Completed</option>
                </select>
                <button class="btn btn-primary filters-buttons" id="apply_filters">Apply Filters</button>
                <button class="btn btn-danger filters-buttons" id="clear_filters">Clear Filters</button>
            </div>
        </div>
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AssignedTask">
            <thead>
                <tr>
                    {{-- <th width="10">

                    </th> --}}
                    <th>
                        {{ trans('cruds.assignedTask.fields.id') }}

                    </th>
                    <th>
                        {{ trans('cruds.assignedTask.fields.company') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedTask.fields.task') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedTask.fields.sub_task') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedTask.fields.customer')}}
                    </th>

                    <th>
                        {{ trans('cruds.assignedTask.fields.user') }}
                    </th>
                    {{-- <th>
                        {{ trans('cruds.assignedTask.fields.description') }}
                    </th> --}}
                    {{-- <th>
                        {{ trans('cruds.assignedTask.fields.hours_estimation') }}
                    </th> --}}
                    {{-- <th>
                        {{ trans('cruds.assignedTask.fields.requirement') }}
                    </th> --}}
                    {{-- <th>
                        {{ trans('cruds.assignedTask.fields.proof_of_work') }}
                    </th> --}}
                    <th>
                        {{ trans('cruds.assignedTask.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedTask.fields.hours_estimation') }} {HH:MM}
                    </th>
                    {{-- <th>
                        {{ trans('cruds.assignedTask.fields.is_approved') }}
                    </th> --}}
                    <th>
                        {{ trans('cruds.assignedTask.fields.target_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedTask.fields.completed_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.actions') }}
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>

 <!-- Edit Customer Modal -->
 <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog add-customer-dialog" style="">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Customer information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="overflow-y: scroll;height:600px">
                <form method="" action="" enctype="multipart/form-data" class="customer_info_form">
                    <input type="hidden" id="comp_id2" name="company_id">
                    <div class="row">
                        <div class="col-xl-6 col-12">
                            <div class="form-row">
                                <div class="form-group col-md-3">
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
                                </div>
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
                                {{-- <div class="form-group col-md-2">
                        <label for="inputEmail4">Suffix</label>
                        <input type="email" class="form-control" id="inputEmail4">
                    </div> --}}
                                <div class="form-group col-md-12">
                                    <label class="required" for="company">Company</label>
                                    <input class="form-control" type="text" name="company" id="company"
                                        value="{{ old('company', '') }}" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="display">Display name as</label>
                                    <input type="text" class="form-control" value="" id="display">
                                </div>
                                <div class="form-group col-lg-6 col-12">
                                    <label class="required" for="inputState">GST registration type</label>
                                    <select class="form-control py-0" name="gst_type" id="gst_type" required>
                                        <option value disabled {{ old('gst_type', null) === null ? 'selected' : '' }}>
                                            {{ trans('global.pleaseSelect') }}</option>
                                        @foreach (App\Models\Customer::GST_TYPE_SELECT as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ old('gst_type', '') === (string) $key ? 'selected' : '' }}>
                                                {{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">GSTIN</label>
                                    <input class="form-control" type="text" name="gstin" id="gstin"
                                        value="{{ old('gstin', '') }}">
                                    <span class="help-block" id="gst_error"></span>
                                </div>
                                {{-- <div class="form-group col-md-6">
                        <a class="btn btn-link p-0 m-0" href="#">What is GST registration type?</a>
                    </div> --}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="required" for="email">Email</label>
                                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                        type="email" name="email" id="email" value="{{ old('email') }}"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                        type="text" name="phone" id="phone"
                                        value="{{ old('phone', '') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mobile">Mobile</label>
                                    <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}"
                                        type="text" name="mobile" id="mobile"
                                        value="{{ old('mobile', '') }}">
                                </div>
                                {{-- <div class="form-group col-md-4">
                        <label for="inputEmail4">Fax</label>
                        <input type="email" class="form-control" id="inputEmail4">
                    </div> --}}
                                {{-- <div class="form-group col-md-4">
                        <label for="other">Other</label>
                        <input class="form-control {{ $errors->has('other') ? 'is-invalid' : '' }}" type="text" name="other" id="other" value="{{ old('other', '') }}">
                    </div> --}}
                                {{-- <div class="form-group col-md-12">
                        <label for="website">Website</label>
                        <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', '') }}">
                    </div> --}}
                                {{-- <div class="form-group col-md-12">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Is sub-customer
                        </label>
                        </div>
                    </div> --}}
                                {{-- <div class="form-group col-md-6">
                        <input type="email" class="form-control" id="inputEmail4">
                    </div> --}}
                                <div class="form-group col-md-12" id="groupContent">
                                    <label for="group" class="d-block">Group</label>
                                    <select class="form-control {{ $errors->has('group') ? 'is-invalid' : '' }}"
                                        name="group" id="group">
                                        @foreach ($groups as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ old('group', '') === (string) $key ? 'selected' : '' }}>
                                                {{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-toggle="tab"
                                        data-target="#home" type="button" role="tab" aria-controls="home"
                                        aria-selected="true">Address</button>
                                </li>
                                {{-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Notes</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Tax Info</button>
                    </li> --}}
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#bill"
                                        type="button" role="tab" aria-controls="bill"
                                        aria-selected="false">Payment and billing</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-toggle="tab"
                                        data-target="#attach" type="button" role="tab" aria-controls="attach"
                                        aria-selected="false">Attachments</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center">
                                                    <h6 class="m-0">Billing Address</h6>
                                                    {{-- <a class="btn btn-link p-0 m-0 ml-3" href="#">Map</a> --}}
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-12">
                                                        <div class="form-group">
                                                            <label class="required" for="bill_address1"
                                                                class="">Addressline 1</label>
                                                            <input
                                                                class="form-control {{ $errors->has('bill_address1') ? 'is-invalid' : '' }}"
                                                                type="text" name="bill_address1"
                                                                id="bill_address1"
                                                                value="{{ old('bill_address1', '') }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="bill_address2" class="">Addressline
                                                                2</label>
                                                            <input
                                                                class="form-control {{ $errors->has('bill_address2') ? 'is-invalid' : '' }}"
                                                                type="text" name="bill_address2"
                                                                id="bill_address2"
                                                                value="{{ old('bill_address2', '') }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="required" for="city"
                                                            class="d-block">City</label><br>
                                                        <select
                                                            class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                                            name="city_id" id="city_id" required>
                                                            
                                                            @foreach ($cities as $id => $entry)
                                                            <option value="{{ $id }}"
                                                                {{ old('city_id') == $id ? 'selected' : '' }}>
                                                                {{ $entry }}</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="required" for="state"
                                                            class="d-block">State</label><br>
                                                        <select
                                                            class="form-control select2 w-100 {{ $errors->has('state') ? 'is-invalid' : '' }}"
                                                            name="state_id" id="state_id" required>
                                                            @foreach ($states as $id => $entry)
                                                            <option value="{{ $id }}"
                                                                {{ old('state_id') == $id ? 'selected' : '' }}>
                                                                {{ $entry }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    

                                                    <div class="form-group col-md-6">
                                                        <label class="required" for="pin_code"
                                                            class="d-block">Pincode</label>
                                                        <input
                                                            class="form-control {{ $errors->has('pin_code') ? 'is-invalid' : '' }}"
                                                            type="text" name="pin_code" id="pin_code"
                                                            value="{{ old('pin_code', '') }}" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="required" for="country"
                                                            class="d-block">Country</label><br>
                                                        <select
                                                            class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}"
                                                            name="country_id" id="country_id" required>
                                                            @foreach ($countries as $id => $entry)
                                                                <option value="{{ $id }}"
                                                                    {{ old('country_id') == $id ? 'selected' : '' }}>
                                                                    {{ $entry }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox" name="is_employee_approved" id="is_employee_approved" value="1" {{ old('employee_approval', 1) == 0 ? 'checked' : '' }}>
                                                        <input type="hidden" name="cust_id" id="cust_id">
                                                          <label class="form-check-label" style="font-size: 15px" for="is_employee_approved">
                                                            Customer Approved
                                                        </label>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center">
                                                    <h6 class="m-0">Shipping Address</h6>
                                                    {{-- <a class="btn btn-link p-0 m-0 ml-3" href="#">Map</a> --}}
                                                    <div class="form-check ml-3">
                                                        <input type="hidden" name="same_as_bill" value="0">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="same_as_bill" name="same_as_bill" value="1"
                                                            {{ old('same_as_bill', 1) == 0 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="same_as_bill">
                                                            Same Billing Address
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-12">
                                                        <div class="form-group">
                                                            <label for="ship_address1" class="">Addressline
                                                                1</label>
                                                            <input
                                                                class="form-control {{ $errors->has('ship_address1') ? 'is-invalid' : '' }}"
                                                                type="text" name="ship_address1"
                                                                id="ship_address1"
                                                                value="{{ old('ship_address1', '') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ship_address2" class="">Addressline
                                                                2</label>
                                                            <input
                                                                class="form-control {{ $errors->has('ship_address2') ? 'is-invalid' : '' }}"
                                                                type="text" name="ship_address2"
                                                                id="ship_address2"
                                                                value="{{ old('ship_address2', '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="city" class="d-block">City</label>
                                                        <select
                                                            class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                                            name="city_id2" id="city_id2">
                                                            @foreach ($cities as $id => $entry)
                                                            <option value="{{ $id }}"
                                                                {{ old('city_id2') == $id ? 'selected' : '' }}>
                                                                {{ $entry }}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="state" class="d-block">State</label>
                                                        <select
                                                            class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}"
                                                            name="state_id2" id="state_id2">
                                                            @foreach ($states as $id => $entry)
                                                            <option value="{{ $id }}"
                                                                {{ old('state_id2') == $id ? 'selected' : '' }}>
                                                                {{ $entry }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="pin_code" class="d-block">Pincode</label>
                                                        <input
                                                            class="form-control {{ $errors->has('pin_code') ? 'is-invalid' : '' }}"
                                                            type="text" name="pin_code2" id="pin_code2"
                                                            value="{{ old('pin_code', '') }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="country" class="d-block">Country</label>
                                                        <select
                                                            class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}"
                                                            name="country_id2" id="country_id2">
                                                            @foreach ($countries as $id => $entry)
                                                                <option value="{{ $id }}"
                                                                    {{ old('country_id') == $id ? 'selected' : '' }}>
                                                                    {{ $entry }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <div class="form-group col-12">
                                        <label for="notes">Notes</label>
                                        <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{{ old('notes') }}</textarea>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel"
                                    aria-labelledby="contact-tab">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="pan_no">Pan No.</label>
                                                    <input
                                                        class="form-control {{ $errors->has('pan_no') ? 'is-invalid' : '' }}"
                                                        type="text" name="pan_no" id="pan_no"
                                                        value="{{ old('pan_no', '') }}">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="tan">TAN</label>
                                                    <input
                                                        class="form-control {{ $errors->has('tan') ? 'is-invalid' : '' }}"
                                                        type="text" name="tan" id="tan"
                                                        value="{{ old('tan', '') }}">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-8">
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                Apply TDS for this customer
                                </label>
                            </div>
                            </div> --}}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="bill" role="tabpanel"
                                    aria-labelledby="bill-tab">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group col-md-12">
                                                <label for="inputState">Preferred payment method</label>
                                                <select class="form-control" name="payment_method"
                                                    id="payment_method">
                                                    <option value disabled
                                                        {{ old('payment_method', null) === null ? 'selected' : '' }}>
                                                        {{ trans('global.pleaseSelect') }}</option>
                                                    @foreach (App\Models\Customer::PAYMENT_METHOD_SELECT as $key => $label)
                                                        <option value="{{ $key }}"
                                                            {{ old('payment_method', '') === (string) $key ? 'selected' : '' }}>
                                                            {{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="inputState">Invoice delivery method</label>
                                                <select class="form-control" name="delivery_method"
                                                    id="delivery_method">
                                                    <option value disabled
                                                        {{ old('delivery_method', null) === null ? 'selected' : '' }}>
                                                        {{ trans('global.pleaseSelect') }}</option>
                                                    @foreach (App\Models\Customer::DELIVERY_METHOD_SELECT as $key => $label)
                                                        <option value="{{ $key }}"
                                                            {{ old('delivery_method', '') === (string) $key ? 'selected' : '' }}>
                                                            {{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="term_id_inv">Credit Period</label>
                                                    <select
                                                        class="form-control select2 {{ $errors->has('term') ? 'is-invalid' : '' }}"
                                                        name="term_id_inv" id="term_id">
                                                        @foreach ($terms as $id => $entry)
                                                            <option value="{{ $id }}"
                                                                {{ old('term_id_inv') == $id ? 'selected' : '' }}>
                                                                {{ $entry }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputState">Opening balance</label>
                                                    {{-- <select id="inputState" class="form-control">
                                    <option selected>Bill with parent</option>
                                    <option>...</option>
                                </select> --}}
                                                    <input type="text" class="form-control" name="balance"
                                                        id="balance" placeholder="">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputState">as of</label>
                                                    <input type="date" class="form-control" id="balance_date"
                                                        name="balance_date" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="attach" role="tabpanel"
                                    aria-labelledby="attach-tab">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Attachments</label>
                                        <div class="needsclick dropzone {{ $errors->has('attachment') ? 'is-invalid' : '' }}"
                                            id="attachment-dropzone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-light rounded-pill" data-dismiss="modal">Cancel</button>
                <a class="btn btn-link p-0 m-0 text-dark small" href="#">Privacy</a>
                <button type="submit" id="customerUpdate" class="btn btn-primary rounded-pill">Save</button>
            </div>
        
        </div>
    </div>
</div>
  
  <!-- Modal -->
  <div class="modal fade" id="descriptionModelPopup" tabindex="-1" role="dialog" aria-labelledby="descriptionModelPopupTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">End Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="hdnTrackingId">
                <input type="hidden" id="hdnAssignedTaskId">
                <div class="row">
                    <div class="col-md-12">
                        <label for="description" class="required">Description*</label>
                        <textarea name="" id="description" rows="5" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="status" class="required">Status*</label>
                        <select name="" id="status" class="form-control" required>
                            @foreach($statuses as $id => $entry)
                                <option value="{{ $id }}">{{ $entry }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-2">
                    <p style="color:red" id="popupErrorMsg"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savePopup">Save changes</button>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('scripts')
@parent
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).on('click', '.project-tracker', function() {
    assigned_task_id = $(this).attr("row_id");
    tracker_id = $(this).attr("tracker_id");
    if (tracker_id) {
        $('#descriptionModelPopup').modal('show');
        $('#hdnTrackingId').val(tracker_id);
        $('#hdnAssignedTaskId').val(assigned_task_id);
        // var a = $(this);

    } else {
        if ($('.recorder').is(':visible')) {
            Swal.fire('kindly stop the previous task first')
            return false;
        }
        var a = $(this);
        $.post('{{route("admin.assigned-tasks.tracker")}}', {
                "assigned_task_id": assigned_task_id,
                "tracker_id": tracker_id,
                "_token": "{{csrf_token()}}"
            },
            function(data, status) {
                if (data.status == 1) {
                    $(`a[row_id='${assigned_task_id}']`).text("start");
                    $('.recorder').addClass('d-none');
                    a.removeAttr("tracker_id");
                } else {
                    a.attr("tracker_id", data.tracker_id)
                    $(`a[row_id='${assigned_task_id}']`).text("stop");
                    $('.recorder').removeClass('d-none');
                }
            });
    }

})
</script>
<script>
$('#apply_filters').click(function() {
        var customer_id = document.getElementById('customer-filters').value;
        var date_id = document.getElementById('date-filters').value;
        var status_id = document.getElementById('status-filters').value;
        var comp_id = document.getElementById('selected_comp_id').value;
        assignedTaskList(customer_id,date_id,status_id,comp_id);
});

$('#clear_filters').click(function() {
    window.location.reload();
});

$(document).ready(function() {
    var customer_id = document.getElementById('customer-filters').value;
        var date_id = document.getElementById('date-filters').value;
        var status_id = document.getElementById('status-filters').value;
        var comp_id = document.getElementById('selected_comp_id').value;
        assignedTaskList(customer_id,date_id,status_id,comp_id);
});

function assignedTaskList(customer_id = "customer",date_id = "date",status_id ="status",comp_id){
    var url = "{{ route('admin.assigned-tasks.index') }}";
    url = url+'?'+'customer_id='+customer_id+'&'+'date_id='+date_id+'&'+'status_id='+status_id+'&'+'comp_id='+comp_id;
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('assigned_task_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete ') }}';
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.assigned-tasks.massDestroy') }}",
        className: 'btn-danger',
        action: function(e, dt, node, config) {
            var ids = $.map(dt.rows({
                selected: true
            }).data(), function(entry) {
                return entry.id
            });

            if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected ') }}')

                return
            }

            if (confirm('{{ trans('global.areYouSure ') }}')) {
                $.ajax({
                        headers: {
                            'x-csrf-token': _token
                        },
                        method: 'POST',
                        url: config.url,
                        data: {
                            ids: ids,
                            _method: 'DELETE'
                        }
                    })
                    .done(function() {
                        location.reload()
                    })
            }
        }
    }
    dtButtons.push(deleteButton)
    @endcan

    let dtOverrideGlobals = {
        buttons: dtButtons,
        processing: true,
        serverSide: true,
        retrieve: true,
        aaSorting: [],
        ajax: url,
        'columnDefs': [
                    {
                    'targets': 0,
                    'checkboxes': {
                    'selectRow': false
                        }
                    }
                ],
        columns: [
            {  data: 'id', name: 'id' },
            {  data: 'company_name', name: 'company_name' },
            {  data: 'task_name', name: 'task.name' },
            {  data: 'subtask_name', name: 'subtask_name' },
            {  data: 'customer_name', name: 'customer_name' },
            {  data: 'user_name', name: 'user.name'  },
            // { data: 'description', name: 'description' },
            // { data: 'hours_estimation', name: 'hours_estimation' },
            // { data: 'requirement', name: 'requirement', sortable: false, searchable: false },
            // { data: 'proof_of_work', name: 'proof_of_work', sortable: false, searchable: false },
            {  data: 'status_name', name: 'status.name' },
            {  data: 'created_at', name: 'hours_estimation' },
            // { data: 'is_approved', name: 'is_approved' },
            {  data: 'target_date', name: 'target_date' },
            {  data: 'completed_date', name: 'completed_date' },
            {  data: 'actions', name: '{{ trans('global.actions ') }}' }
        ],
        orderCellsTop: true,
        order: [
            [1, 'desc']
        ],
        pageLength: 100,
    };
    let table = $('.datatable-AssignedTask').DataTable(dtOverrideGlobals);
    table.ajax.url(url).load();
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

}
</script>

<script>
$('#savePopup').click(function() {
    $('#popupErrorMsg').text('');
    let des = $('#description').val();
    let sta = $('#status').val();
    let tracking_id = $('#hdnTrackingId').val();
    let assigned_task_id = $('#hdnAssignedTaskId').val();
    if (des != '' && sta != '') {
        $.post('{{route("admin.assigned-tasks.tracker")}}', {
                "assigned_task_id": assigned_task_id,
                "tracker_id": tracking_id,
                "description": des,
                "status": sta,
                "_token": "{{csrf_token()}}"
            },
            function(data, status) {
                var a = $(`a[row_id='${assigned_task_id}']`);
                if (data.status == 1) {
                    $(`a[row_id='${assigned_task_id}']`).text("start");
                    $('.recorder').addClass('d-none');
                    a.removeAttr("tracker_id");
                    if (sta == 4) {
                        a.hide();
                        window.location.reload();
                    }
                } else {
                    a.attr("tracker_id", data.tracker_id)
                    $(`a[row_id='${assigned_task_id}']`).text("stop");
                    $('.recorder').removeClass('d-none');
                }
                $('#descriptionModelPopup').modal('hide');
            });
    } else {
        $('#popupErrorMsg').text('both fields are mandatory');
    }
})
</script>
<script>
$(document).on('click', 'create_sub_tasks', function() {
    $("#createSubTaskModal").modal('show');
});

$('.clone-user-btn').click(function() {
    $('.company_role').select2('destroy');
    $('.customer_id').select2('destroy');
    let clone = $('.company-user-div').eq(0).clone();
    let length = $('.company-user-div').length;
    clone.find('#company_role').attr('id', 'company_role_' + length);
    clone.find('#customer_id').attr('id', 'customer_id_' + length);
    clone.find('.clone-user-div').html(
        '<button type="button" class="btn btn-danger remove-user-btn">Remove</button>');

    $('.company-user-div').last().after(clone);
    $('.company_role').select2();
    customerSearch();
})

$(document).on('click', '.remove-user-btn', function() {
    $(this).closest('.row').remove();
});

</script>
<script>
     $(document).on('click', '.customer_approval', function() {
        var cust_id =  $(this).attr("customer_id");
        $.ajax({
            url: "{{ route('admin.assigned-tasks.get-customer') }}",
            type: "get",
            data: {
            'cust_id': cust_id,
            },
            success: function(data) {
                $('#exampleModal').modal('show');
            console.log(data);
            if (data.length != 0) {
                $('#comp_id2').val(data.customer.company_id);
                $('#first_name').val(data.customer.first_name);
                $('#last_name').val(data.customer.last_name);    
                $('#middle_name').val(data.customer.middle_name);
                $('#company').val(data.customer.company);
                $('#email').val(data.customer.email);
                $('#phone').val(data.customer.phone);
                $('#mobile').val(data.customer.mobile);
                $('#group').val(data.customer.group);
                $('#display').val(data.customer.first_name);  
                $('#gst_type').val(data.customer.gst_type).trigger('change');  
                $('#gstin').val(data.customer.gstin).trigger('change');             
                $('#bill_address1').val(data.customer_address.addressline_1);
                $('#bill_address2').val(data.customer_address.addressline_2);
                $('#city_id').val(data.customer.city_id).trigger('change');
                $('#state_id').val(data.customer.state_id).trigger('change');
                $('#country_id').val(data.customer.country_id).trigger('change');
                $('#pin_code').val(data.customer.pin_code);
                $('#payment_method').val(data.customer.payment_method).trigger('change');
                $('#select2-term_id-container').val(data.customer.credit_period).trigger('change');
                $('#delivery_method').val(data.customer.delivery_method).trigger('change');
                $('#cust_id').val(data.customer.id);
                // $("#same_as_bill").attr( "checked", true );
            }
            },
            error: function(error) {
            console.log(error, 'err');
            alert("Error occured");
            }
            })
    });
     

        $(document).on('click', '#customerUpdate', function() {
                var data = $('.customer_info_form').serialize();
                var cust_id =  $("#cust_id").val();
                var term_id_inv = $("#term_id").val();
                // var title = $("#title").val();
                // var first_name = $("#first_name").val();
                // var middle_name = $("#middle_name").val();
                // var last_name = $("#last_name").val();
                // var company = $("#company").val();
                // var gst_type = $("#gst_type").val();
                // var gstin = $("#gstin").val();
                // var email = $("#email").val();
                // var phone = $("#phone").val();
                // var mobile = $("#mobile").val();
                // var bill_address1 = $("#bill_address1").val();
                // var bill_address2 = $("#bill_address2").val();
                // var ship_address1 = $("#ship_address1").val();
                // var ship_address2 = $("#ship_address2").val();
                // var state_id = $("#state_id").val();
                // var city_id = $("#city_id").val();
                // var pin_code = $("#pin_code").val();
                // var country_id = $("#country_id").val();
                // var state_id2 = $("#state_id2").val();
                // var address2 = $("#address2").val();
                // var city_id2 = $("#city_id2").val();
                // var pin_code2 = $("#pin_code2").val();
                // var country_id2 = $("#country_id2").val();
                // var payment_method = $("#payment_method").val();
                // var delivery_method = $("#delivery_method").val();
                // var group = $("#group").val();
                $.ajax({
                    url: "{{ route('admin.assigned-tasks.update-customer') }}",
                    type: "post",
                    data: {
                        'cust_id': cust_id,
                        '_token': $('input[name="_token"]').val(),
                        'data': data,
                        'term_id': term_id_inv,
                        // 'company_id': $('#comp_id').val(),
                        // 'title': title,
                        // 'first_name' : first_name,
                        // 'middle_name' : middle_name,
                        // 'last_name' : last_name,
                        // 'company' : company,
                        // 'gst_type' : gst_type,
                        // 'gstin' : gstin,
                        // 'email' : email,
                        // 'phone' : phone,
                        // 'mobile' : mobile,
                        // 'address' : address,
                        // 'state_id' : state_id,
                        // 'city_id' : city_id,
                        // 'pin_code' : pin_code,
                        // 'country_id' : country_id,
                        // 'state_id2' : state_id2,
                        // 'address2' : address2,
                        // 'city_id2' : city_id2,
                        // 'pin_code2' : pin_code2,
                        // 'country_id2' : country_id2,
                        // 'payment_method' : payment_method,
                        // 'delivery_method' : delivery_method,
                        // 'term_id' : term_id_inv,
                        // 'group' : group,
                        // 'same_as_bill': $("#same_As_bill").val()
                    },

                    success: function(data) {
                        new Swal("Thanks", "Customer Successfully Updated/Approved!", "success", 20000);
                        $("#exampleModal").modal('hide');
                        window.location.reload();
            
                    },
                    error: function(error) {
                        console.log(error, 'err');
                        alert(error);
                    }
                })
            })

            $(document).on('click', '#clear_filters', function() {
                window.location.reload();
            });

            $("#same_as_bill").change(function() {
                if ($("#same_as_bill").is(':checked')) {
                    $("#ship_address1").val($("#bill_address1").val())
                    $("#ship_address2").val($("#bill_address2").val())
                    $("#pin_code2").val($("#pin_code").val())
                    $("#state_id2").val($("#state_id").val()).trigger('change')
                    $("#city_id2").val($("#city_id").val()).trigger('change')
                    $("#country_id2").val($("#country_id").val()).trigger('change')
                } else {
                    $("#ship_address1").val('');
                    $("#ship_address2").val('');
                    $("#state_id2").val(null).trigger('change');
                    $("#city_id2").val(null).trigger('change');
                    $("#pin_code2").val('');
                    $("#country_id2").val(null).trigger('change');
                }
            });
</script>
<script>
    $(document).on('click','.task-disabled',function(){
        new Swal("Alert!!", "Please Wait.., Parent Task does not Complete Yet!", "warning");
    });
</script>
@endsection