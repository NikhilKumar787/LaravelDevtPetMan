<?php

namespace App\Http\Controllers\Frontend;

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

class AssignedTaskDetailsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('assigned_task_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignedTaskDetails = AssignedTaskDetail::with(['task', 'assigned_task', 'status'])->get();

        return view('frontend.assignedTaskDetails.index', compact('assignedTaskDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('assigned_task_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tasks = AssignedTask::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.assignedTaskDetails.create', compact('assigned_tasks', 'statuses', 'tasks'));
    }

    public function store(StoreAssignedTaskDetailRequest $request)
    {
        $assignedTaskDetail = AssignedTaskDetail::create($request->all());

        return redirect()->route('frontend.assigned-task-details.index');
    }

    public function edit(AssignedTaskDetail $assignedTaskDetail)
    {
        abort_if(Gate::denies('assigned_task_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tasks = AssignedTask::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assignedTaskDetail->load('task', 'assigned_task', 'status');

        return view('frontend.assignedTaskDetails.edit', compact('assignedTaskDetail', 'assigned_tasks', 'statuses', 'tasks'));
    }

    public function update(UpdateAssignedTaskDetailRequest $request, AssignedTaskDetail $assignedTaskDetail)
    {
        $assignedTaskDetail->update($request->all());

        return redirect()->route('frontend.assigned-task-details.index');
    }

    public function show(AssignedTaskDetail $assignedTaskDetail)
    {
        abort_if(Gate::denies('assigned_task_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignedTaskDetail->load('task', 'assigned_task', 'status');

        return view('frontend.assignedTaskDetails.show', compact('assignedTaskDetail'));
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
