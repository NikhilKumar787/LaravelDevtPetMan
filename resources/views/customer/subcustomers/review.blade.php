@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Customer Details 
        </div>
        <div class="card-body">
            <form method="" action="" enctype="multipart/form-data" class="customer_info_form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="title" class="required">Title</label>
                            <select class="form-control py-0" name="title" id="title" required>
                                <option value disabled {{ old('title', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Customer::TITLE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('title', 'Mr') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="first_name" class="required">First name</label>
                            <input class="form-control" type="text" name="first_name" id="first_name" value="{{ $customer->first_name }}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="middle_name">Middle name</label>
                            <input class="form-control" type="text" name="middle_name" id="middle_name" value="{{ $customer->middle_name }}">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="last_name">Last name</label>
                            <input class="form-control" type="text" name="last_name" id="last_name" value="{{ $customer->last_name }}">
                        </div>
                        {{-- <div class="form-group col-md-2">
                            <label for="inputEmail4">Suffix</label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div> --}}
                        <div class="form-group col-md-12">
                            <label for="company">Company</label>
                            <input class="form-control" type="text" name="company" id="company" value="{{ $customer->company }}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="display">Display name as</label>
                            <input type="email" class="form-control" value="{{ $customer->first_name.' '.$customer->middle_name.' '.$customer->last_name }}" id="display">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputState">GST registration type</label>
                            <select class="form-control py-0" name="gst_type" id="gst_type">
                                <option value disabled {{ old('gst_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Customer::GST_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('gst_type', $customer->gst_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">GSTIN</label>
                            <input class="form-control" type="text" name="gstin" id="gstin" value="{{ $customer->gstin }}">
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
                            <label for="email">Email</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ $customer->email }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phone">Phone</label>
                            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ $customer->phone }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mobile">Mobile</label>
                            <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ $customer->mobile }}">
                        </div>
                        {{-- <div class="form-group col-md-4">
                            <label for="inputEmail4">Fax</label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div> --}}
                        <div class="form-group col-md-4">
                            <label for="other">Other</label>
                            <input class="form-control {{ $errors->has('other') ? 'is-invalid' : '' }}" type="text" name="other" id="other" value="{{ $customer->other }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="website">Website</label>
                            <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ $customer->website }}">
                        </div>
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
                            <select class="form-control {{ $errors->has('group') ? 'is-invalid' : '' }}" name="group" id="group">
                                @foreach($groups as $key => $label)
                                    <option value="{{ $key }}" {{ old('group', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Address</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Notes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Tax Info</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#bill" type="button" role="tab" aria-controls="bill" aria-selected="false">Payment and billing</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#attach" type="button" role="tab" aria-controls="attach" aria-selected="false">Attachments</button>
                        </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="col-md-12">
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                    <h6 class="m-0">Billing Address</h6>
                                    <a class="btn btn-link p-0 m-0 ml-3" href="#">Map</a>
                                    </div>
                                    <div class="form-row">
                                    <div class="form-group col-12">
                                        <div class="form-group">
                                            <label for="bill_address1" class="">Addressline 1</label>
                                            <input class="form-control {{ $errors->has('bill_address1') ? 'is-invalid' : '' }}" type="text" name="bill_address1" id="bill_address1" value="{{ $customer->address }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="bill_address2" class="">Addressline 2</label>
                                            <input class="form-control {{ $errors->has('bill_address2') ? 'is-invalid' : '' }}" type="text" name="bill_address2" id="bill_address2" value="{{ $customer->address }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="state" class="d-block">State</label>
                                        <select class="form-control select2 w-100 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state_id" id="state_id">
                                            @foreach($states as $id => $entry)
                                                <option value="{{ $id }}" {{ old('state_id',$customer->state->id) == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="city" class="d-block">City</label>
                                        <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id">
                                        <option>Please Select</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="pin_code" class="d-block">Pincode</label>
                                        <input class="form-control {{ $errors->has('pin_code') ? 'is-invalid' : '' }}" type="text" name="pin_code" id="pin_code" value="{{ $customer->pin_code }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="country" class="d-block">Country</label>
                                        <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id">
                                            @foreach($countries as $id => $entry)
                                                <option value="{{ $id }}" {{ old('country_id',$customer->country->id) == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                    <h6 class="m-0">Shipping Address</h6>
                                    <a class="btn btn-link p-0 m-0 ml-3" href="#">Map</a>
                                    <div class="form-check ml-3">
                                        <input class="form-check-input" type="checkbox" value="0" id="same_as_bill" name="same_as_bill">
                                        <label class="form-check-label" for="same_as_bill">
                                        Same Billing Address
                                        </label>
                                    </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <div class="form-group">
                                                <label for="ship_address1" class="">Addressline 1</label>
                                                <input class="form-control {{ $errors->has('ship_address1') ? 'is-invalid' : '' }}" type="text" name="ship_address1" id="ship_address1" value="{{ old('ship_address1', '') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="ship_address2" class="">Addressline 2</label>
                                                <input class="form-control {{ $errors->has('ship_address2') ? 'is-invalid' : '' }}" type="text" name="ship_address2" id="ship_address2" value="{{ old('ship_address2', '') }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label for="state" class="d-block">State</label>
                                        <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state_id2" id="state_id2">
                                            @foreach($states as $id => $entry)
                                                <option value="{{ $id }}" data-attr="{{ ucwords($entry) }}" {{ old('state_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label for="city" class="d-block">City</label>
                                        <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id2" id="city_id2">
                                            <option>Please Select</option>
                                        </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                        <label for="pin_code" class="d-block">Pincode</label>
                                        <input class="form-control {{ $errors->has('pin_code') ? 'is-invalid' : '' }}" type="text" name="pin_code2" id="pin_code2" value="{{ old('pin_code', '') }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label for="country" class="d-block">Country</label>
                                        <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id2" id="country_id2">
                                            @foreach($countries as $id => $entry)
                                                <option value="{{ $id }}" {{ old('country_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="form-group col-12">
                            <label for="notes">Notes</label>
                            <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes" value="{{ $customer->notes }}">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row">
                                <div class="col-md-4">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label for="pan_no">Pan No.</label>
                                    <input class="form-control {{ $errors->has('pan_no') ? 'is-invalid' : '' }}" type="text" name="pan_no" id="pan_no" value="{{ $customer->pan_no }}">
                                    </div>
                                    <div class="form-group col-md-12">
                                    <label for="tan">TAN</label>
                                    <input class="form-control {{ $errors->has('tan') ? 'is-invalid' : '' }}" type="text" name="tan" id="tan" value="{{ $customer->tan_no }}">
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
                        <div class="tab-pane fade" id="bill" role="tabpanel" aria-labelledby="bill-tab">
                            <div class="row">
                                <div class="col-md-4">
                                <div class="form-group col-md-12">
                                    <label for="inputState">Preferred payment method</label>
                                    <select class="form-control" name="payment_method" id="payment_method">
                                        <option value disabled {{ old('payment_method', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\Customer::PAYMENT_METHOD_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('payment_method', $customer->payment_method) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputState">Invoice delivery method</label>
                                    <select class="form-control" name="delivery_method" id="delivery_method">
                                        <option value disabled {{ old('delivery_method', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\Customer::DELIVERY_METHOD_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('delivery_method', $customer->delivery_method) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-8">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                    <label for="term_id_inv">Credit Period</label>
                                    <select class="form-control select2 {{ $errors->has('term') ? 'is-invalid' : '' }}" name="term_id_inv" id="term_id">
                                        @foreach($terms as $id => $entry)
                                            <option value="{{ $id }}" {{ old('term_id_inv',$customer->term->id) == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label for="inputState">Opening balance</label>
                                    {{-- <select id="inputState" class="form-control">
                                        <option selected>Bill with parent</option>
                                        <option>...</option>
                                    </select> --}}
                                    <input type="text" class="form-control" name="balance" id="balance" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label for="inputState">as of</label>
                                    <input type="date" class="form-control" id="balance_date" name="balance_date" placeholder="">
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="attach" role="tabpanel" aria-labelledby="attach-tab">
                            <div class="form-group">
                            <label for="exampleFormControlFile1">Attachments</label>
                            <div class="needsclick dropzone {{ $errors->has('attachment') ? 'is-invalid' : '' }}" id="attachment-dropzone">
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer justify-content-between text-right">        
            <button type="submit" id="customerSave" class="btn btn-primary rounded-pill">Save</button>
        </div>
    </div>
 
  <!-- Category Modal -->
  <div class="modal fade" id="categoryModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="" action="" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label class="required" for="category">Name</label>
                <input class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" type="text" name="category" id="category" value="{{ old('category', '') }}" required>
                @if($errors->has('category'))
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
                <span class="help-block"></span>
              </div>
            </form>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="submit" id="category_save" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
 </div>

  <!-- Account Type Modal -->
  <div class="modal fade" id="accountTypeModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Account Type</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="" action="" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label class="required">{{ trans('cruds.accountType.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AccountType::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.accountType.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.accountType.fields.account_group') }}</label>
                <select class="form-control {{ $errors->has('account_group_id') ? 'is-invalid' : '' }}" name="account_group_id" id="account_group_id" required>
                    <option value disabled {{ old('account_group_id', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AccountType::ACCOUNT_GROUP_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('account_group_id', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('account_group_id'))
                    <span class="text-danger">{{ $errors->first('account_group_id') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.accountType.fields.account_group_helper') }}</span>
            </div>
              <div class="form-group">
                <label class="required" for="acc_type">Name</label>
                <input class="form-control {{ $errors->has('acc_type') ? 'is-invalid' : '' }}" type="text" name="acc_type" id="acc_type" value="{{ old('acc_type', '') }}" required>
                @if($errors->has('acc_type'))
                    <span class="text-danger">{{ $errors->first('acc_type') }}</span>
                @endif
                <span class="help-block"></span>
              </div>
            </form>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="submit" id="acc_type_save" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
 </div>

  <!-- Account Names Modal -->
  <div class="modal fade" id="accountNameModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Account Name</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="" action="" enctype="multipart/form-data">
              @csrf
              <div class="form-group" id="accTypeContent">
                <label class="required d-block" for="account_type">{{ trans('cruds.accountName.fields.account_type') }}</label>
                <select class="form-control select2 {{ $errors->has('account_type') ? 'is-invalid' : '' }}" name="account_type" id="account_type" required>
                    {{--@foreach($account_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('account_type') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach--}}
                </select>
                @if($errors->has('account_type'))
                    <span class="text-danger">{{ $errors->first('account_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.accountName.fields.account_type_helper') }}</span>
            </div>
              <div class="form-group">
                <label class="required" for="acc_name">Name</label>
                <input class="form-control {{ $errors->has('acc_name') ? 'is-invalid' : '' }}" type="text" name="acc_name" id="acc_name" value="{{ old('acc_name', '') }}" required>
                @if($errors->has('acc_name'))
                    <span class="text-danger">{{ $errors->first('acc_name') }}</span>
                @endif
                <span class="help-block"></span>
              </div>
            </form>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="submit" id="acc_name_save" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
 </div>

  <!-- Credit Period Modal -->
  <div class="modal fade" id="termNameModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 390px;">
      <div class="modal-content">
        <div class="modal-header py-2">
          <h6 class="modal-title" id="exampleModalLabel">New Credit Period</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pt-1">
            <form method="" action="" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                    <label class="required" for="term_name">Name</label>
                    <input class="form-control {{ $errors->has('term_name') ? 'is-invalid' : '' }}" type="text" name="term_name" id="term_name" value="{{ old('term_name', '') }}" required>
                    @if($errors->has('term_name'))
                        <span class="text-danger">{{ $errors->first('term_name') }}</span>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="credit_period1" name="credit_period" class="custom-control-input" value="1">
                        <label class="custom-control-label" for="credit_period1">Due in fixed number of days</label>
                    </div>
                    <div class="form-group row no-gutters credit-p-date">
                        <div class="col-sm-3">
                            <input type="text" class="form-control py-0 h-35" name="days" id="credit_period_days1" value="">
                        </div>
                        <label for="credit_period_days1" class="col-sm-2 ml-1 col-form-label">days</label>
                    </div>
                </div>
                <div class="">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="credit_period2" name="credit_period" class="custom-control-input" value="2">
                        <label class="custom-control-label" for="credit_period2">Due by certain day of the month</label>
                    </div>
                    <div class="form-group row no-gutters credit-p-date">
                        <div class="col-sm-3">
                            <input type="text" class="form-control py-0 h-35" name="day_of_month" id="credit_period_days2">
                        </div>
                        <label for="credit_period_days2 ml-3" class="col-sm-6 ml-1 col-form-label">day of month</label>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="submit" id="term_name_save" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>

 <!-- Terms and Condition Modal -->
 <div class="modal fade" id="termConditionsModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 700px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Terms and Conditions</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="" action="" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                    <label class="required" for="condition_name">Name</label>
                    <input class="form-control {{ $errors->has('condition_name') ? 'is-invalid' : '' }}" type="text" name="condition_name" id="condition_name" value="{{ old('condition_name', '') }}" required>
                    @if($errors->has('condition_name'))
                        <span class="text-danger">{{ $errors->first('condition_name') }}</span>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="term_editor" id="term_editor"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="submit" id="term_condition_save" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
 </div>

 <div class="modal fade" id="groupModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Group</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="" action="" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                    <label class="required" for="group_name">Name</label>
                    <input class="form-control {{ $errors->has('group_name') ? 'is-invalid' : '' }}" type="text" name="group_name" id="group_name" value="{{ old('group_name', '') }}" required>
                    @if($errors->has('group_name'))
                        <span class="text-danger">{{ $errors->first('group_name') }}</span>
                    @endif
                    <span class="help-block"></span>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="submit" id="group_save" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
  @endsection

  @section('scripts')

<script>
    $(document).ready(function(){
        $('#customer_id').select2({
            placeholder: "Please Select",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "{{ route("admin.get-customers") }}",
                dataType: 'json',
                quietMillis: 250,
                data: function (term, page) {
                    return {
                        q: term, // search term
                        company_id: $('#company_id').val()
                    };
                },

                processResults: function (data, params) {
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
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            templateResult: function (data) {
                // $('#credit_period_hdn').val(data.credit_period);
                // $('#credit_period_days_hdn').val(data.credit_period_days);
                // $("#address").val(data.address)
                // $("#ship_address").val(data.address)
            return '<span>' + (data.first_name!=null?data.first_name:'') + (data.phone?(' - '+data.phone):(data.email?' - '+data.email:'')) + '</span>';

            },
            templateSelection: formatRepoSelection
        });

        $('#company_id').select2({
            placeholder: "Please Select",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "{{ route("admin.invoices.get-companies") }}",
                dataType: 'json',
                quietMillis: 250,
                data: function (term, page) {
                    return {
                        q: term, // search term
                    };
                },

                processResults: function (data, params) {
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
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            templateResult: function (data) {
            return '<span>' + (data.name!=null?data.name:'') + '</span>';

            },
            templateSelection: formatRepoSelection
        });

        function formatRepoSelection (repo) {
            return (repo.name && repo.name!=null?repo.name: repo.email?repo.email:repo.text);
        }

        $("#customer_id").change(function(){
            if($(this).val()==0){
            $("#exampleModal").modal('show');
            $('#attachment').dropzone()
            }else{
                $.ajax({
                    url: "{{ route('admin.invoices.get-customer-by-id')}}",
                    type: "get",
                    data: {'cust_id':$(this).val()},
                    success: function(data) {
                        if(data){
                            $('#credit_period_hdn').val(data.credit_period);
                            $('#credit_period_days_hdn').val(data.credit_period_days);
                            $("#address").val(data.address)
                            $("#ship_address").val(data.address)
                        }
                    },
                    error: function(error) {
                        console.log(error, 'err');
                        alert("Error occured");
                    }
                })    
            }
        });

        $('#company_id').change(function(){
            $.ajax({
                url: "{{ route('admin.invoices.get-invoice')}}",
                type: "get",
                data: {'company_id':$(this).val()},
                success: function(data) {
                    if(data){
                        $('#invoice_prefix').val(data.prefix)
                        $('#invoice_no').val(data.invoice_no)
                    }
                },
                error: function(error) {
                    console.log(error, 'err');
                    alert("Error occured");
                }
            })
        })

        $('#invoice_prefix').change(function(){
            $.ajax({
                url: "{{ route('admin.invoices.get-invoice')}}",
                type: "get",
                data: {'company_id':$('#company_id').val(), 'invoice_prefix': $(this).val()},
                success: function(data) {
                    if(data){
                        // $('#invoice_prefix').val(data.prefix)
                        $('#invoice_no').val(data.invoice_no)
                    }
                },
                error: function(error) {
                    console.log(error, 'err');
                    alert("Error occured");
                }
            })
        })

        $('#exampleModal').on('hidden.bs.modal', function () {
                $("#customer_id").val(null);
        })

        $('#group').select2({
            placeholder: "Please Select",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "{{ route("admin.get-groups") }}",
                dataType: 'json',
                quietMillis: 250,
                data: function (term, page) {
                    return {
                        q: term, // search term
                    };
                },

                processResults: function (data, params) {
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
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            templateResult: function (data) {
            return '<span>' + (data.name!=null?data.name:'') + (data.phone?(' - '+data.phone):(data.email?' - '+data.email:'')) + '</span>';
            },
            templateSelection: formatRepoSelection1
        });

        function formatRepoSelection1 (repo) {
            return (repo.name && repo.name!=null?repo.name:repo.text);

        }

        $("#group").change(function(){
            if($(this).val()==0){
            $("#groupModal").modal('show');
            }else{


            }

        });

        $('#groupModal').on('hidden.bs.modal', function () {
                $("#group").val(null);
        })

        $("#gst_type").change(function(){
            var val = $(this).val();
            if(val != 3)
            {
                $("#gstin").prop('disabled',false)
                $("#gst_customer_name").prop('disabled',false)

            }else{
                $("#gstin").prop('disabled',true)
                $("#gst_customer_name").prop('disabled',true)
            }
        })

        $("#gstin").change(function(){
            var gst_no = $(this).val();
            var test_gst = /^([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([0-9]){1}([a-zA-Z]){1}([0-9]){1}?$/;
            if(test_gst.test(gst_no)) {
                $("#gst_error").text('');
                $.ajax({
                    url: "{{ route('admin.customers.gst')}}",
                    type: "get",
                    data: {'gst_no':gst_no,'_token':$('input[name="_token"]').val()},
                    success: function(data) {
                    console.log(data)
                    $("#bill_address1").val(data.taxpayerInfo.pradr.addr.bno + ', '+data.taxpayerInfo.pradr.addr.dst + ', '+data.taxpayerInfo.pradr.addr.stcd)
                    $("#bill_address2").val(data.taxpayerInfo.pradr.addr.loc + ', '+data.taxpayerInfo.pradr.addr.dst + ', '+data.taxpayerInfo.pradr.addr.stcd)
                    $("#pin_code").val(data.taxpayerInfo.pradr.addr.pncd)
                    // $("#gst_customer_name").val(data.taxpayerInfo.lgnm)
                    $("#pan_no").val(data.taxpayerInfo.panNo)
                    // $("#city_id").val(data.taxpayerInfo.pradr.addr.dst)
                    // $("city_id select").val(data.taxpayerInfo.pradr.addr.dst).change();
                    $("#state_id").val(data.taxpayerInfo.pradr.addr.stcd)
                    $('#state_id option[value="'+data.taxpayerInfo.pradr.addr.stcd+'"]').attr('selected','selected');
                    $("#company").val(data.taxpayerInfo.tradeNam)


                    },
                    error: function(error) {
                        console.log(error, 'err');
                        alert("Error occured");
                    }
                })

            }else{
                flag = "Invalid GST number ";
                $("#gst_error").text(flag).css('color','red');
                //alert(flag);
            }

        })

        $("#state_id").change(function(){
                var state = $("#state_id").val();
                $.ajax({
                    url: "{{ route('admin.get-city')}}",
                    type: "get",
                    data: {'state':state,'_token':$('input[name="_token"]').val()},
                    success: function(data) {
                        if(data.length != 0){
                                console.log(data)
                                $.each(data,function(index,city){
                                $('#city_id').append("<option value='"+city.id+"'>"+city.name+"</option> ");
                                })
                        }
                    },
                    error: function(error) {
                        console.log(error, 'err');
                        alert("Error occured");
                    }
                })
        });

        $("#title").change(function(){
            $("#display").val($("#title").val())
        })
        $("#first_name").change(function(){
            $("#display").val($("#title").val()+' '+$("#first_name").val())
        })
        $("#middle_name").change(function(){
            $("#display").val($("#title").val()+' '+$("#first_name").val()+' '+$("#middle_name").val())
        })
        $("#last_name").change(function(){
            $("#display").val($("#title").val()+' '+$("#first_name").val()+' '+$("#middle_name").val()+' '+$("#last_name").val())
        })

        $("#same_as_bill").change(function(){
            $("#same_as_bill").val('')
            $("#same_as_bill").val('1')
            $("#ship_address1").val($("#bill_address1").val())
            $("#ship_address2").val($("#bill_address2").val())
            $("#pin_code2").val($("#pin_code").val())
            $("#state_id2").val($("#state_id").val()).trigger('change');
            $("#country_id2").val($("#country_id").val()).trigger('change');
        })

        $("#state_id2").change(function(){
            var state = $("#state_id").val();
            $.ajax({
                url: "{{ route('admin.get-city')}}",
                type: "get",
                data: {'state':state,'_token':$('input[name="_token"]').val()},
                success: function(data) {
                    if(data.length != 0){
                            console.log(data)
                            $.each(data,function(index,city){
                            $('#city_id2').append("<option value='"+city.id+"'>"+city.name+"</option> ");
                            })
                    }
                },
                error: function(error) {
                    console.log(error, 'err');
                    alert("Error occured");
                }
            })
        });

        $("#invoice_request").change(function(){
            alert($("#invoice_request").val())
            if($("#invoice_request").val() == 0)
            {
                $("#invoice_request").val('1')
            }else{
                $("#invoice_request").val('0')
            }

        })

        $('input[name="credit_period"]').change(function(){
            $('input[name="credit_period"]').attr('checked',false)
            if($(this).val() == '1')
            {

                $(this).attr('checked',true)
                $("#credit_period_days1").attr('disabled',false)
                $("#credit_period_days2").attr('disabled',true)
                $("#credit_period_days2").val('')
            }else{
                $(this).attr('checked',true)
                $("#credit_period_days1").attr('disabled',true)
                $("#credit_period_days2").attr('disabled',false)
                $("#credit_period_days1").val('')
            }
        })

        $('.product_id').select2({
            placeholder: "Please Select",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "{{ route("admin.get-products") }}",
                dataType: 'json',
                quietMillis: 250,
                data: function (term, page) {
                    return {
                        q: term, // search term
                    };
                },

                processResults: function (data, params) {
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
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            templateResult: function (data) {
            return '<span>' + (data.name!=null?data.name:'') + (data.phone?(' - '+data.phone):(data.email?' - '+data.email:'')) + '</span>';
            },
            templateSelection: formatRepoSelection
        });

        function formatRepoSelection (repo) {
            return (repo.name && repo.name!=null?repo.name: repo.email?repo.email:repo.text);

        }

        $(document).on('change','.product_id',function(){
            var _this = $(this);
            if($(this).val()==0){
            $("#productModal").modal('show');
            }else{
                $.ajax({
                    url: "{{ route('admin.invoices.get-product_detail')}}",
                    type: "get",
                    data: {'id':_this.val()},
                    success: function(data) {
                        _this.closest('tr').find('#hsn_sac').val(data.hsn);
                        _this.closest('tr').find('#description_inv').val(data.description);
                        _this.closest('tr').find('#tax_gst').val(data.gst);
                        _this.closest('tr').find('#tax_gst').trigger('change');
                        if(data.item_type == 'S'){
                            _this.closest('tr').find('.service_date_td').removeClass('d-none');
                            $('.service_date_th').removeClass('d-none')
                        } else {
                            _this.closest('tr').find('.service_date_td').addClass('d-none');
                        }
                    },
                    error: function(error) {
                        console.log(error, 'err');
                        alert("Error occured");
                    }
                })
            }
        });

        $('#productModal').on('hidden.bs.modal', function () {
                $("#product_id").val(null);
        })

        $("input[name='item_type']").change(function(){
            var item_type = $("input[name='item_type']:checked").val();
            $('input[name="item_type"]').attr('checked',false)
                if($(this).val() == 'G')
                {
                $(this).attr('checked',true)
                if ($("#hsn_label").hasClass("d-none")) {
                    $("#hsn_label").removeClass('d-none')
                    $("#hsn_label").addClass('d-block')
                }

                $("#sac_label").removeClass('d-block')
                $("#sac_label").addClass('d-none')
                }else{
                $(this).attr('checked',true)
                $("#sac_label").removeClass('d-none')
                $("#sac_label").addClass('d-block')
                $("#hsn_label").removeClass('d-block')
                $("#hsn_label").addClass('d-none')
                }
        })


        $('#categories').select2({
            placeholder: "Please Select",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "{{ route("admin.get-category") }}",
                dataType: 'json',
                quietMillis: 250,
                data: function (term, page) {
                    return {
                        q: term, // search term
                    };
                },

                processResults: function (data, params) {
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
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            templateResult: function (data) {
            return '<span>' + (data.name!=null?data.name:'') + (data.phone?(' - '+data.phone):(data.email?' - '+data.email:'')) + '</span>';
            },
            templateSelection: formatcatRepoSelection
        });

        function formatcatRepoSelection (repo) {
            return (repo.name && repo.name!=null?repo.name: repo.email?repo.email:repo.text);

        }

        $("#categories").change(function(){
            if($(this).val()==0){
            $("#categoryModal").modal('show');
            }else{


            }

        });

        $("#category_save").click(function(){
            var category = $("#category").val();

            $.ajax({
                url: "{{ route('admin.category-store')}}",
                type: "get",
                data: {'category':category,'_token':$('input[name="_token"]').val()},
                success: function(data) {
                $("#categoryModal").modal('hide');
                    if(data.length != 0){
                            console.log(data)
                            $('#categories').append("<option value='"+data.id+"' selected>"+data.name+"</option> ");

                    }
                },
                error: function(error) {
                    console.log(error, 'err');
                    alert("Error occured");
                }
            })
        });

        $('#categoryModal').on('hidden.bs.modal', function () {
                $("#categories").val(null);
        })

        $('#account_type_id').select2({
            placeholder: "Please Select",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "{{ route("admin.get-account-types") }}",
                dataType: 'json',
                quietMillis: 250,
                data: function (term, page) {
                    return {
                        q: term, // search term
                    };
                },

                processResults: function (data, params) {
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
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            templateResult: function (data) {
            return '<span>' + (data.name!=null?data.name:'') + (data.phone?(' - '+data.phone):(data.email?' - '+data.email:'')) + '</span>';
            },
            templateSelection: formatacctypeRepoSelection1
        });

        function formatacctypeRepoSelection1 (repo) {
            return (repo.name && repo.name!=null?repo.name: repo.email?repo.email:repo.text);

        }

        $("#account_type_id").change(function(){
            if($(this).val()==0){
            $("#accountTypeModal").modal('show');
            }else{
            }
        });

        $('#accountTypeModal').on('hidden.bs.modal', function () {
                $("#account_type_id").val(null);
        })

        $("#acc_type_save").click(function(){
            var acc_type = $("#acc_type").val();

            $.ajax({
                url: "{{ route('admin.account-types-store')}}",
                type: "get",
                data: {'type':$("#type").val(),'account_group':$("#account_group_id").val(),'acc_type':acc_type,'_token':$('input[name="_token"]').val()},
                success: function(data) {
                $("#accountTypeModal").modal('hide');
                    if(data.length != 0){
                            console.log(data)
                            $('#account_type_id').append("<option value='"+data.id+"' selected>"+data.name+"</option> ");

                    }
                },
                error: function(error) {
                    console.log(error, 'err');
                    alert("Error occured");
                }
            })
        });

        $('#account_name_id').select2({
            placeholder: "Please Select",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "{{ route("admin.get-account-names") }}",
                dataType: 'json',
                quietMillis: 250,
                data: function (term, page) {
                    return {
                        q: term, // search term
                    };
                },

                processResults: function (data, params) {
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
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            templateResult: function (data) {
            return '<span>' + (data.name!=null?data.name:'') + (data.phone?(' - '+data.phone):(data.email?' - '+data.email:'')) + '</span>';
            },
            templateSelection: formataccnameRepoSelection2
        });

        function formataccnameRepoSelection2 (repo) {
            return (repo.name && repo.name!=null?repo.name: repo.email?repo.email:repo.text);

        }

        $("#account_name_id").change(function(){
            if($(this).val()==0){
            $("#accountNameModal").modal('show');
            }else{
            }
        });

        $('#accountNameModal').on('hidden.bs.modal', function () {
                $("#account_name_id").val(null);
        })

        $("#acc_name_save").click(function(){
            var acc_name = $("#acc_name").val();

            $.ajax({
                url: "{{ route('admin.account-names-store')}}",
                type: "get",
                data: {'account_type':$("#account_type").val(),'acc_name':acc_name,'_token':$('input[name="_token"]').val()},
                success: function(data) {
                $("#accountNameModal").modal('hide');
                    if(data.length != 0){
                            console.log(data)
                            $('#account_name_id').append("<option value='"+data.id+"' selected>"+data.name+"</option> ");

                    }
                },
                error: function(error) {
                    console.log(error, 'err');
                    alert("Error occured");
                }
            })
        });

        $('#terms_and_condition_id').select2({
            placeholder: "Please Select",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "{{ route("admin.get-termCondition") }}",
                dataType: 'json',
                quietMillis: 250,
                data: function (term, page) {
                    return {
                        q: term, // search term
                    };
                },

                processResults: function (data, params) {
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
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            templateResult: function (data) {
            return '<span>' + (data.name!=null?data.name:'') + (data.phone?(' - '+data.phone):(data.email?' - '+data.email:'')) + '</span>';
            },
            templateSelection: formatTermConditionRepoSelection
        });

        function formatTermConditionRepoSelection (repo) {
            return (repo.name && repo.name!=null?repo.name: repo.email?repo.email:repo.text);

        }

        $("#terms_and_condition_id").change(function(){
            if($(this).val()==0){
            $("#termConditionsModal").modal('show');
            }else{
            }
        });

        $('#termConditionsModal').on('hidden.bs.modal', function () {
                $("#terms_and_condition_id").val(null);
        })

        $("#term_condition_save").click(function(){
            var condition_name = $("#condition_name").val();
            var term_editor = $("#term_editor").val();

            $.ajax({
                url: "{{ route('admin.store-termCondition')}}",
                type: "get",
                data: {'condition_name':condition_name,'term_editor':term_editor,'_token':$('input[name="_token"]').val()},
                success: function(data) {
                $("#termConditionsModal").modal('hide');
                    if(data.length != 0){
                            console.log(data)
                            $('#terms_and_condition_id').append("<option value='"+data.id+"' selected>"+data.name+"</option> ");

                    }
                },
                error: function(error) {
                    console.log(error, 'err');
                    alert("Error occured");
                }
            })
        });

        $('#term_id_inv, #term_id').select2({
            placeholder: "Please Select",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "{{ route("admin.get-terms") }}",
                dataType: 'json',
                quietMillis: 250,
                data: function (term, page) {
                    return {
                        q: term, // search term
                    };
                },

                processResults: function (data, params) {
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
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            templateResult: function (data) {
            return '<span>' + (data.name!=null?data.name:'') + (data.phone?(' - '+data.phone):(data.email?' - '+data.email:'')) + '</span>';
            },
            templateSelection: formattermRepoSelection2
        });

        function formattermRepoSelection2 (repo) {
            return (repo.name && repo.name!=null?repo.name: repo.email?repo.email:repo.text);
        }

        $("#term_id_inv,#term_id").change(function(){
            if($(this).val()==0){
             $("#termNameModal").modal('show');
            }else{
            }
        });

        $('#termNameModal').on('hidden.bs.modal', function () {
                // $("#term_id").val(null);
                // $("#term_id_inv").val(null);
        })

        $("#term_name_save").click(function(){
            var term_name = $("#term_name").val();
            var credit_period = $("input[name='credit_period']:checked").val();
            var credit_period_days1 = $("#credit_period_days1").val();
            var credit_period_days2 = $("#credit_period_days2").val();
            var credit_period1 = $("#credit_period1").val();
            var credit_period2 = $("#credit_period2").val();

            $.ajax({
                url: "{{ route('admin.term-store')}}",
                type: "get",
                data: {'term_name':term_name,'credit_period':credit_period,'credit_period1':credit_period1,'credit_period2':credit_period2,'credit_period_days1':credit_period_days1,'credit_period_days2':credit_period_days2,'_token':$('input[name="_token"]').val()},
                success: function(data) {
                $("#termNameModal").removeClass('show');
                $("#term_name").val('');
                $("#credit_period_days1").val('');
                $("#credit_period_days2").val('');
                    if(data.length != 0){
                        console.log(data)
                        $('#term_id').val(null).trigger('change');
                        $('#term_id').append("<option value='"+data.id+"' selected>"+data.name+"</option> ");
                        $("#term_id").trigger('change');
                    }
                },
                error: function(error) {
                    console.log(error, 'err');
                    alert("Error occured");
                }
            })
        });

        $("#product_save").click(function(){
            var item_type = $("input[name='item_type']:checked").val();
            var hsn = $("#hsn").val()
            var sac = $("#sac").val()
            if(item_type == 'G')
            {
                var hsn_code = hsn;
            }else{
                var hsn_code = sac;
            }
            var product_name = $("#product_name").val()
            var description = $("#description").val()

            var unit = $("#unit").val()
            var categories = $("#categories").val()
            var sales_price = $("#sales_price").val()
            var gst = $("#gst").val()
            var tax_type = $("input[name='tax_type']").val()
            var cess = $("#cess").val()
            var cess_type = $("#cess_type").val()
            var purchase_price = $("#purchase_price").val()
            var price_type = $("#price_type").val()
            var wholesale_price = $("#wholesale_price").val()
            var item_code = $("#item_code").val()
            var income_account_type = $("#income_account_type").val()
            var account_group = $("#account_group").val()
            var account_type_id = $("#account_type_id").val()
            var account_name_id = $("#account_name_id").val()
            alert(hsn_code);


            $.ajax({
                url: "{{ route('admin.products-store')}}",
                type: "get",
                data: {
                        'item_type':item_type,
                        'name' : product_name,
                        'description' : description,
                        'hsn' : hsn_code,
                        'unit' : unit,
                        'categories' : categories,
                        'sales_price' : sales_price,
                        'gst' : gst,
                        'tax_type' : $("input[name='tax_type']").val(),
                        'cess' : cess,
                        'cess_type' : cess_type,
                        'purchase_price' : purchase_price,
                        'price_type' : price_type,
                        'wholesale_price' : wholesale_price,
                        'item_code' : item_code,
                        'income_account_type' : income_account_type,
                        'account_group' : account_group,
                        'account_type_id' : account_type_id,
                        'account_name_id' : account_name_id,
                        '_token':$('input[name="_token"]').val()
                },
                success: function(data) {
                $("#productModal").modal('hide');
                    if(data.length != 0){
                            console.log(data)
                            $('#product_id').append("<option value='"+data.id+"' selected>"+data.name+"</option> ");

                    }
                },
                error: function(error) {
                    console.log(error, 'err');
                    alert("Error occured");
                }
            })
        });

        $("#add_lines").click(function () {
            $(".product_class").select2('destroy');
            $("#product_table").each(function () {
                var count = $(".product_class").length;
                var tds = '<tr data-index="'+(count+1)+'">';
                var _this = '';
                $.each($('tr:last td', this), function (key,value) {

                    if(key == 1)
                    {
                        $(this).find('select').attr('data-attr',count+1)
                    }
                    if($(this).is(':visible')){
                        tds += '<td>' + $(this).html() + '</td>';
                    } else {
                        tds += '<td class="service_date_td d-none">' + $(this).html() + '</td>';
                    }
                    

                    if(key == 1)
                    {
                        $(this).find('select').attr('data-attr',count)
                    }
                });
                tds += '</tr>';
                if ($('tbody', this).length > 0) {
                    $('tbody', this).append(tds);


                } else {
                    $(this).append(tds);
                }
                $('.tax_gst:last').removeAttr('before_data')

                $(".product_class").select2({
                    placeholder: "Please Select",
                    minimumInputLength: 1,
                    ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                        url: "{{ route("admin.get-products") }}",
                        dataType: 'json',
                        quietMillis: 250,
                        data: function (term, page) {
                            return {
                                q: term, // search term
                            };
                        },

                        processResults: function (data, params) {
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
                    escapeMarkup: function (markup) { return markup; },
                    minimumInputLength: 3,
                    templateResult: function (data) {
                    return '<span>' + (data.name!=null?data.name:'') + (data.phone?(' - '+data.phone):(data.email?' - '+data.email:'')) + '</span>';
                    },
                    templateSelection: formatRepoSelection
                    });

                    $('.product_class').change(function(){
                        if($(this).val()==0){
                        var dataValue = $(this).attr('data-attr')
                        $("#checkModal").val(dataValue)
                        $("#productModal").modal('show');
                        }else{
                        }

                    });

                    $("#product_save").click(function(){
                        var item_type = $("input[name='item_type']:checked").val();
                        var hsn = $("#hsn").val()
                        var sac = $("#sac").val()
                        var hsn_code = '';
                        if(item_type == 'G')
                        {
                            hsn_code = hsn;
                        }else{
                            hsn_code = sac;
                        }
                        var product_name = $("#product_name").val()
                        var description = $("#description").val()

                        var unit = $("#unit").val()
                        var categories = $("#categories").val()
                        var sales_price = $("#sales_price").val()
                        var gst = $("#gst").val()
                        var tax_type = $("input[name='tax_type']").val()
                        var cess = $("#cess").val()
                        var cess_type = $("#cess_type").val()
                        var purchase_price = $("#purchase_price").val()
                        var price_type = $("#price_type").val()
                        var wholesale_price = $("#wholesale_price").val()
                        var item_code = $("#item_code").val()
                        var income_account_type = $("#income_account_type").val()
                        var account_group = $("#account_group").val()
                        var account_type_id = $("#account_type_id").val()
                        var account_name_id = $("#account_name_id").val()


                        $.ajax({
                            url: "{{ route('admin.products-store')}}",
                            type: "get",
                            data: {
                                'item_type':item_type,
                                'name' : product_name,
                                'description' : description,
                                'hsn' : hsn_code,
                                'unit' : unit,
                                'categories' : categories,
                                'sales_price' : sales_price,
                                'gst' : gst,
                                'tax_type' : $("input[name='tax_type']").val(),
                                'cess' : cess,
                                'cess_type' : cess_type,
                                'purchase_price' : purchase_price,
                                'price_type' : price_type,
                                'wholesale_price' : wholesale_price,
                                'item_code' : item_code,
                                'income_account_type' : income_account_type,
                                'account_group' : account_group,
                                'account_type_id' : account_type_id,
                                'account_name_id' : account_name_id,
                                '_token':$('input[name="_token"]').val()
                            },
                            success: function(data) {
                            $("#productModal").modal('hide');
                                if(data.length != 0){
                                        console.log(data)
                                        var dataValue = $("#checkModal").val()
                                        $(".product_class").each(function(){
                                            debugger
                                            if($(this).attr('data-attr') == dataValue)
                                            {
                                                $(this).append("<option value='"+data.id+"' selected>"+data.name+"</option> ");
                                            }

                                        })


                                }
                            },
                            error: function(error) {
                                console.log(error, 'err');
                                alert("Error occured");
                            }
                        })
                    });
            });

        });

        $("#clear_lines").on('click',function(){
            $('#product_table tr:last').remove();
        });

        $(document).on('change','.rate',function(){
            // var amount_total = 0;
            // var quantity = parseFloat($(this).parent().prev('td').find('input').val(), 10);
            // var rate = parseFloat($(this).val(), 10);
            // var amount =$(this).parent().next('td').find('input').val(quantity * rate)
            // $(".amount_inv").each(function(){
            //     amount_total += parseFloat($(this).val(), 10);
            // })


            // $("#subtotal").text('₹'+amount_total);
            // $("#total").text('₹'+ amount_total)
            // $("#balance_due").text('₹'+ amount_total)
            // $("#balance_due2").text('₹'+ amount_total)
            var _this = $(this).closest('tr').find('.tax_gst')
            calculateCgstSgst(_this)

        })

        $(document).on('change','.quantity',function(){
            var amount_total = 0;
            var quantity = parseFloat($(this).val(), 10);
            var rate = parseFloat($(this).parent().next('td').find('input').val(), 10);
            var amount = $(this).parent().next('td').next('td').find('input').val(quantity * rate);
            $(".amount_inv").each(function(){
                amount_total += parseFloat($(this).val(), 10);
            })

            $("#subtotal").text('₹'+amount_total);
            $("#total").text('₹'+ amount_total)
            $("#balance_due").text('₹'+ amount_total)
            $("#balance_due2").text('₹'+ amount_total)

        })

        var gst_element = {};
        var gst_updated_element = [];

        var total_gst_amt = 0;


        $(document).on('change','.tax_gst',function(){
            
            calculateCgstSgst($(this))

        })

        function calculateCgstSgst(_this){
            debugger;
            if(_this.val() == null){
                return true;
            }
            var old_gst = _this.attr('before_data');
            if(old_gst != undefined)
            {
                var isDeleteable = true;
                $.each($('.tax_gst'), function(){
                    var old_value = $(this).val()
                    if(old_gst == old_value){
                        isDeleteable = false;
                    }
                })
                if(isDeleteable){
                    var get_old_half_gst_amt = gst_element['gst_'+old_gst]['half_gst_amt'];
                    total_gst_amt -= get_old_half_gst_amt*2;
                    delete gst_element['gst_'+old_gst];
                }
                
            }
            _this.attr('before_data',_this.val());

            var amount_total = 0;

            var current_tax_gst = parseFloat(_this.val());

            var half_gst = parseFloat(current_tax_gst/2);
            var count = _this.parent().prev('td').prev('td').prev('td').prev('td').prev('td').prev('td').find('select').attr('data-attr');
            var current_index = _this.parent().parent().attr('data-index');

            var quantity = parseFloat(_this.parent().prev('td').prev('td').prev('td').find('input').val(), 2);
            var rate = parseFloat(_this.parent().prev('td').prev('td').find('input').val(), 2);
            if(isNaN(rate))
            {
                rate = 0;
            }
            var amount = _this.parent().prev('td').find('input').val(quantity * rate);
            var flag = false;
            $(".amount_inv").each(function(){
                amount_total += parseFloat($(this).val(), 3);
            })
            var gst_amt = parseFloat((quantity*rate)*(current_tax_gst/100));
            var half_gst_amt = parseFloat(gst_amt/2);
            total_gst_amt += gst_amt;


            if(gst_element['gst_'+current_tax_gst])
            {
                var old_half_gst_amt = gst_element['gst_'+current_tax_gst]['half_gst_amt'];
                half_gst_amt += old_half_gst_amt;
                var old_rate = gst_element['gst_'+current_tax_gst]['rate'];
                rate += old_rate;
                var old_amt = gst_element['gst_'+current_tax_gst]['gst_value'];
                amount_total += total_gst_amt;
            }else{
                amount_total += total_gst_amt;
            }
            let cgst = `<tr class="cgst" data-amount="`+rate+`" data-gst_value="`+amount_total+`">
                <td scope="row" class="cgst_head_1">CGST @ `+half_gst+`% on `+rate+`</td>
                <td class="text-right cgst_1" id="cgst"><input type="text" name="cgst[]" class="form-control" value="`+half_gst_amt+`"></td>
            </tr>
            <tr class="sgst" data-amount="`+rate+`" data-gst_value="`+amount_total+`">
                <td scope="row" class="sgst_head_1 sgst">SGST @ `+half_gst+`% on `+rate+`</td>
                <td class="text-right sgst_1" id="sgst"><input type="text" name="sgst[]" class="form-control" value="`+half_gst_amt+`"></td>
            </tr>`

            let igst = `<tr class="igst" data-amount="`+rate+`" data-gst_value="`+amount_total+`">
                <td scope="row" class="igst_head_1 igst">IGST @ `+current_tax_gst+`% on `+rate+`</td>
                <td class="text-right igst_1" id="igst"><input type="text" name="igst[]" class="form-control" value="`+gst_amt+`"></td>
            </tr>`

                gst_element['gst_'+current_tax_gst]= [];
                gst_element['gst_'+current_tax_gst]['gst_value']= gst_amt;
                gst_element['gst_'+current_tax_gst]['value'] = cgst;
                gst_element['gst_'+current_tax_gst]['rate'] = rate;
                gst_element['gst_'+current_tax_gst]['half_gst_amt'] = half_gst_amt;

                console.log(gst_element);


            $('.cgst,.sgst,.igst').remove();
            $.each(gst_element,function(index,value){

                if(index == 'gst_'+current_tax_gst){

                    $("#total_table tbody").append(value.value);

                }else{

                    $("#total_table tbody").append(value.value);
                }

            })


            $("#subtotal").text('₹'+amount_total);
            $("#total").text('₹'+ amount_total)
            $("#balance_due").text('₹'+ amount_total)
            $("#balance_due2").text('₹'+ amount_total)
        }


        $(document).on('click', '.delete_invoice', function() {
            var tax_gst = parseFloat($(this).parent().prev('td').find('select').val(), 2);

            if(confirm('Are you sure to remove this row ?'))
            {
                $(this).parent().parent().remove();
                console.log(gst_element)
                    delete gst_element['gst_'+tax_gst];
                gst_element = {};
                total_gst_amt = 0;

                $(".tax_gst:first").change()
            }
        })

        $(document).on('change','.amount_tax',function(){
            var amount_tax = $(this).val();
            var amount_total = 0;
            if(amount_tax == 'Inclusive of Tax')
            {
                $("#product_table > tbody > tr").each(function(index,value){
                    var quantity = $(this).find('.quantity').val()
                    var rate = $(this).find('.rate').val()
                    var amount_inv = $(this).find('.amount_inv').val()
                    var tax_gst = $(this).find('.tax_gst').val()
                    $(this).find('.rate').val(parseFloat((rate *(tax_gst/100)), 10) + parseFloat(rate))
                    $(this).find('.amount_inv').val($(this).find('.quantity').val() * $(this).find('.rate').val())
                    amount_total += parseFloat($(this).find('.amount_inv').val(), 10);

                    // $("#subtotal").text('₹'+amount_total);
                    // $("#total").text('₹'+ amount_total)
                    // $("#balance_due").text('₹'+ amount_total)
                    // $("#balance_due2").text('₹'+ amount_total)
                })

            }else if(amount_tax == 'Exclusive of Tax')
            {
                $("#product_table > tbody > tr").each(function(index,value){
                    var quantity = $(this).find('.quantity').val()
                    var rate = $(this).find('.rate').val()
                    var amount_inv = $(this).find('.amount_inv').val()
                    var tax_gst = $(this).find('.tax_gst').val()
                    // Original Cost – [Original Cost x {100/(100+GST%)}]
                    $(this).find('.rate').val(parseFloat((rate * 100)/(100 + parseFloat(tax_gst))))
                    $(this).find('.amount_inv').val($(this).find('.quantity').val() * $(this).find('.rate').val())
                    amount_total += parseFloat($(this).find('.amount_inv').val(), 10);

                    // $("#subtotal").text('₹'+amount_total);
                    // $("#total").text('₹'+ amount_total)
                    // $("#balance_due").text('₹'+ amount_total)
                    // $("#balance_due2").text('₹'+ amount_total)
                })
            }



            // for (var i = 0; i <rate.length; i++)
            // {

            //     // for (var j = 0; j <tax_gst.length; j++)
            //     // {
            //     //     rate[i].value = parseFloat((rate[i].value*(tax_gst[j].value/100)), 10) + parseFloat(rate[i].value);
            //     //     console.log(rate[i].value,'gst_rate')

            //     //     // $('.amount_inv').val(rate[i].value)
            //     // }
            // }


        })
        $("#customerSave").click(function(){
            var data = $('.customer_info_form').serialize();
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
            // var other = $("#other").val();
            // var website = $("#website").val();
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
            // var notes = $("#notes").val();
            // var pan_no = $("#pan_no").val();
            // var tan = $("#tan").val();
            // var country_id2 = $("#country_id2").val();
            // var payment_method = $("#payment_method").val();
            // var delivery_method = $("#delivery_method").val();
            var term_id_inv = $("#term_id").val();
            // var group = $("#group").val();
            $.ajax({
                url: "{{ route('customer.subcustomers.update',[$customer->id])}}",
                type: "post",
                data: {
                    '_token':$('input[name="_token"]').val(),
                    'data':data,
                    'company_id': $('#company_id').val(),
                    'term_id' : term_id_inv
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
                    // 'other' : other,
                    // 'website' : website,
                    // 'address' : address,
                    // 'state_id' : state_id,
                    // 'city_id' : city_id,
                    // 'pin_code' : pin_code,
                    // 'country_id' : country_id,
                    // 'state_id2' : state_id2,
                    // 'address2' : address2,
                    // 'city_id2' : city_id2,
                    // 'pin_code2' : pin_code2,
                    // 'notes' : notes,
                    // 'pan_no' : pan_no,
                    // 'tan' : tan,
                    // 'country_id2' : country_id2,
                    // 'payment_method' : payment_method,
                    // 'delivery_method' : delivery_method,
                    // 'term_id' : term_id_inv,
                    // 'group' : group,
                    // 'same_as_bill': $("#same_As_bill").val()
                },

                success: function(data) {
                if(data.length != 0){
                    console.log(data)
                    // $('#address').val(data.address);
                    // $('#ship_address').val(data.address);
                    // $('#customer_id').append("<option value='"+data.id+"' selected>"+data.title+' '+data.first_name+' '+data.middle_name+' '+data.last_name+"</option> ");
                    // $('#credit_period_hdn').val(data.credit_period);
                    // $('#credit_period_days_hdn').val(data.credit_period_days);

                }
                },
                error: function(error) {
                    console.log(error, 'err');
                    alert("Error occured");
                }
            })
        })
    });

</script>

<script>
   Dropzone.options.attachmentDropzone = {
    url: '{{ route('admin.customers.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="attachment"]').remove()
      $('form').append('<input type="hidden" name="attachment" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="attachment"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
    @if(isset($customer) && $customer->attachment)
        var file = {!! json_encode($customer->attachment) !!}
            this.options.addedfile.call(this, file)
        file.previewElement.classList.add('dz-complete')
        $('form').append('<input type="hidden" name="attachment" value="' + file.file_name + '">')
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
    $('#invoice_date').on('change',function(){
        var cph = $('#credit_period_hdn').val();
        var cpdh = $('#credit_period_days_hdn').val();
        if(cph == 1){
            $('#due_date').val()
        }
    })

    ;(function($, window, document, undefined){
    $("#invoice_date").on("change", function(){

        var cph = $('#credit_period_hdn').val();
        var cpdh = $('#credit_period_days_hdn').val();
        if(cph == 1){
            var date = new Date($(this).val()),
            days = parseInt(cpdh, 10);
            
            if(!isNaN(date.getTime())){
                date.setDate(date.getDate() + days);
                
                $("#due_date").val(date.toInputFormat());
            } else {
            }
        } else {

            var date=new Date(); 
            // var firstDay=new Date(date.getFullYear(), date.getMonth(), 20); 
            let objectDate = new Date(date.getFullYear(), date.getMonth(), 20);
            let day = objectDate.getDate();
            console.log(day.length); // 23

            let month = objectDate.getMonth();
            console.log(month + 1); // 8

            let year = objectDate.getFullYear();
            console.log(year); // 2022
            $("#due_date").val(year+'-'+month+'-'+day);
            
        }

        
    });
    
    
    //From: http://stackoverflow.com/questions/3066586/get-string-in-yyyymmdd-format-from-js-date-object
    Date.prototype.toInputFormat = function() {
       var yyyy = this.getFullYear().toString();
       var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
       var dd  = this.getDate().toString();
       return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
    };
})(jQuery, this, document);
</script>
@endsection