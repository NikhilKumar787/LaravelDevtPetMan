<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAssignedTaskRequest;
use App\Http\Requests\UpdateAssignedTaskRequest;
use App\Http\Resources\Admin\AssignedTaskResource;
use App\Models\AssignedTask;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssignedTaskApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('assigned_task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssignedTaskResource(AssignedTask::with(['task', 'assigned_to', 'company', 'user', 'status'])->get());
    }

    public function store(StoreAssignedTaskRequest $request)
    {
        $assignedTask = AssignedTask::create($request->all());

        foreach ($request->input('requirement', []) as $file) {
            $assignedTask->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('requirement');
        }

        foreach ($request->input('proof_of_work', []) as $file) {
            $assignedTask->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('proof_of_work');
        }

        return (new AssignedTaskResource($assignedTask))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AssignedTask $assignedTask)
    {
        abort_if(Gate::denies('assigned_task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssignedTaskResource($assignedTask->load(['task', 'assigned_to', 'company', 'user', 'status']));
    }

    public function update(UpdateAssignedTaskRequest $request, AssignedTask $assignedTask)
    {
        $assignedTask->update($request->all());

        if (count($assignedTask->requirement) > 0) {
            foreach ($assignedTask->requirement as $media) {
                if (!in_array($media->file_name, $request->input('requirement', []))) {
                    $media->delete();
                }
            }
        }
        $media = $assignedTask->requirement->pluck('file_name')->toArray();
        foreach ($request->input('requirement', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $assignedTask->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('requirement');
            }
        }

        if (count($assignedTask->proof_of_work) > 0) {
            foreach ($assignedTask->proof_of_work as $media) {
                if (!in_array($media->file_name, $request->input('proof_of_work', []))) {
                    $media->delete();
                }
            }
        }
        $media = $assignedTask->proof_of_work->pluck('file_name')->toArray();
        foreach ($request->input('proof_of_work', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $assignedTask->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('proof_of_work');
            }
        }

        return (new AssignedTaskResource($assignedTask))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AssignedTask $assignedTask)
    {
        abort_if(Gate::denies('assigned_task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignedTask->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
