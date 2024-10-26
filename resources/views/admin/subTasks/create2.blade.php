@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Manage Sub-Tasks(Single/Multiple-Steps)
    </div>
    <div class="d-flex justify-content-end m-3">
        <h6 class="print3 mr-2">Single-Step</span></h6>
        <label class="switch3">    
            <input type="checkbox" id="define-steps">
            <span class="slider_round"></span>
        </label><h6 class="print3">Multiple-Steps</span></h6>
    </div>
    <div class="card-body" id="single-step">
        <form method="POST" action="{{ route('admin.tasks.assigned-task-employee') }}" enctype="multipart/form-data">
            @csrf
            <h3>Assigned-Sub-Task(Single-Step)</h3>
            <div class="row form-group">
                <div class="col-md-6">
                    <label class="required" for="department_id">{{ trans('cruds.subTask.fields.department') }}</label>
                    <input type="hidden" name="department_id" id="department_id" value="{{ isset($task->department_id) ? $task->department_id : '' }}">
                    <input class="form-control {{ $errors->has('department_id') ? 'is-invalid' : '' }}" type="text" name="department_name" id="department_name" value="{{ isset($task->department->name) ? $task->department->name : '' }}" readonly required>
                    @if($errors->has('department'))
                        <span class="text-danger">{{ $errors->first('department') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.subTask.fields.department_helper') }}</span>
                </div>
                <div class="col-md-6">
                    <label class="required" for="task_id">{{ trans('cruds.subTask.fields.task') }}</label>
                    <input type="hidden" name="task_id" id="task_id" value="{{ isset($task->id) ? $task->id : '' }}">
                    <input class="form-control {{ $errors->has('task_id') ? 'is-invalid' : '' }}" type="text" name="task_name" id="task_name" value="{{ isset($task->name) ? $task->name : '' }}" readonly required>
                    @if($errors->has('task'))
                        <span class="text-danger">{{ $errors->first('task') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.subTask.fields.task_helper') }}</span>
                </div>
            </div>
            <div class="row form-group">
                @if($company_id == '0')
                <div class="col-md-12">
                    <h3 style="font-weight: 500; color:red"">**Please Firstly Select Company In Upper Company Dropdown then Assigned-Sub-Task to any Employee**</h3>
                </div>
                @else
                <div class="col-md-6">
                    <label class="required" for="company_id">Company</label>
                    <input type="hidden" id="company_id" name="company_id" value="{{ isset($companies->id) ? $companies->id : '' }}">
                    <input type="text" class="form-control" value="{{ isset($companies->company_name) ? $companies->company_name : '' }}"
                        name="company_name" id="company_name" readonly required>   
                </div>
                <div class="col-md-6">
                    <input type="hidden" id="assigned_employee_id" name="assigned_employee_id" value="{{ isset($assignedTaskEmployee->id) ? $assignedTaskEmployee->id : '' }}">
                    <label class="required" for="assigned_id">Assigned-Sub-Task</label>
                    <select class="form-control select2 assigned_id {{ $errors->has('assigned_id') ? 'is-invalid' : '' }}"
                        name="assigned_to_id" id="assigned_to_id" required>
                        @foreach ($taxtube_employees as $id => $entry)
                            <option value="{{ $id }}" {{ ($assignedTaskEmployee->assigned_employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                </div>
                @if($assignedTaskEmployee == '')
                    <div class="form-group mt-3 ml-3">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                @else
                    <div class="form-group mt-3 ml-3">
                        <button class="btn btn-danger" type="submit">
                            Update
                        </button>
                    </div>
                @endif
                @endif 
            </div>
        </form>
    </div>
    <div class="card-body" id="multiple-steps" hidden>
        <form method="POST" action="{{ route('admin.sub-tasks.store-subtasks') }}" enctype="multipart/form-data">
            @csrf
            <h3>Assigned-Sub-Tasks(Multiple-Steps)</h3>
            @if($company_id == '0')
                <div class="row form-group">
                    <div class="col-md-6">
                        <label class="required" for="department_id">{{ trans('cruds.subTask.fields.department') }}</label>
                        <input type="hidden" name="department_id" id="department_id" value="{{ isset($task->department_id) ? $task->department_id : '' }}">
                        <input class="form-control {{ $errors->has('department_id') ? 'is-invalid' : '' }}" type="text" name="department_name" id="department_name" value="{{ isset($task->department->name) ? $task->department->name : '' }}" readonly required>
                        @if($errors->has('department'))
                            <span class="text-danger">{{ $errors->first('department') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.subTask.fields.department_helper') }}</span>
                    </div>
                    <div class="col-md-6">
                        <label class="required" for="task_id">{{ trans('cruds.subTask.fields.task') }}</label>
                        <input type="hidden" name="task_id" id="task_id" value="{{ isset($task->id) ? $task->id : '' }}">
                        <input class="form-control {{ $errors->has('task_id') ? 'is-invalid' : '' }}" type="text" name="task_name" id="task_name" value="{{ isset($task->name) ? $task->name : '' }}" readonly required>
                        @if($errors->has('task'))
                            <span class="text-danger">{{ $errors->first('task') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.subTask.fields.task_helper') }}</span>
                    </div>
                    <div class="col-md-12 mt-3">
                        <h3 style="font-weight: 500; color:red">**Please Firstly Select Company In Upper Company Dropdown then Creating Multiple-Steps(Sub-Tasks) and Assigned them**</h3>
                    </div>
                </div>
            @else
                <div class="row form-group">
                    <div class="col-md-4">
                        <label class="required" for="department_id">{{ trans('cruds.subTask.fields.department') }}</label>
                        <input type="hidden" name="department_id" id="department_id" value="{{ isset($task->department_id) ? $task->department_id : '' }}">
                        <input class="form-control {{ $errors->has('department_id') ? 'is-invalid' : '' }}" type="text" name="department_name" id="department_name" value="{{ isset($task->department->name) ? $task->department->name : '' }}" readonly required>
                        @if($errors->has('department'))
                            <span class="text-danger">{{ $errors->first('department') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.subTask.fields.department_helper') }}</span>
                    </div>
                    <div class="col-md-4">
                        <label class="required" for="task_id">{{ trans('cruds.subTask.fields.task') }}</label>
                        <input type="hidden" name="task_id" id="task_id" value="{{ isset($task->id) ? $task->id : '' }}">
                        <input class="form-control {{ $errors->has('task_id') ? 'is-invalid' : '' }}" type="text" name="task_name" id="task_name" value="{{ isset($task->name) ? $task->name : '' }}" readonly required>
                        @if($errors->has('task'))
                            <span class="text-danger">{{ $errors->first('task') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.subTask.fields.task_helper') }}</span>
                    </div>
                    <div class="col-md-4">
                        <label class="required" for="company_id">Company</label>
                        <input type="hidden" id="company_input_id" name="company_id" value="{{ isset($companies->id) ? $companies->id : '' }}">
                        <input type="text" class="form-control" value="{{ isset($companies->company_name) ? $companies->company_name : '' }}"
                            name="company_name" id="company_name" readonly required>   
                    </div>
                    {{-- <div class="col-md-3" style="font-weight: 600;">
                        <input class="form-check-input" type="checkbox" name="set_priority" id="set_priority" value="1" {{ old('set_priority', 1) == 0 ? 'checked' : '' }}>
                        <label class="form-check-label"  for="set_priority">
                            Set Priority on All Steps 
                        </label>
                    </div> --}}
                </div>
                @if($subtasks == 'empty')
                    <div class="form-group subtasks-div">
                        <div class="row form-group">
                            <div class="col-md-4">
                                <input type="hidden" id="sub_task_id" name="sub_task_id[]" value=""> 
                                <label class="required" for="name">{{ trans('cruds.subTask.fields.name') }}</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name[]" id="name" value="" required>
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.subTask.fields.name_helper') }}</span>
                            </div>
                            <div class="col-md-4">
                                <label class="required" for="assigned_id">Assigned Sub-Tasks</label>
                                <select class="form-control select2 assigned_id {{ $errors->has('assigned_id') ? 'is-invalid' : '' }}"
                                    name="assigned_id[]" id="assigned_id" required>
                                    @foreach ($taxtube_employees as $id => $entry)
                                        <option value="{{ $id }}">{{ $entry }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="required">{{ trans('cruds.subTask.fields.frequency') }}</label>
                                <select class="form-control {{ $errors->has('frequency') ? 'is-invalid' : '' }}" name="frequency[]" id="frequency" required>
                                    <option value disabled {{ old('frequency', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                    @foreach(App\Models\SubTask::FREQUENCY_SELECT as $key => $label)
                                        <option value="{{ $key }}">{{ $label }}</option>
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
                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description[]" id="description"></textarea>
                                    @if($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                <span class="help-block">{{ trans('cruds.subTask.fields.description_helper') }}</span>
                            </div>
                            <div class="col-md-2">
                                <label for="due_date">{{ trans('cruds.subTask.fields.due_date') }}</label>
                                <input class="form-control {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="date" name="due_date[]" id="due_date" value="">
                                @if($errors->has('due_date'))
                                    <span class="text-danger">{{ $errors->first('due_date') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.subTask.fields.due_date_helper') }}</span>
                            </div>
                            <div class="col-md-3 priority_dropdown" hidden>
                                <label class="required priority_label">Priority(Set Priority First-to-Last)</label>
                                <select class="form-control priority {{ $errors->has('priority') ? 'is-invalid' : '' }}" name="priority[]" id="priority">
                                    <option value disabled {{ old('frequency', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                    @foreach(App\Models\SubTask::PRIORITY_SELECT as $key => $label)
                                        <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 clone-subtasks-div">
                                <button class="btn btn-success clone-subtasks-btn" type="button">Add+</button>
                            </div>
                        </div>
                    </div>    
                @else
                    @php 
                    $i = 0; 
                    @endphp 
                    @foreach($subtasks as $data)
                    @php
                        $i++;
                    @endphp
                    <div class="form-group subtasks-div">
                    <div class="row form-group">
                        <div class="col-md-4">
                            <input type="hidden" id="sub_task_id" name="sub_task_id[]" value="{{ isset($data->id) ? $data->id : '' }}">
                            <label class="required" for="name">{{ trans('cruds.subTask.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name[]" id="name" value="{{ isset($data->name) ? $data->name : '' }}" required>
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subTask.fields.name_helper') }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="required" for="assigned_id">Assigned Sub-Tasks</label>
                            <select class="form-control select2 assigned_id {{ $errors->has('assigned_id') ? 'is-invalid' : '' }}"
                                name="assigned_id[]" id="assigned_id" required>
                                @foreach ($taxtube_employees as $id => $entry)
                                    <option value="{{ $id }}" {{ ($data->assigned_employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="required">{{ trans('cruds.subTask.fields.frequency') }}</label>
                            <select class="form-control {{ $errors->has('frequency') ? 'is-invalid' : '' }}" name="frequency[]" id="frequency" required>
                                <option value disabled {{ old('frequency', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\SubTask::FREQUENCY_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ ($data->frequency ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
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
                            <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description[]" id="description">{{ isset($data->description) ? $data->description : '' }}</textarea>
                                @if($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            <span class="help-block">{{ trans('cruds.subTask.fields.description_helper') }}</span>
                        </div>
                        <div class="col-md-2">
                            <label for="due_date">{{ trans('cruds.subTask.fields.due_date') }}</label>
                            <input class="form-control {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="date" name="due_date[]" id="due_date" value="{{ isset($data->due_date) ? $data->due_date : '' }}">
                            @if($errors->has('due_date'))
                                <span class="text-danger">{{ $errors->first('due_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.subTask.fields.due_date_helper') }}</span>
                        </div>
                        {{--<div class="col-md-3 priority_dropdown" hidden>
                            @php
                                if($data->priority != null){
                                    $priority_set_or_not = '1';
                                }else{
                                    $priority_set_or_not = '0'; 
                                }
                            @endphp
                            <input type="hidden" class="priority_set_or_not" value="{{$priority_set_or_not}}">
                            <label class="required priority_label">Priority(Set Priority First-to-Last)</label>
                            <select class="form-control priority {{ $errors->has('priority') ? 'is-invalid' : '' }}" name="priority[]" id="priority">
                                <option value disabled {{ old('frequency', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\SubTask::PRIORITY_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ ($data->priority ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>--}}
                        @if($i == $total_created_subtasks)
                        <div class="col-md-2 clone-subtasks-div">
                            <button class="btn btn-success clone-subtasks-btn" type="button">Add+</button>
                        </div>
                        @else
                        <div class="col-md-2 clone-subtasks-div" hidden>
                            <button class="btn btn-success clone-subtasks-btn" type="button">Add+</button>
                        </div>
                        @endif
                    </div>
                    </div>
                    @endforeach
                @endif
                    <div class="form-group mt-3">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(document).on('click','#define-steps',function(){
        if($('#define-steps').is(':checked')){
            $('#multiple-steps').removeAttr('hidden');
            $('#single-step').attr('hidden',true);
        }else{
            $('#multiple-steps').attr('hidden',true);
            $('#single-step').removeAttr('hidden');
        }
    });
</script>
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
{{-- <script>
$(document).on('change', '#set_priority', function(){
    if($('#set_priority').is(':checked')){
        $('.priority_dropdown').removeAttr('hidden');
        $('.priority').attr('required',true);
        $('.priority_label').addClass('required');

    }else{
        $('.priority_dropdown').attr('hidden',true); 
        $('.priority').removeAttr('required');
        $('.priority_label').removeClass('required');
    }
});

var priority_set_or_not = $('.priority_set_or_not').val();
if(priority_set_or_not == '1'){
  document.getElementById('set_priority').checked = true;
  $('.priority_dropdown').removeAttr('hidden');
  $('.priority').attr('required',true);
  $('.priority_label').addClass('required');
}else{
    document.getElementById('set_priority').checked = false;
    $('.priority_dropdown').attr('hidden',true); 
    $('.priority').removeAttr('required');
    $('.priority_label').removeClass('required'); 
}
</script> --}}
@endsection