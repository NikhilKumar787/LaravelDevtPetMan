<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAccountNameRequest;
use App\Http\Requests\StoreAccountNameRequest;
use App\Http\Requests\UpdateAccountNameRequest;
use App\Models\AccountName;
use App\Models\AccountType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountNameController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('account_name_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accountNames = AccountName::with(['account_type', 'team'])->get();

        return view('frontend.accountNames.index', compact('accountNames'));
    }

    public function create()
    {
        abort_if(Gate::denies('account_name_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $account_types = AccountType::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.accountNames.create', compact('account_types'));
    }

    public function store(StoreAccountNameRequest $request)
    {
        $accountName = AccountName::create($request->all());

        return redirect()->route('frontend.account-names.index');
    }

    public function edit(AccountName $accountName)
    {
        abort_if(Gate::denies('account_name_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $account_types = AccountType::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $accountName->load('account_type', 'team');

        return view('frontend.accountNames.edit', compact('accountName', 'account_types'));
    }

    public function update(UpdateAccountNameRequest $request, AccountName $accountName)
    {
        $accountName->update($request->all());

        return redirect()->route('frontend.account-names.index');
    }

    public function show(AccountName $accountName)
    {
        abort_if(Gate::denies('account_name_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accountName->load('account_type', 'team');

        return view('frontend.accountNames.show', compact('accountName'));
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
