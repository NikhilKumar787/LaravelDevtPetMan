<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceDetailRequest;
use App\Http\Requests\UpdateInvoiceDetailRequest;
use App\Http\Resources\Admin\InvoiceDetailResource;
use App\Models\InvoiceDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceDetailsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('invoice_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InvoiceDetailResource(InvoiceDetail::with(['invoice', 'product', 'team'])->get());
    }

    public function store(StoreInvoiceDetailRequest $request)
    {
        $invoiceDetail = InvoiceDetail::create($request->all());

        return (new InvoiceDetailResource($invoiceDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(InvoiceDetail $invoiceDetail)
    {
        abort_if(Gate::denies('invoice_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InvoiceDetailResource($invoiceDetail->load(['invoice', 'product', 'team']));
    }

    public function update(UpdateInvoiceDetailRequest $request, InvoiceDetail $invoiceDetail)
    {
        $invoiceDetail->update($request->all());

        return (new InvoiceDetailResource($invoiceDetail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(InvoiceDetail $invoiceDetail)
    {
        abort_if(Gate::denies('invoice_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoiceDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
