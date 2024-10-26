@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.assignedTask.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.assigned-tasks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTask.fields.id') }}
                        </th>
                        <td>
                            {{ $assignedTask->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTask.fields.task') }}
                        </th>
                        <td>
                            {{ $assignedTask->task->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTask.fields.assigned_to') }}
                        </th>
                        <td>
                            {{ $assignedTask->assigned_to->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTask.fields.company') }}
                        </th>
                        <td>
                            {{ $assignedTask->company->username_for_pan_tan ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTask.fields.user') }}
                        </th>
                        <td>
                            {{ $assignedTask->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTask.fields.description') }}
                        </th>
                        <td>
                            {{ $assignedTask->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTask.fields.hours_estimation') }}
                        </th>
                        <td>
                            {{ $assignedTask->hours_estimation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTask.fields.requirement') }}
                        </th>
                        <td>
                            @foreach($assignedTask->requirement as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTask.fields.proof_of_work') }}
                        </th>
                        <td>
                            @foreach($assignedTask->proof_of_work as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTask.fields.status') }}
                        </th>
                        <td>
                            {{ $assignedTask->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTask.fields.is_approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $assignedTask->is_approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTask.fields.target_date') }}
                        </th>
                        <td>
                            {{ $assignedTask->target_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTask.fields.completed_date') }}
                        </th>
                        <td>
                            {{ $assignedTask->completed_date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.assigned-tasks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#assigned_task_assigned_sub_tasks" role="tab" data-toggle="tab">
                {{ trans('cruds.assignedSubTask.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="assigned_task_assigned_sub_tasks">
            @includeIf('admin.assignedTasks.relationships.assignedTaskAssignedSubTasks', ['assignedSubTasks' => $assignedTask->assignedTaskAssignedSubTasks])
        </div>
    </div>
</div>

@endsection