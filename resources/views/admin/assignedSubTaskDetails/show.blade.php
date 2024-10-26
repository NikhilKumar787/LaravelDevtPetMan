@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.assignedSubTaskDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.assigned-sub-task-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTaskDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $assignedSubTaskDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTaskDetail.fields.task') }}
                        </th>
                        <td>
                            {{ $assignedSubTaskDetail->sub_task->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTaskDetail.fields.assigned_task') }}
                        </th>
                        <td>
                            {{ $assignedSubTaskDetail->assigned_sub_task->description ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTaskDetail.fields.date') }}
                        </th>
                        <td>
                            {{ $assignedSubTaskDetail->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTaskDetail.fields.start_time') }}
                        </th>
                        <td>
                            {{ $assignedSubTaskDetail->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTaskDetail.fields.end_time') }}
                        </th>
                        <td>
                            {{ $assignedSubTaskDetail->end_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTaskDetail.fields.status') }}
                        </th>
                        <td>
                            {{ $assignedSubTaskDetail->status->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assignedSubTaskDetail.fields.is_approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $assignedSubTaskDetail->is_approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.assigned-sub-task-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection