@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.invoice.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.invoices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.id') }}
                        </th>
                        <td>
                            {{ $invoice->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Invoice::TYPE_RADIO[$invoice->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.invoice_date') }}
                        </th>
                        <td>
                            {{ $invoice->invoice_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.invoice_no') }}
                        </th>
                        <td>
                            {{ $invoice->invoice_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.customer') }}
                        </th>
                        <td>
                            {{ $invoice->customer->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.customer_email') }}
                        </th>
                        <td>
                            {{ $invoice->customer_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.send_later') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $invoice->send_later ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.due_date') }}
                        </th>
                        <td>
                            {{ $invoice->due_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.place_of_supply') }}
                        </th>
                        <td>
                            {{ $invoice->place_of_supply->state ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.type_of_supply') }}
                        </th>
                        <td>
                            {{ App\Models\Invoice::TYPE_OF_SUPPLY_SELECT[$invoice->type_of_supply] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.message_on_invoice') }}
                        </th>
                        <td>
                            {{ $invoice->message_on_invoice }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.message_on_statement') }}
                        </th>
                        <td>
                            {{ $invoice->message_on_statement }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.discount_type') }}
                        </th>
                        <td>
                            {{ App\Models\Invoice::DISCOUNT_TYPE_SELECT[$invoice->discount_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.discount_amount') }}
                        </th>
                        <td>
                            {{ $invoice->discount_amount }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.invoices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#invoice_invoice_details" role="tab" data-toggle="tab">
                {{ trans('cruds.invoiceDetail.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="invoice_invoice_details">
            @includeIf('admin.invoices.relationships.invoiceInvoiceDetails', ['invoiceDetails' => $invoice->invoiceInvoiceDetails])
        </div>
    </div>
</div>

@endsection