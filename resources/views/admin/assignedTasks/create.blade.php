@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.assignedTask.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.assigned-tasks.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="task_id">{{ trans('cruds.assignedTask.fields.task') }}</label>
                <select class="form-control select2 {{ $errors->has('task') ? 'is-invalid' : '' }}" name="task_id" id="task_id" required>
                    @foreach($tasks as $id => $entry)
                        <option value="{{ $id }}" {{ old('task_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('task'))
                    <span class="text-danger">{{ $errors->first('task') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedTask.fields.task_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="department_id">{{ trans('cruds.task.fields.department') }}</label>
                <select class="form-control select2 {{ $errors->has('department') ? 'is-invalid' : '' }}" name="department_id" id="department_id" required>
                    @foreach($departments as $id => $entry)
                        <option value="{{ $id }}" {{ old('department_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('department'))
                    <span class="text-danger">{{ $errors->first('department') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.task.fields.department_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="assigned_to_id">{{ trans('cruds.assignedTask.fields.assigned_to') }}</label>
                <select class="form-control select2 {{ $errors->has('assigned_to') ? 'is-invalid' : '' }}" name="assigned_to_id" id="assigned_to_id" required>
                    @foreach($assigned_tos as $id => $entry)
                        <option value="{{ $id }}" {{ old('assigned_to_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('assigned_to'))
                    <span class="text-danger">{{ $errors->first('assigned_to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedTask.fields.assigned_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="company_id">{{ trans('cruds.assignedTask.fields.company') }}</label>
                <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id" id="company_id" required>
                    @foreach($companies as $id => $entry)
                        <option value="{{ $id }}" {{ old('company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('company'))
                    <span class="text-danger">{{ $errors->first('company') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedTask.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.assignedTask.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedTask.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.assignedTask.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedTask.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hours_estimation">{{ trans('cruds.assignedTask.fields.hours_estimation') }}</label>
                <input class="form-control {{ $errors->has('hours_estimation') ? 'is-invalid' : '' }}" type="number" name="hours_estimation" id="hours_estimation" value="{{ old('hours_estimation', '') }}" step="1">
                @if($errors->has('hours_estimation'))
                    <span class="text-danger">{{ $errors->first('hours_estimation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedTask.fields.hours_estimation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="requirement">{{ trans('cruds.assignedTask.fields.requirement') }}</label>
                <div class="needsclick dropzone {{ $errors->has('requirement') ? 'is-invalid' : '' }}" id="requirement-dropzone">
                </div>
                @if($errors->has('requirement'))
                    <span class="text-danger">{{ $errors->first('requirement') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedTask.fields.requirement_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="proof_of_work">{{ trans('cruds.assignedTask.fields.proof_of_work') }}</label>
                <div class="needsclick dropzone {{ $errors->has('proof_of_work') ? 'is-invalid' : '' }}" id="proof_of_work-dropzone">
                </div>
                @if($errors->has('proof_of_work'))
                    <span class="text-danger">{{ $errors->first('proof_of_work') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedTask.fields.proof_of_work_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.assignedTask.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedTask.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_approved') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_approved" value="0">
                    <input class="form-check-input" type="checkbox" name="is_approved" id="is_approved" value="1" {{ old('is_approved', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_approved">{{ trans('cruds.assignedTask.fields.is_approved') }}</label>
                </div>
                @if($errors->has('is_approved'))
                    <span class="text-danger">{{ $errors->first('is_approved') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedTask.fields.is_approved_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="target_date">{{ trans('cruds.assignedTask.fields.target_date') }}</label>
                <input class="form-control date {{ $errors->has('target_date') ? 'is-invalid' : '' }}" type="text" name="target_date" id="target_date" value="{{ old('target_date') }}">
                @if($errors->has('target_date'))
                    <span class="text-danger">{{ $errors->first('target_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedTask.fields.target_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="completed_date">{{ trans('cruds.assignedTask.fields.completed_date') }}</label>
                <input class="form-control date {{ $errors->has('completed_date') ? 'is-invalid' : '' }}" type="text" name="completed_date" id="completed_date" value="{{ old('completed_date') }}">
                @if($errors->has('completed_date'))
                    <span class="text-danger">{{ $errors->first('completed_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assignedTask.fields.completed_date_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedRequirementMap = {}
Dropzone.options.requirementDropzone = {
    url: '{{ route('admin.assigned-tasks.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="requirement[]" value="' + response.name + '">')
      uploadedRequirementMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedRequirementMap[file.name]
      }
      $('form').find('input[name="requirement[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($assignedTask) && $assignedTask->requirement)
          var files =
            {!! json_encode($assignedTask->requirement) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="requirement[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    var uploadedProofOfWorkMap = {}
Dropzone.options.proofOfWorkDropzone = {
    url: '{{ route('admin.assigned-tasks.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="proof_of_work[]" value="' + response.name + '">')
      uploadedProofOfWorkMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedProofOfWorkMap[file.name]
      }
      $('form').find('input[name="proof_of_work[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($assignedTask) && $assignedTask->proof_of_work)
          var files =
            {!! json_encode($assignedTask->proof_of_work) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="proof_of_work[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

$(document).on('change','#department_id',function(){
    $.ajax({
        url: "{{ route('admin.assigned-tasks.agents')}}",
        type: "get",
        data: {
            'department_id':$('#department_id').val(),
            '_token':$('input[name="_token"]').val()
        },
        success: function(data) {
        $("#assigned_to_id").html('').select2({data: data});
        },
        error: function(error) {
            console.log(error, 'err');
            alert("Error occured");
        }
    })
})

$(document).on('change','#company_id',function(){
    $.ajax({
        url: "{{ route('admin.assigned-tasks.users')}}",
        type: "get",
        data: {
            'company_id':$('#company_id').val(),
            '_token':$('input[name="_token"]').val()
        },
        success: function(data) {
        $("#user_id").html('').select2({data: data});
        },
        error: function(error) {
            console.log(error, 'err');
            alert("Error occured");
        }
    })
})
</script>
@endsection