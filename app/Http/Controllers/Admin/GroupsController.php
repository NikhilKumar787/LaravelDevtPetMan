<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGroupRequest;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Customer;
use App\Models\Group;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GroupsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Group::with(['customers'])->select(sprintf('%s.*', (new Group())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'group_show';
                $editGate = 'group_edit';
                $deleteGate = 'group_delete';
                $crudRoutePart = 'groups';

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
            $table->editColumn('customers', function ($row) {
                $labels = [];
                foreach ($row->customers as $customer) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $customer->first_name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'customers']);

            return $table->make(true);
        }

        return view('admin.groups.index');
    }

    public function create()
    {
        abort_if(Gate::denies('group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = Customer::pluck('first_name', 'id');

        return view('admin.groups.create', compact('customers'));
    }

    public function store(StoreGroupRequest $request)
    {
        $group = Group::create($request->all());
        $group->customers()->sync($request->input('customers', []));

        return redirect()->route('admin.groups.index');
    }

    public function edit(Group $group)
    {
        abort_if(Gate::denies('group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = Customer::pluck('first_name', 'id');

        $group->load('customers');

        return view('admin.groups.edit', compact('customers', 'group'));
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update($request->all());
        $group->customers()->sync($request->input('customers', []));

        return redirect()->route('admin.groups.index');
    }

    public function show(Group $group)
    {
        abort_if(Gate::denies('group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $group->load('customers');

        return view('admin.groups.show', compact('group'));
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
