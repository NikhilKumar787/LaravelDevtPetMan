@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.assignedSubTaskDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.assigned-sub-task-details.update", [$assignedSubTaskDetail->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="sub_task_id">{{ trans('cruds.assignedSubTaskDetail.fields.sub_task') }}</label>
                <select class="form-control select2 {{ $errors->has('sub_task') ? 'is-invalid' : '' }}" name="sub_task_id" id="sub_task_id">
                    @foreach($sub_tasks as $id => $entry)
                        <option value="{{ $id }}" {{ (old('sub_task_id') ? old('sub_task_id') : $assignedSubTaskDetail->sub_task->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sub_task'))
                    <span class="text-danger">{{ $errors->first('sub_task') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedSubTaskDetail.fields.sub_task_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="assigned_sub_task_id">{{ trans('cruds.assignedSubTaskDetail.fields.assigned_sub_task') }}</label>
                <select class="form-control select2 {{ $errors->has('assigned_sub_task') ? 'is-invalid' : '' }}" name="assigned_sub_task_id" id="assigned_sub_task_id" required>
                    @foreach($assigned_sub_tasks as $id => $entry)
                        <option value="{{ $id }}" {{ (old('assigned_sub_task_id') ? old('assigned_sub_task_id') : $assignedSubTaskDetail->assigned_sub_task->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('assigned+_sub_task'))
                    <span class="text-danger">{{ $errors->first('assigned_sub_task') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedSubTaskDetail.fields.assigned_sub_task_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.assignedSubTaskDetail.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $assignedSubTaskDetail->date) }}">
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedSubTaskDetail.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_time">{{ trans('cruds.assignedSubTaskDetail.fields.start_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time', $assignedSubTaskDetail->start_time) }}">
                @if($errors->has('start_time'))
                    <span class="text-danger">{{ $errors->first('start_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedSubTaskDetail.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_time">{{ trans('cruds.assignedSubTaskDetail.fields.end_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="end_time" value="{{ old('end_time', $assignedSubTaskDetail->end_time) }}">
                @if($errors->has('end_time'))
                    <span class="text-danger">{{ $errors->first('end_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedSubTaskDetail.fields.end_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.assignedSubTaskDetail.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $assignedSubTaskDetail->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedSubTaskDetail.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_approved') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_approved" value="0">
                    <input class="form-check-input" type="checkbox" name="is_approved" id="is_approved" value="1" {{ $assignedSubTaskDetail->is_approved || old('is_approved', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_approved">{{ trans('cruds.assignedSubTaskDetail.fields.is_approved') }}</label>
                </div>
                @if($errors->has('is_approved'))
                    <span class="text-danger">{{ $errors->first('is_approved') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedSubTaskDetail.fields.is_approved_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection