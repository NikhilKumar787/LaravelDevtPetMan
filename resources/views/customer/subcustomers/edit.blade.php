@extends('layouts.customer')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.customer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('customer.subcustomers.update', [$customer->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.customer.fields.title') }}</label>
                <select class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" id="title" required>
                    <option value disabled {{ old('title', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Customer::TITLE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('title', $customer->title) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.customer.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $customer->first_name) }}" required>
                @if($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="middle_name">{{ trans('cruds.customer.fields.middle_name') }}</label>
                <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $customer->middle_name) }}">
                @if($errors->has('middle_name'))
                    <span class="text-danger">{{ $errors->first('middle_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.middle_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="last_name">{{ trans('cruds.customer.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $customer->last_name) }}">
                @if($errors->has('last_name'))
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gstin">{{ trans('cruds.customer.fields.gstin') }}</label>
                <input class="form-control {{ $errors->has('gstin') ? 'is-invalid' : '' }}" type="text" name="gstin" id="gstin" value="{{ old('gstin', $customer->gstin) }}">
                @if($errors->has('gstin'))
                    <span class="text-danger">{{ $errors->first('gstin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.gstin_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.customer.fields.gst_type') }}</label>
                <select class="form-control {{ $errors->has('gst_type') ? 'is-invalid' : '' }}" name="gst_type" id="gst_type">
                    <option value disabled {{ old('gst_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Customer::GST_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gst_type', $customer->gst_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gst_type'))
                    <span class="text-danger">{{ $errors->first('gst_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.gst_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gst_customer_name">{{ trans('cruds.customer.fields.gst_customer_name') }}</label>
                <input class="form-control {{ $errors->has('gst_customer_name') ? 'is-invalid' : '' }}" type="text" name="gst_customer_name" id="gst_customer_name" value="{{ old('gst_customer_name', $customer->gst_customer_name) }}">
                @if($errors->has('gst_customer_name'))
                    <span class="text-danger">{{ $errors->first('gst_customer_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.gst_customer_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mobile">{{ trans('cruds.customer.fields.mobile') }}</label>
                <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', $customer->mobile) }}">
                @if($errors->has('mobile'))
                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.mobile_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.customer.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address', $customer->address) }}</textarea>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city_id">{{ trans('cruds.customer.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id">
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $customer->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="state_id">{{ trans('cruds.customer.fields.state') }}</label>
                <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state_id" id="state_id">
                    @foreach($states as $id => $entry)
                        <option value="{{ $id }}" {{ (old('state_id') ? old('state_id') : $customer->state->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('state'))
                    <span class="text-danger">{{ $errors->first('state') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="country_id">{{ trans('cruds.customer.fields.country') }}</label>
                <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id">
                    @foreach($countries as $id => $entry)
                        <option value="{{ $id }}" {{ (old('country_id') ? old('country_id') : $customer->country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('country'))
                    <span class="text-danger">{{ $errors->first('country') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pin_code">{{ trans('cruds.customer.fields.pin_code') }}</label>
                <input class="form-control {{ $errors->has('pin_code') ? 'is-invalid' : '' }}" type="text" name="pin_code" id="pin_code" value="{{ old('pin_code', $customer->pin_code) }}">
                @if($errors->has('pin_code'))
                    <span class="text-danger">{{ $errors->first('pin_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.pin_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="company">{{ trans('cruds.customer.fields.company') }}</label>
                <input class="form-control {{ $errors->has('company') ? 'is-invalid' : '' }}" type="text" name="company" id="company" value="{{ old('company', $customer->company) }}" required>
                @if($errors->has('company'))
                    <span class="text-danger">{{ $errors->first('company') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="other">{{ trans('cruds.customer.fields.other') }}</label>
                <input class="form-control {{ $errors->has('other') ? 'is-invalid' : '' }}" type="text" name="other" id="other" value="{{ old('other', $customer->other) }}">
                @if($errors->has('other'))
                    <span class="text-danger">{{ $errors->first('other') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.other_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="website">{{ trans('cruds.customer.fields.website') }}</label>
                <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', $customer->website) }}">
                @if($errors->has('website'))
                    <span class="text-danger">{{ $errors->first('website') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.website_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.customer.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $customer->phone) }}">
                @if($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="term_id">{{ trans('cruds.customer.fields.term') }}</label>
                <select class="form-control select2 {{ $errors->has('term') ? 'is-invalid' : '' }}" name="term_id" id="term_id">
                    @foreach($terms as $id => $entry)
                        <option value="{{ $id }}" {{ (old('term_id') ? old('term_id') : $customer->term->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('term'))
                    <span class="text-danger">{{ $errors->first('term') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.term_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.customer.fields.notes') }}</label>
                <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{{ old('notes', $customer->notes) }}</textarea>
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pan_no">{{ trans('cruds.customer.fields.pan_no') }}</label>
                <input class="form-control {{ $errors->has('pan_no') ? 'is-invalid' : '' }}" type="text" name="pan_no" id="pan_no" value="{{ old('pan_no', $customer->pan_no) }}">
                @if($errors->has('pan_no'))
                    <span class="text-danger">{{ $errors->first('pan_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.pan_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tan">{{ trans('cruds.customer.fields.tan') }}</label>
                <input class="form-control {{ $errors->has('tan') ? 'is-invalid' : '' }}" type="text" name="tan" id="tan" value="{{ old('tan', $customer->tan) }}">
                @if($errors->has('tan'))
                    <span class="text-danger">{{ $errors->first('tan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.tan_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.customer.fields.payment_method') }}</label>
                <select class="form-control {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" name="payment_method" id="payment_method">
                    <option value disabled {{ old('payment_method', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Customer::PAYMENT_METHOD_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('payment_method', $customer->payment_method) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_method'))
                    <span class="text-danger">{{ $errors->first('payment_method') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.payment_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.customer.fields.delivery_method') }}</label>
                <select class="form-control {{ $errors->has('delivery_method') ? 'is-invalid' : '' }}" name="delivery_method" id="delivery_method">
                    <option value disabled {{ old('delivery_method', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Customer::DELIVERY_METHOD_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('delivery_method', $customer->delivery_method) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('delivery_method'))
                    <span class="text-danger">{{ $errors->first('delivery_method') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.delivery_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attachment">{{ trans('cruds.customer.fields.attachment') }}</label>
                <div class="needsclick dropzone {{ $errors->has('attachment') ? 'is-invalid' : '' }}" id="attachment-dropzone">
                </div>
                @if($errors->has('attachment'))
                    <span class="text-danger">{{ $errors->first('attachment') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.attachment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="optional_data_1">{{ trans('cruds.customer.fields.optional_data_1') }}</label>
                <input class="form-control {{ $errors->has('optional_data_1') ? 'is-invalid' : '' }}" type="text" name="optional_data_1" id="optional_data_1" value="{{ old('optional_data_1', $customer->optional_data_1) }}">
                @if($errors->has('optional_data_1'))
                    <span class="text-danger">{{ $errors->first('optional_data_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.optional_data_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="optional_data_2">{{ trans('cruds.customer.fields.optional_data_2') }}</label>
                <input class="form-control {{ $errors->has('optional_data_2') ? 'is-invalid' : '' }}" type="text" name="optional_data_2" id="optional_data_2" value="{{ old('optional_data_2', $customer->optional_data_2) }}">
                @if($errors->has('optional_data_2'))
                    <span class="text-danger">{{ $errors->first('optional_data_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.optional_data_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.customer.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $customer->email) }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_my_vendor') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_my_vendor" value="0">
                    <input class="form-check-input" type="checkbox" name="is_my_vendor" id="is_my_vendor" value="1" {{ $customer->is_my_vendor || old('is_my_vendor', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_my_vendor">{{ trans('cruds.customer.fields.is_my_vendor') }}</label>
                </div>
                @if($errors->has('is_my_vendor'))
                    <span class="text-danger">{{ $errors->first('is_my_vendor') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.is_my_vendor_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.attachmentDropzone = {
    url: '{{ route('customer.subcustomers.storeMedia') }}',
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
@endsection