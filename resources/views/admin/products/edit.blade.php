@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.update", [$product->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="product_approval" id="product_approval" value="1" {{ old('product_approval', 1) == 0 ? 'checked' : '' }}>
              <label class="form-check-label"  for="product_approval">
                Product Approved
              </label>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.product.fields.item_type') }}</label>
                @foreach(App\Models\Product::ITEM_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('item_type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="item_type_{{ $key }}" name="item_type" value="{{ $key }}" {{ old('item_type', $product->item_type) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="item_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('item_type'))
                    <span class="text-danger">{{ $errors->first('item_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.item_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.product.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description', $product->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hsn">{{ trans('cruds.product.fields.hsn') }}/Sac</label>
                <input class="form-control {{ $errors->has('hsn') ? 'is-invalid' : '' }}" type="text" name="hsn" id="hsn" value="{{ old('hsn', $product->hsn) }}" required>
                @if($errors->has('hsn'))
                    <span class="text-danger">{{ $errors->first('hsn') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.hsn_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="unit">{{ trans('cruds.product.fields.unit') }}</label>
                <input class="form-control {{ $errors->has('unit') ? 'is-invalid' : '' }}" type="text" name="unit" id="unit" value="{{ old('unit', $product->unit) }}" required>
                @if($errors->has('unit'))
                    <span class="text-danger">{{ $errors->first('unit') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.unit_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="categories">{{ trans('cruds.product.fields.category') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple required>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || $product->categories->contains($id)) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <span class="text-danger">{{ $errors->first('categories') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sales_price">{{ trans('cruds.product.fields.rate_exclusive_gst') }}</label>
                <input class="form-control {{ $errors->has('sales_price') ? 'is-invalid' : '' }}" type="number" name="sales_price" id="sales_price" value="{{ old('sales_price', $product->sales_price) }}" step="0.01" min=0 oninput="validity.valid||(value='');" required>
                @if($errors->has('sales_price'))
                    <span class="text-danger">{{ $errors->first('sales_price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.rate_exclusive_gst_helper') }}</span>
            </div>
            {{-- <div class="form-group">
                <label>{{ trans('cruds.product.fields.tax_type') }}</label>
                @foreach(App\Models\Product::TAX_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('tax_type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="tax_type_{{ $key }}" name="tax_type" value="{{ $key }}" {{ old('tax_type', $product->tax_type) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="tax_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('tax_type'))
                    <span class="text-danger">{{ $errors->first('tax_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.tax_type_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <label class="required" for="gst">{{ trans('cruds.product.fields.gst') }}</label>
                <select class="form-control {{ $errors->has('gst') ? 'is-invalid' : '' }}" name="gst" id="gst" required>
                    <option value disabled {{ old('gst', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($gsts as $gst)
                        <option value="{{ $gst->gst }}" {{ old('gst', $product->gst) === (string) $gst->gst ? 'selected' : '' }}>GST @ {{ $gst->gst }}%</option>
                    @endforeach
                </select>
                @if($errors->has('gst'))
                    <span class="text-danger">{{ $errors->first('gst') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.gst_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cess">{{ trans('cruds.product.fields.cess') }}</label>
                <input class="form-control {{ $errors->has('cess') ? 'is-invalid' : '' }}" type="number" name="cess" id="cess" value="{{ old('cess', $product->cess) }}" step="1" min=0 oninput="validity.valid||(value='');">
                @if($errors->has('cess'))
                    <span class="text-danger">{{ $errors->first('cess') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.cess_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.product.fields.cess_type') }}</label>
                <select class="form-control {{ $errors->has('cess_type') ? 'is-invalid' : '' }}" name="cess_type" id="cess_type">
                    <option value disabled {{ old('cess_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Product::CESS_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('cess_type', $product->cess_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('cess_type'))
                    <span class="text-danger">{{ $errors->first('cess_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.cess_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="purchase_price">{{ trans('cruds.product.fields.purchase_price') }}</label>
                <input class="form-control {{ $errors->has('purchase_price') ? 'is-invalid' : '' }}" type="number" name="purchase_price" id="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}" step="0.01" min=0 oninput="validity.valid||(value='');">
                @if($errors->has('purchase_price'))
                    <span class="text-danger">{{ $errors->first('purchase_price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.purchase_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.product.fields.price_type') }}</label>
                <select class="form-control {{ $errors->has('price_type') ? 'is-invalid' : '' }}" name="price_type" id="price_type">
                    <option value disabled {{ old('price_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Product::PRICE_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('price_type', $product->price_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('price_type'))
                    <span class="text-danger">{{ $errors->first('price_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.price_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wholesale_price">{{ trans('cruds.product.fields.wholesale_price') }}</label>
                <input class="form-control {{ $errors->has('wholesale_price') ? 'is-invalid' : '' }}" type="number" name="wholesale_price" id="wholesale_price" value="{{ old('wholesale_price', $product->wholesale_price) }}" step="0.01" min=0 oninput="validity.valid||(value='');">
                @if($errors->has('wholesale_price'))
                    <span class="text-danger">{{ $errors->first('wholesale_price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.wholesale_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="item_code">{{ trans('cruds.product.fields.item_code') }}</label>
                <input class="form-control {{ $errors->has('item_code') ? 'is-invalid' : '' }}" type="text" name="item_code" id="item_code" value="{{ old('item_code', $product->item_code) }}">
                @if($errors->has('item_code'))
                    <span class="text-danger">{{ $errors->first('item_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.item_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.product.fields.income_account_type') }}</label>
                <select class="form-control {{ $errors->has('income_account_type') ? 'is-invalid' : '' }}" name="income_account_type" id="income_account_type" required>
                    <option value disabled {{ old('income_account_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Product::INCOME_ACCOUNT_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('income_account_type', $product->income_account_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('income_account_type'))
                    <span class="text-danger">{{ $errors->first('income_account_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.income_account_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.product.fields.account_group') }}</label>
                <select class="form-control {{ $errors->has('account_group') ? 'is-invalid' : '' }}" name="account_group" id="account_group" required>
                    <option value disabled {{ old('account_group', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Product::ACCOUNT_GROUP_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('account_group', $product->account_group) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('account_group'))
                    <span class="text-danger">{{ $errors->first('account_group') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.account_group_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="account_type_id">{{ trans('cruds.product.fields.account_type') }}</label>
                <select class="form-control select2 {{ $errors->has('account_type') ? 'is-invalid' : '' }}" name="account_type_id" id="account_type_id" required>
                    @foreach($account_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('account_type_id') ? old('account_type_id') : $product->account_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('account_type'))
                    <span class="text-danger">{{ $errors->first('account_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.account_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="account_name_id">{{ trans('cruds.product.fields.account_name') }}</label>
                <select class="form-control select2 {{ $errors->has('account_name') ? 'is-invalid' : '' }}" name="account_name_id" id="account_name_id" required>
                    @foreach($account_names as $id => $entry)
                        <option value="{{ $id }}" {{ (old('account_name_id') ? old('account_name_id') : $product->account_name->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('account_name'))
                    <span class="text-danger">{{ $errors->first('account_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.account_name_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
