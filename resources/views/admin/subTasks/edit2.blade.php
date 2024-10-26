@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Edit Sub-Task
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.sub-tasks.update-subtasks') }}" enctype="multipart/form-data">
            @csrf
            <div class="row form-group">
                <div class="col-md-4">
                    <label class="required" for="department_id">{{ trans('cruds.subTask.fields.department') }}</label>
                    <input type="hidden" name="department_id" id="department_id" value="{{ isset($subtask->department_id) ? $subtask->department_id : '' }}">
                    <input class="form-control {{ $errors->has('department_id') ? 'is-invalid' : '' }}" type="text" name="department_name" id="department_name" value="{{ isset($subtask->department->name) ? $subtask->department->name : '' }}" readonly required>
                    @if($errors->has('department'))
                        <span class="text-danger">{{ $errors->first('department') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.subTask.fields.department_helper') }}</span>
                </div>
                <div class="col-md-4">
                    <label class="required" for="task_id">{{ trans('cruds.subTask.fields.task') }}</label>
                    <input type="hidden" name="task_id" id="task_id" value="{{ isset($subtask->task_id) ? $subtask->task_id : '' }}">
                    <input class="form-control {{ $errors->has('task_id') ? 'is-invalid' : '' }}" type="text" name="task_name" id="task_name" value="{{ isset($subtask->task->name) ? $subtask->task->name : '' }}" readonly required>
                    @if($errors->has('task'))
                        <span class="text-danger">{{ $errors->first('task') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.subTask.fields.task_helper') }}</span>
                </div>
                <div class="col-md-4">
                    <input type="hidden" name="company_id" id="company_id" value="{{ isset($subtask->company->id) ? $subtask->company->id : '' }}">
                    <label class="required" for="company_id">Company</label>
                    <input type="text" class="form-control" value="{{ isset($subtask->company->company_name) ? $subtask->company->company_name : '' }}" name="company_name" id="company_name" readonly required>
                </div>
            </div>
            <div class="form-group subtasks-div">
                <div class="row form-group">
                    <div class="col-md-4">
                        <input type="hidden" id="sub_task_id" name="sub_task_id" value="{{ isset($subtask->id) ? $subtask->id : '' }}"> 
                        <label class="required" for="name">{{ trans('cruds.subTask.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ isset($subtask->name) ? $subtask->name : '' }}" required>
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.subTask.fields.name_helper') }}</span>
                    </div>
                    <div class="col-md-4">
                        <label class="required" for="assigned_id">Assigned Sub-Tasks</label>
                        <select class="form-control select2 assigned_id {{ $errors->has('assigned_id') ? 'is-invalid' : '' }}"
                            name="assigned_id" id="assigned_id" required>
                            @foreach ($taxtube_employees as $id => $entry)
                                <option value="{{ $id }}" {{ (old('assigned_id') ? old('assigned_id') : $subtask->assigned_id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="required">{{ trans('cruds.subTask.fields.frequency') }}</label>
                        <select class="form-control {{ $errors->has('frequency') ? 'is-invalid' : '' }}" name="frequency" id="frequency" required>
                            <option value disabled {{ old('frequency', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\SubTask::FREQUENCY_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ (old('frequency') ? old('frequency') : $subtask->frequency ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('frequency'))
                            <span class="text-danger">{{ $errors->first('frequency') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.subTask.fields.frequency_helper') }}</span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5">
                        <label for="description">{{ trans('cruds.subTask.fields.description') }}</label>
                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ isset($subtask->description) ? $subtask->description : '' }}</textarea>
                            @if($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        <span class="help-block">{{ trans('cruds.subTask.fields.description_helper') }}</span>
                    </div>
                    <div class="col-md-2">
                        <label for="due_date">{{ trans('cruds.subTask.fields.due_date') }}</label>
                        <input class="form-control {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="date" name="due_date" id="due_date" value="{{ isset($subtask->due_date) ? $subtask->due_date : '' }}">
                        @if($errors->has('due_date'))
                            <span class="text-danger">{{ $errors->first('due_date') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.subTask.fields.due_date_helper') }}</span>
                    </div>
                    @if($notice_of_subtask == 0) 
                    <div class="col-md-3">
                        <label class="">Dependence(Set Dependence of Sub-Tasks)</label>
                        <select class="form-control {{ $errors->has('dependence') ? 'is-invalid' : '' }}" name="dependence" id="dependence">
                            @foreach($dependent_subtasks as $key => $label)
                                <option value="{{ $key }}" {{ (old('dependence') ? old('dependence') : $subtask->dependence ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <div class="col-md-3">
                        <label class="">Dependence(Set Dependence of Sub-Tasks)</label>
                        <input class="form-control" id="dependence" name="dependence" value="First Sub-Task Not Dependent" readonly>
                    </div>
                    @endif
                </div>
            </div>    
            <div class="form-group mt-3">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
$('.clone-subtasks-btn').click(function() {
    $('.assigned_id').select2('destroy');
    let clone = $('.subtasks-div').eq(0).clone();
    let length = $('.subtasks-div').length;
    clone.find('#assigned_id').attr('id', 'assigned_id_' + length);
    clone.find('#sub_task_id').val('');
    clone.find('#name').val('');
    clone.find('#description').val('');
    clone.find('#due_date').val('');
    clone.find('#frequency').val('');
    clone.find('#priority').val('');
    clone.find('.assigned_id').val('');
    clone.find('.clone-subtasks-div').html(
        '<button type="button" class="btn btn-danger remove-user-btn">Remove</button>');
    clone.find('.clone-subtasks-div').removeAttr('hidden');

    $('.subtasks-div').last().after(clone);
    $('.assigned_id').select2();
})

$(document).on('click', '.remove-user-btn', function() {
    $(this).closest('.subtasks-div').remove();
});

</script>
@endsection