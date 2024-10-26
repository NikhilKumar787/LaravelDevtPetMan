<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class InvoiceDetailsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('invoice_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InvoiceDetail::with(['invoice', 'product', 'team'])->select(sprintf('%s.*', (new InvoiceDetail())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'invoice_detail_show';
                $editGate = 'invoice_detail_edit';
                $deleteGate = 'invoice_detail_delete';
                $crudRoutePart = 'invoice-details';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('invoice_type', function ($row) {
                return $row->invoice ? $row->invoice->type : '';
            });

            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->editColumn('qty', function ($row) {
                return $row->qty ? $row->qty : '';
            });
            $table->editColumn('rate', function ($row) {
                return $row->rate ? $row->rate : '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('tax', function ($row) {
                return $row->tax ? $row->tax : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'invoice', 'product']);

            return $table->make(true);
        }

        return view('admin.invoiceDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('invoice_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoices = Invoice::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.invoiceDetails.create', compact('invoices', 'products'));
    }

    public function store(StoreInvoiceDetailRequest $request)
    {
        $invoiceDetail = InvoiceDetail::create($request->all());

        return redirect()->route('admin.invoice-details.index');
    }

    public function edit(InvoiceDetail $invoiceDetail)
    {
        abort_if(Gate::denies('invoice_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoices = Invoice::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $invoiceDetail->load('invoice', 'product', 'team');

        return view('admin.invoiceDetails.edit', compact('invoiceDetail', 'invoices', 'products'));
    }

    public function update(UpdateInvoiceDetailRequest $request, InvoiceDetail $invoiceDetail)
    {
        $invoiceDetail->update($request->all());

        return redirect()->route('admin.invoice-details.index');
    }

    public function show(InvoiceDetail $invoiceDetail)
    {
        abort_if(Gate::denies('invoice_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoiceDetail->load('invoice', 'product', 'team');

        return view('admin.invoiceDetails.show', compact('invoiceDetail'));
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
