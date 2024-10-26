@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.vendor.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.vendors.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.vendor.fields.title') }}</label>
                            <select class="form-control" name="title" id="title" required>
                                <option value disabled {{ old('title', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Vendor::TITLE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('title', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="first_name">{{ trans('cruds.vendor.fields.first_name') }}</label>
                            <input class="form-control" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                            @if($errors->has('first_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('first_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.first_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="middle_name">{{ trans('cruds.vendor.fields.middle_name') }}</label>
                            <input class="form-control" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', '') }}">
                            @if($errors->has('middle_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('middle_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.middle_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_name">{{ trans('cruds.vendor.fields.last_name') }}</label>
                            <input class="form-control" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}">
                            @if($errors->has('last_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.last_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="company_name">{{ trans('cruds.vendor.fields.company_name') }}</label>
                            <input class="form-control" type="text" name="company_name" id="company_name" value="{{ old('company_name', '') }}" required>
                            @if($errors->has('company_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.company_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.vendor.fields.gst_type') }}</label>
                            <select class="form-control" name="gst_type" id="gst_type" required>
                                <option value disabled {{ old('gst_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Vendor::GST_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('gst_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('gst_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gst_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.gst_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="gstin">{{ trans('cruds.vendor.fields.gstin') }}</label>
                            <input class="form-control" type="text" name="gstin" id="gstin" value="{{ old('gstin', '') }}">
                            @if($errors->has('gstin'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gstin') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.gstin_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.vendor.fields.address') }}</label>
                            <textarea class="form-control" name="address" id="address">{{ old('address') }}</textarea>
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="city_id">{{ trans('cruds.vendor.fields.city') }}</label>
                            <select class="form-control select2" name="city_id" id="city_id">
                                @foreach($cities as $id => $entry)
                                    <option value="{{ $id }}" {{ old('city_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('city'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('city') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.city_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="state_id">{{ trans('cruds.vendor.fields.state') }}</label>
                            <select class="form-control select2" name="state_id" id="state_id">
                                @foreach($states as $id => $entry)
                                    <option value="{{ $id }}" {{ old('state_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('state'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('state') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.state_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="pin_code">{{ trans('cruds.vendor.fields.pin_code') }}</label>
                            <input class="form-control" type="text" name="pin_code" id="pin_code" value="{{ old('pin_code', '') }}">
                            @if($errors->has('pin_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pin_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.pin_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mobile">{{ trans('cruds.vendor.fields.mobile') }}</label>
                            <input class="form-control" type="text" name="mobile" id="mobile" value="{{ old('mobile', '') }}">
                            @if($errors->has('mobile'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mobile') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.mobile_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('cruds.vendor.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="pancard">{{ trans('cruds.vendor.fields.pancard') }}</label>
                            <input class="form-control" type="text" name="pancard" id="pancard" value="{{ old('pancard', '') }}">
                            @if($errors->has('pancard'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pancard') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.pancard_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="other">{{ trans('cruds.vendor.fields.other') }}</label>
                            <input class="form-control" type="text" name="other" id="other" value="{{ old('other', '') }}">
                            @if($errors->has('other'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('other') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.other_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="website">{{ trans('cruds.vendor.fields.website') }}</label>
                            <input class="form-control" type="text" name="website" id="website" value="{{ old('website', '') }}">
                            @if($errors->has('website'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('website') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.website_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.vendor.fields.notes') }}</label>
                            <textarea class="form-control" name="notes" id="notes">{{ old('notes') }}</textarea>
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="payment_method">{{ trans('cruds.vendor.fields.payment_method') }}</label>
                            <input class="form-control" type="text" name="payment_method" id="payment_method" value="{{ old('payment_method', '') }}">
                            @if($errors->has('payment_method'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payment_method') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.payment_method_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="term_id">{{ trans('cruds.vendor.fields.term') }}</label>
                            <select class="form-control select2" name="term_id" id="term_id">
                                @foreach($terms as $id => $entry)
                                    <option value="{{ $id }}" {{ old('term_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('term'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('term') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.term_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="account_no">{{ trans('cruds.vendor.fields.account_no') }}</label>
                            <input class="form-control" type="text" name="account_no" id="account_no" value="{{ old('account_no', '') }}">
                            @if($errors->has('account_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('account_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.account_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tax_reg_no">{{ trans('cruds.vendor.fields.tax_reg_no') }}</label>
                            <input class="form-control" type="text" name="tax_reg_no" id="tax_reg_no" value="{{ old('tax_reg_no', '') }}">
                            @if($errors->has('tax_reg_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tax_reg_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.tax_reg_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="effective_date">{{ trans('cruds.vendor.fields.effective_date') }}</label>
                            <input class="form-control" type="text" name="effective_date" id="effective_date" value="{{ old('effective_date', '') }}">
                            @if($errors->has('effective_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('effective_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.effective_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="apply_tds" value="0">
                                <input type="checkbox" name="apply_tds" id="apply_tds" value="1" {{ old('apply_tds', 0) == 1 ? 'checked' : '' }}>
                                <label for="apply_tds">{{ trans('cruds.vendor.fields.apply_tds') }}</label>
                            </div>
                            @if($errors->has('apply_tds'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('apply_tds') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.apply_tds_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.vendor.fields.entity') }}</label>
                            <select class="form-control" name="entity" id="entity">
                                <option value disabled {{ old('entity', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Vendor::ENTITY_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('entity', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('entity'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('entity') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.entity_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.vendor.fields.section') }}</label>
                            <select class="form-control" name="section" id="section">
                                <option value disabled {{ old('section', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Vendor::SECTION_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('section', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('section'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('section') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.section_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="calculation_threshold" value="0">
                                <input type="checkbox" name="calculation_threshold" id="calculation_threshold" value="1" {{ old('calculation_threshold', 0) == 1 ? 'checked' : '' }}>
                                <label for="calculation_threshold">{{ trans('cruds.vendor.fields.calculation_threshold') }}</label>
                            </div>
                            @if($errors->has('calculation_threshold'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('calculation_threshold') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vendor.fields.calculation_threshold_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_my_customer" value="0">
                                <input type="checkbox" name="is_my_customer" id="is_my_customer" value="1" {{ old('is_my_customer', 0) == 1 ? 'checked' : '' }}>
                                <label for="is_my_customer">{{ trans('cruds.vendor.fields.is_my_customer') }}</label>
                            </div>
                            @if($errors->has('is_my_customer'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_my_customer') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection