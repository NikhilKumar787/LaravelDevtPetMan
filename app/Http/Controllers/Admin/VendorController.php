<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyVendorRequest;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use App\Models\City;
use App\Models\State;
use App\Models\Term;
use App\Models\Vendor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('vendor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Vendor::with(['city', 'state', 'term', 'team'])->select(sprintf('%s.*', (new Vendor())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'vendor_show';
                $editGate = 'vendor_edit';
                $deleteGate = 'vendor_delete';
                $crudRoutePart = 'vendors';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? Vendor::TITLE_SELECT[$row->title] : '';
            });
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('middle_name', function ($row) {
                return $row->middle_name ? $row->middle_name : '';
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('company_name', function ($row) {
                return $row->company_name ? $row->company_name : '';
            });
            $table->editColumn('gst_type', function ($row) {
                return $row->gst_type ? Vendor::GST_TYPE_SELECT[$row->gst_type] : '';
            });
            $table->editColumn('gstin', function ($row) {
                return $row->gstin ? $row->gstin : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->addColumn('state_state', function ($row) {
                return $row->state ? $row->state->state : '';
            });

            $table->editColumn('pin_code', function ($row) {
                return $row->pin_code ? $row->pin_code : '';
            });
            $table->editColumn('mobile', function ($row) {
                return $row->mobile ? $row->mobile : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('pancard', function ($row) {
                return $row->pancard ? $row->pancard : '';
            });
            $table->editColumn('other', function ($row) {
                return $row->other ? $row->other : '';
            });
            $table->editColumn('website', function ($row) {
                return $row->website ? $row->website : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('payment_method', function ($row) {
                return $row->payment_method ? $row->payment_method : '';
            });
            $table->addColumn('term_name', function ($row) {
                return $row->term ? $row->term->name : '';
            });

            $table->editColumn('account_no', function ($row) {
                return $row->account_no ? $row->account_no : '';
            });
            $table->editColumn('tax_reg_no', function ($row) {
                return $row->tax_reg_no ? $row->tax_reg_no : '';
            });
            $table->editColumn('effective_date', function ($row) {
                return $row->effective_date ? $row->effective_date : '';
            });
            $table->editColumn('apply_tds', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->apply_tds ? 'checked' : null) . '>';
            });
            $table->editColumn('entity', function ($row) {
                return $row->entity ? Vendor::ENTITY_SELECT[$row->entity] : '';
            });
            $table->editColumn('section', function ($row) {
                return $row->section ? Vendor::SECTION_SELECT[$row->section] : '';
            });
            $table->editColumn('calculation_threshold', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->calculation_threshold ? 'checked' : null) . '>';
            });
            $table->editColumn('is_my_customer', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_my_customer ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'city', 'state', 'term', 'apply_tds', 'calculation_threshold', 'is_my_customer']);

            return $table->make(true);
        }

        return view('admin.vendors.index');
    }

    public function create()
    {
        abort_if(Gate::denies('vendor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        $terms = Term::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.vendors.create', compact('cities', 'states', 'terms'));
    }

    public function store(StoreVendorRequest $request)
    {
        $vendor = Vendor::create($request->all());

        return redirect()->route('admin.vendors.index');
    }

    public function edit(Vendor $vendor)
    {
        abort_if(Gate::denies('vendor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        $terms = Term::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vendor->load('city', 'state', 'term', 'team');

        return view('admin.vendors.edit', compact('cities', 'states', 'terms', 'vendor'));
    }

    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        $vendor->update($request->all());

        return redirect()->route('admin.vendors.index');
    }

    public function show(Vendor $vendor)
    {
        abort_if(Gate::denies('vendor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendor->load('city', 'state', 'term', 'team');

        return view('admin.vendors.show', compact('vendor'));
    }

    public function destroy(Vendor $vendor)
    {
        abort_if(Gate::denies('vendor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendor->delete();

        return back();
    }

    public function massDestroy(MassDestroyVendorRequest $request)
    {
        Vendor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
