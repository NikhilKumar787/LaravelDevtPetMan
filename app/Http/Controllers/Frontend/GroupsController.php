<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGroupRequest;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Customer;
use App\Models\Group;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::with(['customers'])->get();

        return view('frontend.groups.index', compact('groups'));
    }

    public function create()
    {
        abort_if(Gate::denies('group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = Customer::pluck('first_name', 'id');

        return view('frontend.groups.create', compact('customers'));
    }

    public function store(StoreGroupRequest $request)
    {
        $group = Group::create($request->all());
        $group->customers()->sync($request->input('customers', []));

        return redirect()->route('frontend.groups.index');
    }

    public function edit(Group $group)
    {
        abort_if(Gate::denies('group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = Customer::pluck('first_name', 'id');

        $group->load('customers');

        return view('frontend.groups.edit', compact('customers', 'group'));
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update($request->all());
        $group->customers()->sync($request->input('customers', []));

        return redirect()->route('frontend.groups.index');
    }

    public function show(Group $group)
    {
        abort_if(Gate::denies('group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $group->load('customers');

        return view('frontend.groups.show', compact('group'));
    }

    public function destroy(Group $group)
    {
        abort_if(Gate::denies('group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $group->delete();

        return back();
    }

    public function massDestroy(MassDestroyGroupRequest $request)
    {
        Group::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function groupStore(Request $request)
    {
        $group = Group::create([
            'name' => $request->group_name
        ]);

        return $group ;
    }
}
