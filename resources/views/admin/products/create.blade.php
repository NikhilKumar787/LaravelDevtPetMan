@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="" enctype="multipart/form-data">
            @csrf
                <div class="">
                    <h5>Product/Service Information</h5>
                    <input type="hidden" id="checkModal" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="required">{{ trans('cruds.product.fields.item_type') }}</label>
                                @foreach (App\Models\Product::ITEM_TYPE_RADIO as $key => $label)
                                    <div class="form-check {{ $errors->has('item_type') ? 'is-invalid' : '' }}">
                                        <input class="form-check-input" type="radio"
                                            id="item_type_{{ $key }}" name="item_type"
                                            value="{{ $key }}"
                                            {{ old('item_type', '') === (string) $key ? 'checked' : '' }}
                                            required>
                                        <label class="form-check-label"
                                            for="item_type_{{ $key }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                                @if ($errors->has('item_type'))
                                    <span class="text-danger">{{ $errors->first('item_type') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.product.fields.item_type_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="required" for="company_id">Select Company</label>
                            <select class="form-control select2 {{ $errors->has('company_id') ? 'is-invalid' : '' }}"
                                name="company_id" id="company_id" required>
                                <option value disabled {{ old('company_id', null) === null ? 'selected' : '' }}>
                                    {{ trans('global.pleaseSelect') }}</option>
                                @foreach ($companies as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('company_id', '') === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('company_id'))
                                <span class="text-danger">{{ $errors->first('company_id') }}</span>
                            @endif
                            <span
                                class="help-block"></span>
                        </div>
                        <div class="col-md-12 d-block" id="product_label">
                            <div class="form-group">
                                <label class="required" for="product_name">Product Name</label>
                                <input
                                    class="form-control {{ $errors->has('product_name') ? 'is-invalid' : '' }}"
                                    style="text-transform: capitalize" type="text" name="product_name"
                                    id="product_name" value="{{ old('name', '') }}" required>
                                @if ($errors->has('product_name'))
                                    <span class="text-danger">{{ $errors->first('product_name') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-12 d-block" id="service_label">
                            <div class="form-group">
                                <label class="required" for="service_name">Service Name</label>
                                <input
                                    class="form-control {{ $errors->has('service_name') ? 'is-invalid' : '' }}"
                                    style="text-transform: capitalize" type="text" name="service_name"
                                    id="service_name" value="{{ old('name', '') }}" required>
                                @if ($errors->has('service_name'))
                                    <span class="text-danger">{{ $errors->first('service_name') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                    <div class="product-img-box">
                        <img src="" alt="">
                    </div>
                    <div class="text-center mt-3">
                        <img src="{{ asset('img/pen.png')}}" alt="">
                        <img src="{{ asset('img/delete.png')}}" alt="">
                    </div>
                    </div> --}}
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="required" for="description">{{ trans('cruds.product.fields.description') }}</label>
                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                    id="description" required>{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-12 d-block" id="hsn_label">
                            <div class="form-group">
                                <label class="required" for="hsn">HSN</label>
                                <input class="form-control {{ $errors->has('hsn') ? 'is-invalid' : '' }}"
                                    type="text" name="hsn" id="hsn" required
                                    value="{{ old('hsn', '') }}">
                                @if ($errors->has('hsn'))
                                    <span class="text-danger">{{ $errors->first('hsn') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.hsn_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-12 d-none" id="sac_label">
                            <div class="form-group">
                                <label class="required" for="sac">SAC</label>
                                <input class="form-control {{ $errors->has('sac') ? 'is-invalid' : '' }}"
                                    type="text" name="sac" id="sac" required
                                    value="{{ old('sac', '') }}">
                                @if ($errors->has('sac'))
                                    <span class="text-danger">{{ $errors->first('sac') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.hsn_helper') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="required" for="unit">{{ trans('cruds.product.fields.unit') }}</label>
                                    <select class="form-control {{ $errors->has('unit') ? 'is-invalid' : '' }}"
                                        name="unit" id="unit" required>
                                        <option value disabled {{ old('unit', null) === null ? 'selected' : '' }}>
                                            {{ trans('global.pleaseSelect') }}</option>
                                        @foreach (App\Models\Product::UNIT_SELECT as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ old('unit', '') === (string) $key ? 'selected' : '' }}>
                                                {{ $key . ' - ' . $label }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('unit'))
                                        <span class="text-danger">{{ $errors->first('unit') }}</span>
                                    @endif
                                    <span
                                        class="help-block">{{ trans('cruds.product.fields.unit_helper') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="d-block"
                                    for="categories">{{ trans('cruds.product.fields.category') }}</label>
                                {{-- <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div> --}}
                                <select
                                    class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}"
                                    name="categories" id="categories">
                                    @foreach ($categories as $id => $category)
                                        <option value="{{ $id }}"
                                            {{ old('categories') == $id ? 'selected' : '' }}>{{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('categories'))
                                    <span class="text-danger">{{ $errors->first('categories') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label 
                                class="required" for="sales_price">{{ trans('cruds.product.fields.rate_exclusive_gst') }}</label>
                                <input
                                    class="form-control {{ $errors->has('sales_price') ? 'is-invalid' : '' }}"
                                    type="number" name="sales_price" id="sales_price" min=0 oninput="validity.valid||(value='');"
                                    value="{{ old('sales_price', '') }}" step="0.01" required>
                                @if ($errors->has('sales_price'))
                                    <span class="text-danger">{{ $errors->first('sales_price') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.product.fields.rate_exclusive_gst_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="gst">{{ trans('cruds.product.fields.gst') }}</label>
                                <select class="form-control {{ $errors->has('gst') ? 'is-invalid' : '' }}"
                                    name="gst" id="gst" required>
                                    <option value disabled {{ old('gst', null) === null ? 'selected' : '' }}>
                                        {{ trans('global.pleaseSelect') }}</option>
                                    @foreach($gsts as $gst)
                                        <option value="{{ $gst->gst }}"
                                            {{ old('gst', '') === (string) $gst->gst ? 'selected' : '' }}>
                                            GST @ {{ $gst->gst }}%</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('gst'))
                                    <span class="text-danger">{{ $errors->first('gst') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.gst_helper') }}</span>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-check mb-2">
                    <div class="form-group">
                        <label>{{ trans('cruds.product.fields.tax_type') }}</label>
                        @foreach (App\Models\Product::TAX_TYPE_RADIO as $key => $label)
                            <div class="form-check {{ $errors->has('tax_type') ? 'is-invalid' : '' }}">
                                <input class="form-check-input" type="radio" id="tax_type_{{ $key }}" name="tax_type" value="{{ $key }}" {{ old('tax_type', '') === (string) $key ? 'checked' : '' }}>
                                <label class="form-check-label" for="tax_type_{{ $key }}">{{ $label }}</label>
                            </div>
                        @endforeach
                        @if ($errors->has('tax_type'))
                            <span class="text-danger">{{ $errors->first('tax_type') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.tax_type_helper') }}</span>
                    </div>
                </div> --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cess">{{ trans('cruds.product.fields.cess') }}</label>
                                <input class="form-control {{ $errors->has('cess') ? 'is-invalid' : '' }}"
                                    type="number" name="cess" id="cess" min=0 oninput="validity.valid||(value='');"
                                    value="{{ old('cess', '') }}" step="1">
                                @if ($errors->has('cess'))
                                    <span class="text-danger">{{ $errors->first('cess') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.cess_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('cruds.product.fields.cess_type') }}</label>
                                <select class="form-control {{ $errors->has('cess_type') ? 'is-invalid' : '' }}"
                                    name="cess_type" id="cess_type">
                                    <option value disabled
                                        {{ old('cess_type', null) === null ? 'selected' : '' }}>
                                        {{ trans('global.pleaseSelect') }}</option>
                                    @foreach (App\Models\Product::CESS_TYPE_SELECT as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ old('cess_type', '') === (string) $key ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('cess_type'))
                                    <span class="text-danger">{{ $errors->first('cess_type') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.product.fields.cess_type_helper') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label
                                    for="purchase_price">{{ trans('cruds.product.fields.purchase_price') }}</label>
                                <input
                                    class="form-control {{ $errors->has('purchase_price') ? 'is-invalid' : '' }}"
                                    type="number" name="purchase_price" id="purchase_price" min=0 oninput="validity.valid||(value='');"
                                    value="{{ old('purchase_price', '') }}" step="0.01">
                                @if ($errors->has('purchase_price'))
                                    <span class="text-danger">{{ $errors->first('purchase_price') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.product.fields.purchase_price_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('cruds.product.fields.price_type') }}</label>
                                <select
                                    class="form-control {{ $errors->has('price_type') ? 'is-invalid' : '' }}"
                                    name="price_type" id="price_type">
                                    <option value disabled
                                        {{ old('price_type', null) === null ? 'selected' : '' }}>
                                        {{ trans('global.pleaseSelect') }}</option>
                                    @foreach (App\Models\Product::PRICE_TYPE_SELECT as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ old('price_type', '') === (string) $key ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('price_type'))
                                    <span class="text-danger">{{ $errors->first('price_type') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.product.fields.price_type_helper') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label
                                    for="wholesale_price">{{ trans('cruds.product.fields.wholesale_price') }}</label>
                                <input
                                    class="form-control {{ $errors->has('wholesale_price') ? 'is-invalid' : '' }}"
                                    type="number" name="wholesale_price" id="wholesale_price" min=0 oninput="validity.valid||(value='');"
                                    value="{{ old('wholesale_price', '') }}" step="0.01">
                                @if ($errors->has('wholesale_price'))
                                    <span class="text-danger">{{ $errors->first('wholesale_price') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.product.fields.wholesale_price_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="item_code">{{ trans('cruds.product.fields.item_code') }}</label>
                                <input class="form-control {{ $errors->has('item_code') ? 'is-invalid' : '' }}"
                                    type="text" name="item_code" id="item_code"
                                    value="{{ old('item_code', '') }}">
                                @if ($errors->has('item_code'))
                                    <span class="text-danger">{{ $errors->first('item_code') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.product.fields.item_code_helper') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required">{{ trans('cruds.product.fields.income_account_type') }}</label>
                                <select
                                    class="form-control {{ $errors->has('income_account_type') ? 'is-invalid' : '' }}"
                                    name="income_account_type" id="income_account_type" required>
                                    <option value disabled
                                        {{ old('income_account_type', null) === null ? 'selected' : '' }}>
                                        {{ trans('global.pleaseSelect') }}</option>
                                    @foreach (App\Models\Product::INCOME_ACCOUNT_TYPE_SELECT as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ old('income_account_type', '') === (string) $key ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('income_account_type'))
                                    <span class="text-danger">{{ $errors->first('income_account_type') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.product.fields.income_account_type_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required">{{ trans('cruds.product.fields.account_group') }}</label>
                                <select
                                    class="form-control {{ $errors->has('account_group') ? 'is-invalid' : '' }}"
                                    name="account_group" id="account_group" required>
                                    <option value disabled
                                        {{ old('account_group', null) === null ? 'selected' : '' }}>
                                        {{ trans('global.pleaseSelect') }}</option>
                                    @foreach (App\Models\Product::ACCOUNT_GROUP_SELECT as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ old('account_group', '') === (string) $key ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('account_group'))
                                    <span class="text-danger">{{ $errors->first('account_group') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.product.fields.account_group_helper') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required d-block"
                                    for="account_type_id">{{ trans('cruds.product.fields.account_type') }}</label>
                                <select
                                    class="form-control select2 {{ $errors->has('account_type') ? 'is-invalid' : '' }}"
                                    name="account_type_id" id="account_type_id" required>
                                    @foreach ($account_types as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ old('account_type_id') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('account_type'))
                                    <span class="text-danger">{{ $errors->first('account_type') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.product.fields.account_type_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required d-block"
                                    for="account_name_id">{{ trans('cruds.product.fields.account_name') }}</label>
                                <select
                                    class="form-control select2 {{ $errors->has('account_name') ? 'is-invalid' : '' }}"
                                    name="account_name_id" id="account_name_id" required>
                                    @foreach ($account_names as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ old('account_name_id') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('account_name'))
                                    <span class="text-danger">{{ $errors->first('account_name') }}</span>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.product.fields.account_name_helper') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            I sell this product/service to my customers.
                        </label>
                    </div>
                </div>
            </form>
        <div class="form-group mb-2">
            <button class="btn btn-danger" id="product_save" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>
    </div>
</div>

 <!-- Category Modal -->
 <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
  <div class="modal fade" id="accountTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
  <div class="modal fade" id="accountNameModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    @foreach($account_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('account_type') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
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

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        document.getElementById('item_type_S').checked = true;
        var item_type = $("input[name='item_type']:checked").val();
        $('input[name="item_type"]').attr('checked', false)
            if ($(this).val() == 'G') {
                $(this).attr('checked', true)
            $("#service_name").removeAttr('required',false);
            $("#product_name").attr('required',true); 
            $("#sac").removeAttr('required',false);
            $("#hsn").attr('required',true);   
            if ($("#hsn_label").hasClass("d-none")) {
                $("#hsn_label").removeClass('d-none')
                $("#hsn_label").addClass('d-block')
            }
            $("#sac_label").removeClass('d-block')
            $("#sac_label").addClass('d-none')

            if ($("#product_label").hasClass("d-none")) {
                $("#product_label").removeClass('d-none')
                $("#product_label").addClass('d-block')
            }
            $("#service_label").removeClass('d-block')
            $("#service_label").addClass('d-none')

            } else {
                $(this).attr('checked', true)
                $("#product_name").removeAttr('required',false);
                $("#service_name").attr('required',true);
                $("#hsn").removeAttr('required',false);
                $("#sac").attr('required',true);   
                $("#service_label").removeClass('d-none')
                $("#service_label").addClass('d-block')
                $("#product_label").removeClass('d-block')
                $("#product_label").addClass('d-none')

                $("#sac_label").removeClass('d-none')
                $("#sac_label").addClass('d-block')
                $("#hsn_label").removeClass('d-block')
                $("#hsn_label").addClass('d-none')
            }
    });
            $("input[name='item_type']").change(function() {
                var item_type = $("input[name='item_type']:checked").val();
                $('input[name="item_type"]').attr('checked', false)
                if ($(this).val() == 'G') {
                    $(this).attr('checked', true)
                    $("#service_name").removeAttr('required',false);
                    $("#product_name").attr('required',true);  
                    $("#sac").removeAttr('required',false);
                    $("#hsn").attr('required',true);     
                    if ($("#hsn_label").hasClass("d-none")) {
                        $("#hsn_label").removeClass('d-none')
                        $("#hsn_label").addClass('d-block')
                    }
                    $("#sac_label").removeClass('d-block')
                    $("#sac_label").addClass('d-none')

                    if ($("#product_label").hasClass("d-none")) {
                        $("#product_label").removeClass('d-none')
                        $("#product_label").addClass('d-block')

                    }
                    $("#service_label").removeClass('d-block')
                    $("#service_label").addClass('d-none')
                } else {
                    $(this).attr('checked', true)
                    $("#product_name").removeAttr('required',false);
                    $("#service_name").attr('required',true);
                    $("#hsn").removeAttr('required',false);
                    $("#sac").attr('required',true);   
                    $("#service_label").removeClass('d-none')
                    $("#service_label").addClass('d-block')
                    $("#product_label").removeClass('d-block')
                    $("#product_label").addClass('d-none')

                    $("#sac_label").removeClass('d-none')
                    $("#sac_label").addClass('d-block')
                    $("#hsn_label").removeClass('d-block')
                    $("#hsn_label").addClass('d-none')
                }

            });

        $(document).on('click', '#product_save', function(){
                var company_id = $("#company_id").val();
                alert(company_id);
                var item_type = $("input[name='item_type']:checked").val();
                var hsn = $("#hsn").val()
                var sac = $("#sac").val()
                if (item_type == 'G') {
                    var hsn_code = hsn;
                    var product_name = $("#product_name").val()
                } else {
                    var hsn_code = sac;
                    var product_name = $("#service_name").val()
                }

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
                    url: "{{ route('admin.products.store') }}",
                    type: "post",
                    data: {
                        'company_id': company_id,
                        'item_type': item_type,
                        'name': product_name,
                        'description': description,
                        'hsn': hsn_code,
                        'unit': unit,
                        'categories': categories,
                        'sales_price': sales_price,
                        'gst': gst,
                        'tax_type': $("input[name='tax_type']").val(),
                        'cess': cess,
                        'cess_type': cess_type,
                        'purchase_price': purchase_price,
                        'price_type': price_type,
                        'wholesale_price': wholesale_price,
                        'item_code': item_code,
                        'income_account_type': income_account_type,
                        'account_group': account_group,
                        'account_type_id': account_type_id,
                        'account_name_id': account_name_id,
                        '_token': $('input[name="_token"]').val()
                    },
                    success: function(data) {
                    
                    },
                    error: function(error) {
                        console.log(error, 'err');
                        alert("Error occured");
                    }
                });
        });

</script>
<script>
      $(document).ready(function(){
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
           templateSelection: formatRepoSelection
        });

       function formatRepoSelection (repo) {
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
           templateSelection: formatRepoSelection1
        });

       function formatRepoSelection1 (repo) {
           return (repo.name && repo.name!=null?repo.name: repo.email?repo.email:repo.text);

       }

        $("#account_type_id").change(function(){
            if($(this).val()==0){
               $("#accountTypeModal").modal('show');
            }else{
            }
        });

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
           templateSelection: formatRepoSelection2
        });

       function formatRepoSelection2 (repo) {
           return (repo.name && repo.name!=null?repo.name: repo.email?repo.email:repo.text);

       }

        $("#account_name_id").change(function(){
            if($(this).val()==0){
               $("#accountNameModal").modal('show');
            }else{
            }
        });

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
    });
</script>
@endsection
