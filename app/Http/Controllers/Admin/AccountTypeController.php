<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAccountTypeRequest;
use App\Http\Requests\StoreAccountTypeRequest;
use App\Http\Requests\UpdateAccountTypeRequest;
use App\Models\AccountType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AccountTypeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('account_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AccountType::query()->select(sprintf('%s.*', (new AccountType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'account_type_show';
                $editGate = 'account_type_edit';
                $deleteGate = 'account_type_delete';
                $crudRoutePart = 'account-types';

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
            $table->editColumn('type', function ($row) {
                return $row->type ? AccountType::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('account_group', function ($row) {
                return $row->account_group ? AccountType::ACCOUNT_GROUP_SELECT[$row->account_group] : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.accountTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('account_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.accountTypes.create');
    }

    public function store(StoreAccountTypeRequest $request)
    {
        $accountType = AccountType::create($request->all());

        return redirect()->route('admin.account-types.index');
    }

    public function edit(AccountType $accountType)
    {
        abort_if(Gate::denies('account_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.accountTypes.edit', compact('accountType'));
    }

    public function update(UpdateAccountTypeRequest $request, AccountType $accountType)
    {
        $accountType->update($request->all());

        return redirect()->route('admin.account-types.index');
    }

    public function show(AccountType $accountType)
    {
        abort_if(Gate::denies('account_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accountType->load('accountTypeAccountNames');

        return view('admin.accountTypes.show', compact('accountType'));
    }

    public function destroy(AccountType $accountType)
    {
        abort_if(Gate::denies('account_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accountType->delete();

        return back();
    }

    public function massDestroy(MassDestroyAccountTypeRequest $request)
    {
        AccountType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getaccountType(Request $request)
    {
        $term = $request->q['term'];

        if(auth()->user())
        {
            $account_type = AccountType::where('name','LIKE',"%$term%")->get();
        }

        $account_type = $account_type->toArray();

        if(empty($account_type)){
            $account_type[] = [
                'id' => 0,
                'name' => 'Add New Account Type',
            ];
        }
        echo json_encode($account_type);
    }

    public function accountTypeStore(Request $request)
    {
        $account_type = AccountType::create([
            'type' => $request->type,
            'account_group'  => $request->account_group ,
            'name' => $request->acc_type
        ]);

        return $account_type ;
    }
}
