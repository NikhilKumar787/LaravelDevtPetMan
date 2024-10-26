<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAssignedTaskDetailRequest;
use App\Http\Requests\StoreAssignedTaskDetailRequest;
use App\Http\Requests\UpdateAssignedTaskDetailRequest;
use App\Models\AssignedTask;
use App\Models\AssignedTaskDetail;
use App\Models\Task;
use App\Models\TaskStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AssignedTaskDetailsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('assigned_task_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AssignedTaskDetail::with(['task', 'assigned_task' => function($assigned_task){
                $assigned_task->where('assigned_to_id',auth()->user()->id);
            }, 'status'])->select(sprintf('%s.*', (new AssignedTaskDetail())->table));

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'assigned_task_detail_show';
                $editGate = 'assigned_task_detail_edit';
                $deleteGate = 'assigned_task_detail_delete';
                $crudRoutePart = 'assigned-task-details';

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
            $table->addColumn('task_name', function ($row) {
                return $row->task ? $row->task->name : '';
            });

            $table->addColumn('assigned_task_description', function ($row) {
                return $row->assigned_task ? $row->assigned_task->description : '';
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
                if($row->company != null){
                    return $row->company->company_name ? $row->company->company_name : '';
                }
            });

            $table->editColumn('is_approved', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_approved ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'task', 'assigned_task', 'status', 'is_approved']);

            return $table->make(true);
        }

        return view('admin.assignedTaskDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('assigned_task_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tasks = AssignedTask::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.assignedTaskDetails.create', compact('assigned_tasks', 'statuses', 'tasks'));
    }

    public function store(StoreAssignedTaskDetailRequest $request)
    {
        $assignedTaskDetail = AssignedTaskDetail::create($request->all());

        return redirect()->route('admin.assigned-task-details.index');
    }

    public function edit(AssignedTaskDetail $assignedTaskDetail)
    {
        abort_if(Gate::denies('assigned_task_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tasks = AssignedTask::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assignedTaskDetail->load('task', 'assigned_task', 'status');

        return view('admin.assignedTaskDetails.edit', compact('assignedTaskDetail', 'assigned_tasks', 'statuses', 'tasks'));
    }

    public function update(UpdateAssignedTaskDetailRequest $request, AssignedTaskDetail $assignedTaskDetail)
    {
        $assignedTaskDetail->update($request->all());

        return redirect()->route('admin.assigned-task-details.index');
    }

    public function show(AssignedTaskDetail $assignedTaskDetail)
    {
        abort_if(Gate::denies('assigned_task_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignedTaskDetail->load('task', 'assigned_task', 'status');

        return view('admin.assignedTaskDetails.show', compact('assignedTaskDetail'));
    }

    public function destroy(AssignedTaskDetail $assignedTaskDetail)
    {
        abort_if(Gate::denies('assigned_task_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignedTaskDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssignedTaskDetailRequest $request)
    {
        AssignedTaskDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
