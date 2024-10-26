@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.assignedTaskDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.assigned-task-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTaskDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $assignedTaskDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTaskDetail.fields.task') }}
                        </th>
                        <td>
                            {{ $assignedTaskDetail->task->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTaskDetail.fields.assigned_task') }}
                        </th>
                        <td>
                            {{ $assignedTaskDetail->assigned_task->description ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTaskDetail.fields.date') }}
                        </th>
                        <td>
                            {{ $assignedTaskDetail->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTaskDetail.fields.start_time') }}
                        </th>
                        <td>
                            {{ $assignedTaskDetail->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTaskDetail.fields.end_time') }}
                        </th>
                        <td>
                            {{ $assignedTaskDetail->end_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTaskDetail.fields.status') }}
                        </th>
                        <td>
                            {{ $assignedTaskDetail->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedTaskDetail.fields.is_approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $assignedTaskDetail->is_approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.assigned-task-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection