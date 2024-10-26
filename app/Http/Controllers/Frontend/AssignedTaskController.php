<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAssignedTaskRequest;
use App\Http\Requests\StoreAssignedTaskRequest;
use App\Http\Requests\UpdateAssignedTaskRequest;
use App\Models\AssignedTask;
use App\Models\Company;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AssignedTaskController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index() {
        
        abort_if(Gate::denies('assigned_task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignedTasks = AssignedTask::with(['task', 'assigned_to', 'company', 'user', 'status', 'media'])->get();

        return view('frontend.assignedTasks.index', compact('assignedTasks'));
    }

    public function create()
    {
        abort_if(Gate::denies('assigned_task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = Company::pluck('username_for_pan_tan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.assignedTasks.create', compact('assigned_tos', 'companies', 'statuses', 'tasks', 'users'));
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

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $assignedTask->id]);
        }

        return redirect()->route('frontend.assigned-tasks.index');
    }

    public function edit(AssignedTask $assignedTask)
    {
        abort_if(Gate::denies('assigned_task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = Company::pluck('username_for_pan_tan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assignedTask->load('task', 'assigned_to', 'company', 'user', 'status');

        return view('frontend.assignedTasks.edit', compact('assignedTask', 'assigned_tos', 'companies', 'statuses', 'tasks', 'users'));
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

        return redirect()->route('frontend.assigned-tasks.index');
    }

    public function show(AssignedTask $assignedTask)
    {
        abort_if(Gate::denies('assigned_task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignedTask->load('task', 'assigned_to', 'company', 'user', 'status');

        return view('frontend.assignedTasks.show', compact('assignedTask'));
    }

    public function destroy(AssignedTask $assignedTask)
    {
        abort_if(Gate::denies('assigned_task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignedTask->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssignedTaskRequest $request)
    {
        AssignedTask::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('assigned_task_create') && Gate::denies('assigned_task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AssignedTask();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
