<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountNameRequest;
use App\Http\Requests\UpdateAccountNameRequest;
use App\Http\Resources\Admin\AccountNameResource;
use App\Models\AccountName;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountNameApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('account_name_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AccountNameResource(AccountName::with(['account_type', 'team'])->get());
    }

    public function store(StoreAccountNameRequest $request)
    {
        $accountName = AccountName::create($request->all());

        return (new AccountNameResource($accountName))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AccountName $accountName)
    {
        abort_if(Gate::denies('account_name_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AccountNameResource($accountName->load(['account_type', 'team']));
    }

    public function update(UpdateAccountNameRequest $request, AccountName $accountName)
    {
        $accountName->update($request->all());

        return (new AccountNameResource($accountName))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AccountName $accountName)
    {
        abort_if(Gate::denies('account_name_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accountName->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
