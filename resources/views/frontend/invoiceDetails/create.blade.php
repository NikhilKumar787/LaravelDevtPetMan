@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.invoiceDetail.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.invoice-details.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="invoice_id">{{ trans('cruds.invoiceDetail.fields.invoice') }}</label>
                            <select class="form-control select2" name="invoice_id" id="invoice_id" required>
                                @foreach($invoices as $id => $entry)
                                    <option value="{{ $id }}" {{ old('invoice_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('invoice'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('invoice') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoiceDetail.fields.invoice_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="product_id">{{ trans('cruds.invoiceDetail.fields.product') }}</label>
                            <select class="form-control select2" name="product_id" id="product_id" required>
                                @foreach($products as $id => $entry)
                                    <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('product'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoiceDetail.fields.product_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="qty">{{ trans('cruds.invoiceDetail.fields.qty') }}</label>
                            <input class="form-control" type="number" name="qty" id="qty" value="{{ old('qty', '') }}" step="1" required>
                            @if($errors->has('qty'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qty') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoiceDetail.fields.qty_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="rate">{{ trans('cruds.invoiceDetail.fields.rate') }}</label>
                            <input class="form-control" type="number" name="rate" id="rate" value="{{ old('rate', '') }}" step="0.01" required>
                            @if($errors->has('rate'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rate') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoiceDetail.fields.rate_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.invoiceDetail.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoiceDetail.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.invoiceDetail.fields.tax') }}</label>
                            <select class="form-control" name="tax" id="tax" required>
                                <option value disabled {{ old('tax', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\InvoiceDetail::TAX_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('tax', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tax'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tax') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection