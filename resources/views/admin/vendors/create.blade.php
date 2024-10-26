@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.vendor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.vendors.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.vendor.fields.title') }}</label>
                <select class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" id="title" required>
                    <option value disabled {{ old('title', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Vendor::TITLE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('title', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.vendor.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                @if($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="middle_name">{{ trans('cruds.vendor.fields.middle_name') }}</label>
                <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', '') }}">
                @if($errors->has('middle_name'))
                    <span class="text-danger">{{ $errors->first('middle_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.middle_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="last_name">{{ trans('cruds.vendor.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}">
                @if($errors->has('last_name'))
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="company_name">{{ trans('cruds.vendor.fields.company_name') }}</label>
                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', '') }}" required>
                @if($errors->has('company_name'))
                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.company_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.vendor.fields.gst_type') }}</label>
                <select class="form-control {{ $errors->has('gst_type') ? 'is-invalid' : '' }}" name="gst_type" id="gst_type" required>
                    <option value disabled {{ old('gst_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Vendor::GST_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gst_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gst_type'))
                    <span class="text-danger">{{ $errors->first('gst_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.gst_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gstin">{{ trans('cruds.vendor.fields.gstin') }}</label>
                <input class="form-control {{ $errors->has('gstin') ? 'is-invalid' : '' }}" type="text" name="gstin" id="gstin" value="{{ old('gstin', '') }}">
                @if($errors->has('gstin'))
                    <span class="text-danger">{{ $errors->first('gstin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.gstin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.vendor.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address') }}</textarea>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city_id">{{ trans('cruds.vendor.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id">
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ old('city_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="state_id">{{ trans('cruds.vendor.fields.state') }}</label>
                <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state_id" id="state_id">
                    @foreach($states as $id => $entry)
                        <option value="{{ $id }}" {{ old('state_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('state'))
                    <span class="text-danger">{{ $errors->first('state') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pin_code">{{ trans('cruds.vendor.fields.pin_code') }}</label>
                <input class="form-control {{ $errors->has('pin_code') ? 'is-invalid' : '' }}" type="text" name="pin_code" id="pin_code" value="{{ old('pin_code', '') }}">
                @if($errors->has('pin_code'))
                    <span class="text-danger">{{ $errors->first('pin_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.pin_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mobile">{{ trans('cruds.vendor.fields.mobile') }}</label>
                <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', '') }}">
                @if($errors->has('mobile'))
                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.mobile_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.vendor.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pancard">{{ trans('cruds.vendor.fields.pancard') }}</label>
                <input class="form-control {{ $errors->has('pancard') ? 'is-invalid' : '' }}" type="text" name="pancard" id="pancard" value="{{ old('pancard', '') }}">
                @if($errors->has('pancard'))
                    <span class="text-danger">{{ $errors->first('pancard') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.pancard_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="other">{{ trans('cruds.vendor.fields.other') }}</label>
                <input class="form-control {{ $errors->has('other') ? 'is-invalid' : '' }}" type="text" name="other" id="other" value="{{ old('other', '') }}">
                @if($errors->has('other'))
                    <span class="text-danger">{{ $errors->first('other') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.other_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="website">{{ trans('cruds.vendor.fields.website') }}</label>
                <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', '') }}">
                @if($errors->has('website'))
                    <span class="text-danger">{{ $errors->first('website') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.website_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.vendor.fields.notes') }}</label>
                <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{{ old('notes') }}</textarea>
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="payment_method">{{ trans('cruds.vendor.fields.payment_method') }}</label>
                <input class="form-control {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" type="text" name="payment_method" id="payment_method" value="{{ old('payment_method', '') }}">
                @if($errors->has('payment_method'))
                    <span class="text-danger">{{ $errors->first('payment_method') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.payment_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="term_id">{{ trans('cruds.vendor.fields.term') }}</label>
                <select class="form-control select2 {{ $errors->has('term') ? 'is-invalid' : '' }}" name="term_id" id="term_id">
                    @foreach($terms as $id => $entry)
                        <option value="{{ $id }}" {{ old('term_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('term'))
                    <span class="text-danger">{{ $errors->first('term') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.term_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="account_no">{{ trans('cruds.vendor.fields.account_no') }}</label>
                <input class="form-control {{ $errors->has('account_no') ? 'is-invalid' : '' }}" type="text" name="account_no" id="account_no" value="{{ old('account_no', '') }}">
                @if($errors->has('account_no'))
                    <span class="text-danger">{{ $errors->first('account_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.account_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tax_reg_no">{{ trans('cruds.vendor.fields.tax_reg_no') }}</label>
                <input class="form-control {{ $errors->has('tax_reg_no') ? 'is-invalid' : '' }}" type="text" name="tax_reg_no" id="tax_reg_no" value="{{ old('tax_reg_no', '') }}">
                @if($errors->has('tax_reg_no'))
                    <span class="text-danger">{{ $errors->first('tax_reg_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.tax_reg_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="effective_date">{{ trans('cruds.vendor.fields.effective_date') }}</label>
                <input class="form-control {{ $errors->has('effective_date') ? 'is-invalid' : '' }}" type="text" name="effective_date" id="effective_date" value="{{ old('effective_date', '') }}">
                @if($errors->has('effective_date'))
                    <span class="text-danger">{{ $errors->first('effective_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.effective_date_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('apply_tds') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="apply_tds" value="0">
                    <input class="form-check-input" type="checkbox" name="apply_tds" id="apply_tds" value="1" {{ old('apply_tds', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="apply_tds">{{ trans('cruds.vendor.fields.apply_tds') }}</label>
                </div>
                @if($errors->has('apply_tds'))
                    <span class="text-danger">{{ $errors->first('apply_tds') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.apply_tds_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.vendor.fields.entity') }}</label>
                <select class="form-control {{ $errors->has('entity') ? 'is-invalid' : '' }}" name="entity" id="entity">
                    <option value disabled {{ old('entity', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Vendor::ENTITY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('entity', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('entity'))
                    <span class="text-danger">{{ $errors->first('entity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.entity_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.vendor.fields.section') }}</label>
                <select class="form-control {{ $errors->has('section') ? 'is-invalid' : '' }}" name="section" id="section">
                    <option value disabled {{ old('section', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Vendor::SECTION_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('section', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('section'))
                    <span class="text-danger">{{ $errors->first('section') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.section_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('calculation_threshold') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="calculation_threshold" value="0">
                    <input class="form-check-input" type="checkbox" name="calculation_threshold" id="calculation_threshold" value="1" {{ old('calculation_threshold', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="calculation_threshold">{{ trans('cruds.vendor.fields.calculation_threshold') }}</label>
                </div>
                @if($errors->has('calculation_threshold'))
                    <span class="text-danger">{{ $errors->first('calculation_threshold') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.calculation_threshold_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_my_customer') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_my_customer" value="0">
                    <input class="form-check-input" type="checkbox" name="is_my_customer" id="is_my_customer" value="1" {{ old('is_my_customer', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_my_customer">{{ trans('cruds.vendor.fields.is_my_customer') }}</label>
                </div>
                @if($errors->has('is_my_customer'))
                    <span class="text-danger">{{ $errors->first('is_my_customer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.is_my_customer_helper') }}</span>
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