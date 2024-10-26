@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.products.update", [$product->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.product.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description', $product->description) }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="hsn">{{ trans('cruds.product.fields.hsn') }}</label>
                            <input class="form-control" type="text" name="hsn" id="hsn" value="{{ old('hsn', $product->hsn) }}">
                            @if($errors->has('hsn'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hsn') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.hsn_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="unit">{{ trans('cruds.product.fields.unit') }}</label>
                            <input class="form-control" type="text" name="unit" id="unit" value="{{ old('unit', $product->unit) }}">
                            @if($errors->has('unit'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('unit') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.unit_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sales_price">{{ trans('cruds.product.fields.sales_price') }}</label>
                            <input class="form-control" type="number" name="sales_price" id="sales_price" value="{{ old('sales_price', $product->sales_price) }}" step="0.01">
                            @if($errors->has('sales_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sales_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.sales_price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.product.fields.tax_type') }}</label>
                            @foreach(App\Models\Product::TAX_TYPE_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="tax_type_{{ $key }}" name="tax_type" value="{{ $key }}" {{ old('tax_type', $product->tax_type) === (string) $key ? 'checked' : '' }}>
                                    <label for="tax_type_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('tax_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tax_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.tax_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.product.fields.gst') }}</label>
                            <select class="form-control" name="gst" id="gst">
                                <option value disabled {{ old('gst', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Product::GST_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('gst', $product->gst) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('gst'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gst') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.gst_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cess">{{ trans('cruds.product.fields.cess') }}</label>
                            <input class="form-control" type="number" name="cess" id="cess" value="{{ old('cess', $product->cess) }}" step="1">
                            @if($errors->has('cess'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cess') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.cess_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.product.fields.cess_type') }}</label>
                            <select class="form-control" name="cess_type" id="cess_type">
                                <option value disabled {{ old('cess_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Product::CESS_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('cess_type', $product->cess_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('cess_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cess_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.cess_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="purchase_price">{{ trans('cruds.product.fields.purchase_price') }}</label>
                            <input class="form-control" type="number" name="purchase_price" id="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}" step="0.01">
                            @if($errors->has('purchase_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('purchase_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.purchase_price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.product.fields.price_type') }}</label>
                            <select class="form-control" name="price_type" id="price_type">
                                <option value disabled {{ old('price_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Product::PRICE_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('price_type', $product->price_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('price_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.price_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.product.fields.item_type') }}</label>
                            @foreach(App\Models\Product::ITEM_TYPE_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="item_type_{{ $key }}" name="item_type" value="{{ $key }}" {{ old('item_type', $product->item_type) === (string) $key ? 'checked' : '' }}>
                                    <label for="item_type_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('item_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('item_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.item_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="wholesale_price">{{ trans('cruds.product.fields.wholesale_price') }}</label>
                            <input class="form-control" type="number" name="wholesale_price" id="wholesale_price" value="{{ old('wholesale_price', $product->wholesale_price) }}" step="0.01">
                            @if($errors->has('wholesale_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('wholesale_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.wholesale_price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="item_code">{{ trans('cruds.product.fields.item_code') }}</label>
                            <input class="form-control" type="text" name="item_code" id="item_code" value="{{ old('item_code', $product->item_code) }}">
                            @if($errors->has('item_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('item_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.item_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.product.fields.income_account_type') }}</label>
                            <select class="form-control" name="income_account_type" id="income_account_type" required>
                                <option value disabled {{ old('income_account_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Product::INCOME_ACCOUNT_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('income_account_type', $product->income_account_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('income_account_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('income_account_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.income_account_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.product.fields.account_group') }}</label>
                            <select class="form-control" name="account_group" id="account_group" required>
                                <option value disabled {{ old('account_group', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Product::ACCOUNT_GROUP_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('account_group', $product->account_group) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('account_group'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('account_group') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.account_group_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="account_type_id">{{ trans('cruds.product.fields.account_type') }}</label>
                            <select class="form-control select2" name="account_type_id" id="account_type_id" required>
                                @foreach($account_types as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('account_type_id') ? old('account_type_id') : $product->account_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('account_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('account_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.account_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="account_name_id">{{ trans('cruds.product.fields.account_name') }}</label>
                            <select class="form-control select2" name="account_name_id" id="account_name_id" required>
                                @foreach($account_names as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('account_name_id') ? old('account_name_id') : $product->account_name->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('account_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('account_name') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection