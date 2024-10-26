<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAssignedSubTaskDetailRequest;
use App\Http\Requests\StoreAssignedSubTaskDetailRequest;
use App\Http\Requests\UpdateAssignedSubTaskDetailRequest;
use App\Models\AssignedSubTask;
use App\Models\AssignedSubTaskDetail;
use App\Models\SubTask;
use App\Models\Task;
use App\Models\TaskStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;


class AssignedSubTaskDetailsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('assigned_sub_task_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AssignedSubTaskDetail::with(['sub_task', 'assigned_sub_task' => function($assigned_sub_task){
                $assigned_sub_task->where('assigned_to_id',auth()->user()->id);
            } , 'status'])->select(sprintf('%s.*', (new AssignedSubTaskDetail())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $assignedSubTaskGate = 'assigned_sub_task_detail_access';
                $viewGate = 'assigned_sub_task_detail_show';
                $editGate = 'assigned_sub_task_detail_edit';
                $deleteGate = 'assigned_sub_task_detail_delete';
                $crudRoutePart = 'assigned-sub-task-details';

                return view('partials.datatablesActions', compact(
                'assignedSubTaskGate',
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
            $table->addColumn('sub_task_name', function ($row) {
                return $row->sub_task ? $row->sub_task->name : '';
            });

            $table->addColumn('assigned_sub_task_description', function ($row) {
                return $row->assigned_sub_task ? $row->assigned_sub_task->description : '';
            });

            $table->editColumn('start_time', function ($row) {
                return $row->start_time ? $row->start_time : '';
            });
            $table->editColumn('end_time', function ($row) {
                return $row->end_time ? $row->end_time : '';
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });
            $table->addColumn('company_name', function ($row) {
                if($row->assigned_sub_task->company != null){
                    return $row->assigned_sub_task->company->company_name ? $row->assigned_sub_task->company->company_name : '';
                }
            });

            $table->editColumn('is_approved', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_approved ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'task', 'assigned_task', 'status', 'is_approved']);

            return $table->make(true);
        }

        return view('admin.assignedSubTaskDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('assigned_sub_task_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sub_tasks = SubTask::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_sub_tasks = AssignedSubTask::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.assignedSubTaskDetails.create', compact('assigned_sub_tasks', 'statuses', 'sub_tasks'));
    }

    public function store(StoreAssignedSubTaskDetailRequest $request)
    {
        $assignedSubTaskDetail = AssignedSubTaskDetail::create($request->all());

        return redirect()->route('admin.assigned-sub-task-details.index');
    }

    public function edit(AssignedSubTaskDetail $assignedSubTaskDetail)
    {
        abort_if(Gate::denies('assigned_sub_task_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sub_tasks = SubTask::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_sub_tasks = AssignedSubTask::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assignedSubTaskDetail->load('sub_task', 'assigned_sub_task', 'status');

        return view('admin.assignedSubTaskDetails.edit', compact('assignedSubTaskDetail', 'assigned_sub_tasks', 'statuses', 'sub_tasks'));
    }

    public function update(UpdateAssignedSubTaskDetailRequest $request, AssignedSubTaskDetail $assignedSubTaskDetail)
    {
        $assignedSubTaskDetail->update($request->all());

        return redirect()->route('admin.assigned-sub-task-details.index');
    }

    public function show(AssignedSubTaskDetail $assignedSubTaskDetail)
    {
        abort_if(Gate::denies('assigned_sub_task_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignedSubTaskDetail->load('sub_task', 'assigned_sub_task', 'status');

        return view('admin.assignedSubTaskDetails.show', compact('assignedSubTaskDetail'));
    }

    public function destroy(AssignedSubTaskDetail $assignedSubTaskDetail)
    {
        abort_if(Gate::denies('assigned_sub_task_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignedSubTaskDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssignedSubTaskDetailRequest $request)
    {
        AssignedSubTaskDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
