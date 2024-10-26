<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentFuncation;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateDepartmentFuncationRequest;
use Symfony\Component\HttpFoundation\Response;
use Gate;
use Yajra\DataTables\Facades\DataTables;

class DepartmentFuncationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('department_funcation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DepartmentFuncation::with(['department'])->select(sprintf('%s.*', (new DepartmentFuncation())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'department_funcation_show';
                $editGate = 'department_funcation_edit';
                $deleteGate = 'department_funcation_delete';
                $crudRoutePart = 'department_funcations';

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
            $table->editColumn('funcation_name', function ($row) {
                return $row->funcation_name ? $row->funcation_name : '';
            });
            $table->addColumn('department', function ($row) {
                return $row->department ? $row->department->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'department_name']);

            return $table->make(true);
        }

        return view('admin.departmentFuncation.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('department_funcation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $department = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.departmentFuncation.create', compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $department_funcation = DepartmentFuncation::create($request->all());
        return redirect()->route('admin.department_funcations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentFuncation $departmentFuncation)
    {
        abort_if(Gate::denies('department_funcation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departmentFuncation->load('department');

        return view('admin.departmentFuncation.show', compact('departmentFuncation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DepartmentFuncation $departmentFuncation)
    {
        abort_if(Gate::denies('department_funcation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $department_id = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $departmentFuncation->load('department');

        return view('admin.departmentFuncation.edit', compact('departmentFuncation','department_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DepartmentFuncation $departmentFuncation)
    {
        $departmentFuncation->update($request->all());
        return redirect()->route('admin.department_funcations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentFuncation $departmentFuncation)
    {
        abort_if(Gate::denies('department_funcation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $departmentFuncation->delete();
        return back();
    }
}
