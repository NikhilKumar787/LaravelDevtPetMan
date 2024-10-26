@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.invoiceDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.invoice-details.update", [$invoiceDetail->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="invoice_id">{{ trans('cruds.invoiceDetail.fields.invoice') }}</label>
                <select class="form-control select2 {{ $errors->has('invoice') ? 'is-invalid' : '' }}" name="invoice_id" id="invoice_id" required>
                    @foreach($invoices as $id => $entry)
                        <option value="{{ $id }}" {{ (old('invoice_id') ? old('invoice_id') : $invoiceDetail->invoice->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('invoice'))
                    <span class="text-danger">{{ $errors->first('invoice') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceDetail.fields.invoice_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.invoiceDetail.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $invoiceDetail->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <span class="text-danger">{{ $errors->first('product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceDetail.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="qty">{{ trans('cruds.invoiceDetail.fields.qty') }}</label>
                <input class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" type="number" name="qty" id="qty" value="{{ old('qty', $invoiceDetail->qty) }}" step="1" required>
                @if($errors->has('qty'))
                    <span class="text-danger">{{ $errors->first('qty') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceDetail.fields.qty_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="rate">{{ trans('cruds.invoiceDetail.fields.rate') }}</label>
                <input class="form-control {{ $errors->has('rate') ? 'is-invalid' : '' }}" type="number" name="rate" id="rate" value="{{ old('rate', $invoiceDetail->rate) }}" step="0.01" required>
                @if($errors->has('rate'))
                    <span class="text-danger">{{ $errors->first('rate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceDetail.fields.rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.invoiceDetail.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $invoiceDetail->amount) }}" step="0.01" required>
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceDetail.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.invoiceDetail.fields.tax') }}</label>
                <select class="form-control {{ $errors->has('tax') ? 'is-invalid' : '' }}" name="tax" id="tax" required>
                    <option value disabled {{ old('tax', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\InvoiceDetail::TAX_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('tax', $invoiceDetail->tax) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('tax'))
                    <span class="text-danger">{{ $errors->first('tax') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.invoiceDetail.fields.tax_helper') }}</span>
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