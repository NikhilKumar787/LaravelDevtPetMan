<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserAddressRequest;
use App\Http\Requests\StoreUserAddressRequest;
use App\Http\Requests\UpdateUserAddressRequest;
use App\Models\Customer;
use App\Models\User;
use App\Models\UserAddress;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserAddressesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_address_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserAddress::with(['customer', 'user'])->select(sprintf('%s.*', (new UserAddress())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_address_show';
                $editGate = 'user_address_edit';
                $deleteGate = 'user_address_delete';
                $crudRoutePart = 'user-addresses';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('phone_no', function ($row) {
                return $row->phone_no ? $row->phone_no : '';
            });
            $table->editColumn('addressline_1', function ($row) {
                return $row->addressline_1 ? $row->addressline_1 : '';
            });
            $table->editColumn('addressline_2', function ($row) {
                return $row->addressline_2 ? $row->addressline_2 : '';
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->editColumn('zip_code', function ($row) {
                return $row->zip_code ? $row->zip_code : '';
            });
            $table->editColumn('state', function ($row) {
                return $row->state ? $row->state : '';
            });
            $table->addColumn('customer_first_name', function ($row) {
                return $row->customer ? $row->customer->first_name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('uuid', function ($row) {
                return $row->uuid ? $row->uuid : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('same_as', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->same_as ? 'checked' : null) . '>';
            });
            $table->editColumn('default_address', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->default_address ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'customer', 'user', 'same_as', 'default_address']);

            return $table->make(true);
        }

        return view('admin.userAddresses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_address_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = Customer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userAddresses.create', compact('customers', 'users'));
    }

    public function store(StoreUserAddressRequest $request)
    {
        $userAddress = UserAddress::create($request->all());

        return redirect()->route('admin.user-addresses.index');
    }

    public function edit(UserAddress $userAddress)
    {
        abort_if(Gate::denies('user_address_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = Customer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userAddress->load('customer', 'user');

        return view('admin.userAddresses.edit', compact('customers', 'userAddress', 'users'));
    }

    public function update(UpdateUserAddressRequest $request, UserAddress $userAddress)
    {
        $userAddress->update($request->all());

        return redirect()->route('admin.user-addresses.index');
    }

    public function show(UserAddress $userAddress)
    {
        abort_if(Gate::denies('user_address_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAddress->load('customer', 'user');

        return view('admin.userAddresses.show', compact('userAddress'));
    }

    public function destroy(UserAddress $userAddress)
    {
        abort_if(Gate::denies('user_address_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userAddress->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserAddressRequest $request)
    {
        UserAddress::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
