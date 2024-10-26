<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAccountNameRequest;
use App\Http\Requests\StoreAccountNameRequest;
use App\Http\Requests\UpdateAccountNameRequest;
use App\Models\AccountName;
use App\Models\AccountType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AccountNameController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('account_name_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AccountName::with(['account_type', 'team'])->select(sprintf('%s.*', (new AccountName())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'account_name_show';
                $editGate = 'account_name_edit';
                $deleteGate = 'account_name_delete';
                $crudRoutePart = 'account-names';

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
            $table->addColumn('account_type_type', function ($row) {
                return $row->account_type ? $row->account_type->type : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'account_type']);

            return $table->make(true);
        }

        return view('admin.accountNames.index');
    }

    public function create()
    {
        abort_if(Gate::denies('account_name_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $account_types = AccountType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.accountNames.create', compact('account_types'));
    }

    public function store(StoreAccountNameRequest $request)
    {
        $accountName = AccountName::create($request->all());

        return redirect()->route('admin.account-names.index');
    }

    public function edit(AccountName $accountName)
    {
        abort_if(Gate::denies('account_name_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $account_types = AccountType::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $accountName->load('account_type', 'team');

        return view('admin.accountNames.edit', compact('accountName', 'account_types'));
    }

    public function update(UpdateAccountNameRequest $request, AccountName $accountName)
    {
        $accountName->update($request->all());

        return redirect()->route('admin.account-names.index');
    }

    public function show(AccountName $accountName)
    {
        abort_if(Gate::denies('account_name_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accountName->load('account_type', 'team', 'accountNameProducts');

        return view('admin.accountNames.show', compact('accountName'));
    }

    public function destroy(AccountName $accountName)
    {
        abort_if(Gate::denies('account_name_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accountName->delete();

        return back();
    }

    public function massDestroy(MassDestroyAccountNameRequest $request)
    {
        AccountName::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getAccountName(Request $request)
    {
        $term = $request->q['term'];

        if(auth()->user())
        {
            $account_name = AccountName::where('name','LIKE',"%$term%")->get();
        }

        $account_name = $account_name->toArray();

        if(empty($account_name)){
            $account_name[] = [
                'id' => 0,
                'name' => 'Add New Account Name',
            ];
        }
        echo json_encode($account_name);
    }

    public function accountNameStore(Request $request)
    {
        $account_name = AccountName::create([
            'name' => $request->acc_name,
            'account_type_id'  => $request->account_type ,
        ]);

        if(isset(auth()->user()->team))
        {
            $account_name->update(['team_id' => auth()->user()->team->id]);

        }

        return $account_name ;
    }
}
