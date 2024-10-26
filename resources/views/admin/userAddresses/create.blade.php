@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.userAddress.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-addresses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
            <div class="form-group col-md-4">
                <label class="required" for="name">{{ trans('cruds.userAddress.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userAddress.fields.name_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label class="required" for="phone_no">{{ trans('cruds.userAddress.fields.phone_no') }}</label>
                <input class="form-control {{ $errors->has('phone_no') ? 'is-invalid' : '' }}" type="text" name="phone_no" id="phone_no" value="{{ old('phone_no', '') }}" required>
                @if($errors->has('phone_no'))
                    <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userAddress.fields.phone_no_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label class="required" for="addressline_1">{{ trans('cruds.userAddress.fields.addressline_1') }}</label>
                <input class="form-control {{ $errors->has('addressline_1') ? 'is-invalid' : '' }}" type="text" name="addressline_1" id="addressline_1" value="{{ old('addressline_1', '') }}" required>
                @if($errors->has('addressline_1'))
                    <span class="text-danger">{{ $errors->first('addressline_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userAddress.fields.addressline_1_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="addressline_2">{{ trans('cruds.userAddress.fields.addressline_2') }}</label>
                <input class="form-control {{ $errors->has('addressline_2') ? 'is-invalid' : '' }}" type="text" name="addressline_2" id="addressline_2" value="{{ old('addressline_2', '') }}">
                @if($errors->has('addressline_2'))
                    <span class="text-danger">{{ $errors->first('addressline_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userAddress.fields.addressline_2_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label class="required" for="city">{{ trans('cruds.userAddress.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}" required>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userAddress.fields.city_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label class="required" for="zip_code">{{ trans('cruds.userAddress.fields.zip_code') }}</label>
                <input class="form-control {{ $errors->has('zip_code') ? 'is-invalid' : '' }}" type="text" name="zip_code" id="zip_code" value="{{ old('zip_code', '') }}" required>
                @if($errors->has('zip_code'))
                    <span class="text-danger">{{ $errors->first('zip_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userAddress.fields.zip_code_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label class="required" for="state">{{ trans('cruds.userAddress.fields.state') }}</label>
                <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', '') }}" required>
                @if($errors->has('state'))
                    <span class="text-danger">{{ $errors->first('state') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userAddress.fields.state_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="customer_id">{{ trans('cruds.userAddress.fields.customer') }}</label>
                <select class="form-control select2 {{ $errors->has('customer') ? 'is-invalid' : '' }}" name="customer_id" id="customer_id">
                    @foreach($customers as $id => $entry)
                        <option value="{{ $id }}" {{ old('customer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('customer'))
                    <span class="text-danger">{{ $errors->first('customer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userAddress.fields.customer_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="user_id">{{ trans('cruds.userAddress.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userAddress.fields.user_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="uuid">{{ trans('cruds.userAddress.fields.uuid') }}</label>
                <input class="form-control {{ $errors->has('uuid') ? 'is-invalid' : '' }}" type="text" name="uuid" id="uuid" value="{{ old('uuid', '') }}">
                @if($errors->has('uuid'))
                    <span class="text-danger">{{ $errors->first('uuid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userAddress.fields.uuid_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label>{{ trans('cruds.userAddress.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\UserAddress::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userAddress.fields.type_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <div class="form-check {{ $errors->has('same_as') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="same_as" value="0">
                    <input class="form-check-input" type="checkbox" name="same_as" id="same_as" value="1" {{ old('same_as', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="same_as">{{ trans('cruds.userAddress.fields.same_as') }}</label>
                </div>
                @if($errors->has('same_as'))
                    <span class="text-danger">{{ $errors->first('same_as') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userAddress.fields.same_as_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <div class="form-check {{ $errors->has('default_address') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="default_address" value="0">
                    <input class="form-check-input" type="checkbox" name="default_address" id="default_address" value="1" {{ old('default_address', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="default_address">{{ trans('cruds.userAddress.fields.default_address') }}</label>
                </div>
                @if($errors->has('default_address'))
                    <span class="text-danger">{{ $errors->first('default_address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userAddress.fields.default_address_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </div>
        </form>
    </div>
</div>



@endsection