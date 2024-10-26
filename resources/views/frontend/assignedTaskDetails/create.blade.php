@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.assignedTaskDetail.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.assigned-task-details.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="task_id">{{ trans('cruds.assignedTaskDetail.fields.task') }}</label>
                            <select class="form-control select2" name="task_id" id="task_id">
                                @foreach($tasks as $id => $entry)
                                    <option value="{{ $id }}" {{ old('task_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('task'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('task') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedTaskDetail.fields.task_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="assigned_task_id">{{ trans('cruds.assignedTaskDetail.fields.assigned_task') }}</label>
                            <select class="form-control select2" name="assigned_task_id" id="assigned_task_id" required>
                                @foreach($assigned_tasks as $id => $entry)
                                    <option value="{{ $id }}" {{ old('assigned_task_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('assigned_task'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('assigned_task') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedTaskDetail.fields.assigned_task_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="date">{{ trans('cruds.assignedTaskDetail.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date') }}">
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedTaskDetail.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="start_time">{{ trans('cruds.assignedTaskDetail.fields.start_time') }}</label>
                            <input class="form-control timepicker" type="text" name="start_time" id="start_time" value="{{ old('start_time') }}">
                            @if($errors->has('start_time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_time') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedTaskDetail.fields.start_time_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="end_time">{{ trans('cruds.assignedTaskDetail.fields.end_time') }}</label>
                            <input class="form-control timepicker" type="text" name="end_time" id="end_time" value="{{ old('end_time') }}">
                            @if($errors->has('end_time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_time') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedTaskDetail.fields.end_time_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status_id">{{ trans('cruds.assignedTaskDetail.fields.status') }}</label>
                            <select class="form-control select2" name="status_id" id="status_id">
                                @foreach($statuses as $id => $entry)
                                    <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedTaskDetail.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_approved" value="0">
                                <input type="checkbox" name="is_approved" id="is_approved" value="1" {{ old('is_approved', 0) == 1 ? 'checked' : '' }}>
                                <label for="is_approved">{{ trans('cruds.assignedTaskDetail.fields.is_approved') }}</label>
                            </div>
                            @if($errors->has('is_approved'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_approved') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedTaskDetail.fields.is_approved_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection