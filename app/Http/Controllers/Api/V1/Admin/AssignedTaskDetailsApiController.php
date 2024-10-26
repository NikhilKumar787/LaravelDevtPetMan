<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssignedTaskDetailRequest;
use App\Http\Requests\UpdateAssignedTaskDetailRequest;
use App\Http\Resources\Admin\AssignedTaskDetailResource;
use App\Models\AssignedTaskDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssignedTaskDetailsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('assigned_task_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssignedTaskDetailResource(AssignedTaskDetail::with(['task', 'assigned_task', 'status'])->get());
    }

    public function store(StoreAssignedTaskDetailRequest $request)
    {
        $assignedTaskDetail = AssignedTaskDetail::create($request->all());

        return (new AssignedTaskDetailResource($assignedTaskDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AssignedTaskDetail $assignedTaskDetail)
    {
        abort_if(Gate::denies('assigned_task_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssignedTaskDetailResource($assignedTaskDetail->load(['task', 'assigned_task', 'status']));
    }

    public function update(UpdateAssignedTaskDetailRequest $request, AssignedTaskDetail $assignedTaskDetail)
    {
        $assignedTaskDetail->update($request->all());

        return (new AssignedTaskDetailResource($assignedTaskDetail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AssignedTaskDetail $assignedTaskDetail)
    {
        abort_if(Gate::denies('assigned_task_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignedTaskDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
