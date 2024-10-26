@extends('layouts.customer')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.invoice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.invoices.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.invoice.fields.type') }}</label>
                @foreach(App\Models\Invoice::TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="type_{{ $key }}" name="type" value="{{ $key }}" {{ old('type', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="invoice_date">{{ trans('cruds.invoice.fields.invoice_date') }}</label>
                <input class="form-control date {{ $errors->has('invoice_date') ? 'is-invalid' : '' }}" type="text" name="invoice_date" id="invoice_date" value="{{ old('invoice_date') }}" required>
                @if($errors->has('invoice_date'))
                    <span class="text-danger">{{ $errors->first('invoice_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.invoice_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="invoice_no">{{ trans('cruds.invoice.fields.invoice_no') }}</label>
                <input class="form-control {{ $errors->has('invoice_no') ? 'is-invalid' : '' }}" type="text" name="invoice_no" id="invoice_no" value="{{ old('invoice_no', '') }}" required>
                @if($errors->has('invoice_no'))
                    <span class="text-danger">{{ $errors->first('invoice_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.invoice_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customer_id">{{ trans('cruds.invoice.fields.customer') }}</label>
                <select class="form-control select2 {{ $errors->has('customer') ? 'is-invalid' : '' }}" name="customer_id" id="customer_id">
                    @foreach($customers as $id => $entry)
                        <option value="{{ $id }}" {{ old('customer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('customer'))
                    <span class="text-danger">{{ $errors->first('customer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.customer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customer_email">{{ trans('cruds.invoice.fields.customer_email') }}</label>
                <input class="form-control {{ $errors->has('customer_email') ? 'is-invalid' : '' }}" type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}">
                @if($errors->has('customer_email'))
                    <span class="text-danger">{{ $errors->first('customer_email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.customer_email_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('send_later') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="send_later" value="0">
                    <input class="form-check-input" type="checkbox" name="send_later" id="send_later" value="1" {{ old('send_later', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="send_later">{{ trans('cruds.invoice.fields.send_later') }}</label>
                </div>
                @if($errors->has('send_later'))
                    <span class="text-danger">{{ $errors->first('send_later') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.send_later_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="due_date">{{ trans('cruds.invoice.fields.due_date') }}</label>
                <input class="form-control date {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="text" name="due_date" id="due_date" value="{{ old('due_date') }}">
                @if($errors->has('due_date'))
                    <span class="text-danger">{{ $errors->first('due_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.due_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="place_of_supply_id">{{ trans('cruds.invoice.fields.place_of_supply') }}</label>
                <select class="form-control select2 {{ $errors->has('place_of_supply') ? 'is-invalid' : '' }}" name="place_of_supply_id" id="place_of_supply_id">
                    @foreach($place_of_supplies as $id => $entry)
                        <option value="{{ $id }}" {{ old('place_of_supply_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('place_of_supply'))
                    <span class="text-danger">{{ $errors->first('place_of_supply') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.place_of_supply_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.invoice.fields.type_of_supply') }}</label>
                <select class="form-control {{ $errors->has('type_of_supply') ? 'is-invalid' : '' }}" name="type_of_supply" id="type_of_supply">
                    <option value disabled {{ old('type_of_supply', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Invoice::TYPE_OF_SUPPLY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type_of_supply', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type_of_supply'))
                    <span class="text-danger">{{ $errors->first('type_of_supply') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.type_of_supply_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="message_on_invoice">{{ trans('cruds.invoice.fields.message_on_invoice') }}</label>
                <textarea class="form-control {{ $errors->has('message_on_invoice') ? 'is-invalid' : '' }}" name="message_on_invoice" id="message_on_invoice">{{ old('message_on_invoice') }}</textarea>
                @if($errors->has('message_on_invoice'))
                    <span class="text-danger">{{ $errors->first('message_on_invoice') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.message_on_invoice_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="message_on_statement">{{ trans('cruds.invoice.fields.message_on_statement') }}</label>
                <textarea class="form-control {{ $errors->has('message_on_statement') ? 'is-invalid' : '' }}" name="message_on_statement" id="message_on_statement">{{ old('message_on_statement') }}</textarea>
                @if($errors->has('message_on_statement'))
                    <span class="text-danger">{{ $errors->first('message_on_statement') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.message_on_statement_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.invoice.fields.discount_type') }}</label>
                <select class="form-control {{ $errors->has('discount_type') ? 'is-invalid' : '' }}" name="discount_type" id="discount_type">
                    <option value disabled {{ old('discount_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Invoice::DISCOUNT_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('discount_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('discount_type'))
                    <span class="text-danger">{{ $errors->first('discount_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.discount_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="discount_amount">{{ trans('cruds.invoice.fields.discount_amount') }}</label>
                <input class="form-control {{ $errors->has('discount_amount') ? 'is-invalid' : '' }}" type="text" name="discount_amount" id="discount_amount" value="{{ old('discount_amount', '') }}">
                @if($errors->has('discount_amount'))
                    <span class="text-danger">{{ $errors->first('discount_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.discount_amount_helper') }}</span>
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















