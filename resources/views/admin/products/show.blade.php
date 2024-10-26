@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.product.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.id') }}
                        </th>
                        <td>
                            {{ $product->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.name') }}
                        </th>
                        <td>
                            {{ $product->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.description') }}
                        </th>
                        <td>
                            {{ $product->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.hsn') }}
                        </th>
                        <td>
                            {{ $product->hsn }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.unit') }}
                        </th>
                        <td>
                            {{ $product->unit }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.sales_price') }}
                        </th>
                        <td>
                            {{ $product->sales_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.tax_type') }}
                        </th>
                        <td>
                            {{ App\Models\Product::TAX_TYPE_RADIO[$product->tax_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.gst') }}
                        </th>
                        <td>
                            {{ App\Models\Product::GST_SELECT[$product->gst] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.cess') }}
                        </th>
                        <td>
                            {{ $product->cess }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.cess_type') }}
                        </th>
                        <td>
                            {{ App\Models\Product::CESS_TYPE_SELECT[$product->cess_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.purchase_price') }}
                        </th>
                        <td>
                            {{ $product->purchase_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.price_type') }}
                        </th>
                        <td>
                            {{ App\Models\Product::PRICE_TYPE_SELECT[$product->price_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.item_type') }}
                        </th>
                        <td>
                            {{ App\Models\Product::ITEM_TYPE_RADIO[$product->item_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.wholesale_price') }}
                        </th>
                        <td>
                            {{ $product->wholesale_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.item_code') }}
                        </th>
                        <td>
                            {{ $product->item_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.income_account_type') }}
                        </th>
                        <td>
                            {{ App\Models\Product::INCOME_ACCOUNT_TYPE_SELECT[$product->income_account_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.account_group') }}
                        </th>
                        <td>
                            {{ App\Models\Product::ACCOUNT_GROUP_SELECT[$product->account_group] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.account_type') }}
                        </th>
                        <td>
                            {{ $product->account_type->type ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.account_name') }}
                        </th>
                        <td>
                            {{ $product->account_name->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.category') }}
                        </th>
                        <td>
                            @foreach($product->categories as $key => $category)
                                <span class="label label-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
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
            <a class="nav-link" href="#product_invoice_details" role="tab" data-toggle="tab">
                {{ trans('cruds.invoiceDetail.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="product_invoice_details">
            @includeIf('admin.products.relationships.productInvoiceDetails', ['invoiceDetails' => $product->productInvoiceDetails])
        </div>
    </div>
</div>

@endsection
