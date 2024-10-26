@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.invoiceDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.invoice-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $invoiceDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceDetail.fields.invoice') }}
                        </th>
                        <td>
                            {{ $invoiceDetail->invoice->type ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceDetail.fields.product') }}
                        </th>
                        <td>
                            {{ $invoiceDetail->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceDetail.fields.qty') }}
                        </th>
                        <td>
                            {{ $invoiceDetail->qty }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceDetail.fields.rate') }}
                        </th>
                        <td>
                            {{ $invoiceDetail->rate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceDetail.fields.amount') }}
                        </th>
                        <td>
                            {{ $invoiceDetail->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceDetail.fields.tax') }}
                        </th>
                        <td>
                            {{ App\Models\InvoiceDetail::TAX_SELECT[$invoiceDetail->tax] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.invoice-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection