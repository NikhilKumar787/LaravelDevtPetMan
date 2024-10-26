@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.assignedSubTask.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.assigned-sub-tasks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTask.fields.id') }}
                        </th>
                        <td>
                            {{ $assignedSubTask->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTask.fields.task') }}
                        </th>
                        <td>
                            {{ $assignedSubTask->task->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTask.fields.sub_task') }}
                        </th>
                        <td>
                            {{ $assignedSubTask->sub_task->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTask.fields.assigned_to') }}
                        </th>
                        <td>
                            {{ $assignedSubTask->assigned_to->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTask.fields.company') }}
                        </th>
                        <td>
                            {{ $assignedSubTask->company->username_for_pan_tan ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTask.fields.user') }}
                        </th>
                        <td>
                            {{ $assignedSubTask->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTask.fields.description') }}
                        </th>
                        <td>
                            {{ $assignedSubTask->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTask.fields.hours_estimation') }}
                        </th>
                        <td>
                            {{ $assignedSubTask->hours_estimation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTask.fields.requirement') }}
                        </th>
                        <td>
                            @foreach($assignedSubTask->requirement as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTask.fields.proof_of_work') }}
                        </th>
                        <td>
                            @foreach($assignedSubTask->proof_of_work as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTask.fields.status') }}
                        </th>
                        <td>
                            {{ $assignedSubTask->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTask.fields.is_approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $assignedSubTask->is_approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTask.fields.target_date') }}
                        </th>
                        <td>
                            {{ $assignedSubTask->target_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTask.fields.completed_date') }}
                        </th>
                        <td>
                            {{ $assignedSubTask->completed_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTask.fields.assigned_task') }}
                        </th>
                        <td>
                            {{ $assignedSubTask->assigned_task->description ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.assigned-sub-tasks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection