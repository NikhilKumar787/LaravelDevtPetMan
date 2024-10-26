@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.invoice.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.invoices.update", [$invoice->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.invoice.fields.type') }}</label>
                            @foreach(App\Models\Invoice::TYPE_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="type_{{ $key }}" name="type" value="{{ $key }}" {{ old('type', $invoice->type) === (string) $key ? 'checked' : '' }} required>
                                    <label for="type_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="invoice_date">{{ trans('cruds.invoice.fields.invoice_date') }}</label>
                            <input class="form-control date" type="text" name="invoice_date" id="invoice_date" value="{{ old('invoice_date', $invoice->invoice_date) }}" required>
                            @if($errors->has('invoice_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('invoice_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.invoice_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="invoice_no">{{ trans('cruds.invoice.fields.invoice_no') }}</label>
                            <input class="form-control" type="text" name="invoice_no" id="invoice_no" value="{{ old('invoice_no', $invoice->invoice_no) }}" required>
                            @if($errors->has('invoice_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('invoice_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.invoice_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="customer_id">{{ trans('cruds.invoice.fields.customer') }}</label>
                            <select class="form-control select2" name="customer_id" id="customer_id">
                                @foreach($customers as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('customer_id') ? old('customer_id') : $invoice->customer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('customer'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('customer') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.customer_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="customer_email">{{ trans('cruds.invoice.fields.customer_email') }}</label>
                            <input class="form-control" type="email" name="customer_email" id="customer_email" value="{{ old('customer_email', $invoice->customer_email) }}">
                            @if($errors->has('customer_email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('customer_email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.customer_email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="send_later" value="0">
                                <input type="checkbox" name="send_later" id="send_later" value="1" {{ $invoice->send_later || old('send_later', 0) === 1 ? 'checked' : '' }}>
                                <label for="send_later">{{ trans('cruds.invoice.fields.send_later') }}</label>
                            </div>
                            @if($errors->has('send_later'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('send_later') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.send_later_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="due_date">{{ trans('cruds.invoice.fields.due_date') }}</label>
                            <input class="form-control date" type="text" name="due_date" id="due_date" value="{{ old('due_date', $invoice->due_date) }}">
                            @if($errors->has('due_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('due_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.due_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="place_of_supply_id">{{ trans('cruds.invoice.fields.place_of_supply') }}</label>
                            <select class="form-control select2" name="place_of_supply_id" id="place_of_supply_id">
                                @foreach($place_of_supplies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('place_of_supply_id') ? old('place_of_supply_id') : $invoice->place_of_supply->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('place_of_supply'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('place_of_supply') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.place_of_supply_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.invoice.fields.type_of_supply') }}</label>
                            <select class="form-control" name="type_of_supply" id="type_of_supply">
                                <option value disabled {{ old('type_of_supply', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Invoice::TYPE_OF_SUPPLY_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('type_of_supply', $invoice->type_of_supply) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type_of_supply'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type_of_supply') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.type_of_supply_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="message_on_invoice">{{ trans('cruds.invoice.fields.message_on_invoice') }}</label>
                            <textarea class="form-control" name="message_on_invoice" id="message_on_invoice">{{ old('message_on_invoice', $invoice->message_on_invoice) }}</textarea>
                            @if($errors->has('message_on_invoice'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('message_on_invoice') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.message_on_invoice_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="message_on_statement">{{ trans('cruds.invoice.fields.message_on_statement') }}</label>
                            <textarea class="form-control" name="message_on_statement" id="message_on_statement">{{ old('message_on_statement', $invoice->message_on_statement) }}</textarea>
                            @if($errors->has('message_on_statement'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('message_on_statement') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.message_on_statement_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.invoice.fields.discount_type') }}</label>
                            <select class="form-control" name="discount_type" id="discount_type">
                                <option value disabled {{ old('discount_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Invoice::DISCOUNT_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('discount_type', $invoice->discount_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('discount_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('discount_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.discount_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="discount_amount">{{ trans('cruds.invoice.fields.discount_amount') }}</label>
                            <input class="form-control" type="text" name="discount_amount" id="discount_amount" value="{{ old('discount_amount', $invoice->discount_amount) }}">
                            @if($errors->has('discount_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('discount_amount') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection