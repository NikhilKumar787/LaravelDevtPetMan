<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInvoiceDetailRequest;
use App\Http\Requests\StoreInvoiceDetailRequest;
use App\Http\Requests\UpdateInvoiceDetailRequest;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceDetailsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('invoice_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoiceDetails = InvoiceDetail::with(['invoice', 'product', 'team'])->get();

        return view('frontend.invoiceDetails.index', compact('invoiceDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('invoice_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoices = Invoice::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.invoiceDetails.create', compact('invoices', 'products'));
    }

    public function store(StoreInvoiceDetailRequest $request)
    {
        $invoiceDetail = InvoiceDetail::create($request->all());

        return redirect()->route('frontend.invoice-details.index');
    }

    public function edit(InvoiceDetail $invoiceDetail)
    {
        abort_if(Gate::denies('invoice_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoices = Invoice::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $invoiceDetail->load('invoice', 'product', 'team');

        return view('frontend.invoiceDetails.edit', compact('invoiceDetail', 'invoices', 'products'));
    }

    public function update(UpdateInvoiceDetailRequest $request, InvoiceDetail $invoiceDetail)
    {
        $invoiceDetail->update($request->all());

        return redirect()->route('frontend.invoice-details.index');
    }

    public function show(InvoiceDetail $invoiceDetail)
    {
        abort_if(Gate::denies('invoice_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoiceDetail->load('invoice', 'product', 'team');

        return view('frontend.invoiceDetails.show', compact('invoiceDetail'));
    }

    public function destroy(InvoiceDetail $invoiceDetail)
    {
        abort_if(Gate::denies('invoice_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoiceDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyInvoiceDetailRequest $request)
    {
        InvoiceDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
