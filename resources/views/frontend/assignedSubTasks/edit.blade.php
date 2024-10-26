@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.assignedSubTask.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.assigned-sub-tasks.update", [$assignedSubTask->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="task_id">{{ trans('cruds.assignedSubTask.fields.task') }}</label>
                            <select class="form-control select2" name="task_id" id="task_id" required>
                                @foreach($tasks as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('task_id') ? old('task_id') : $assignedSubTask->task->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('task'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('task') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedSubTask.fields.task_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="assigned_to_id">{{ trans('cruds.assignedSubTask.fields.assigned_to') }}</label>
                            <select class="form-control select2" name="assigned_to_id" id="assigned_to_id" required>
                                @foreach($assigned_tos as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('assigned_to_id') ? old('assigned_to_id') : $assignedSubTask->assigned_to->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('assigned_to'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('assigned_to') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedSubTask.fields.assigned_to_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="company_id">{{ trans('cruds.assignedSubTask.fields.company') }}</label>
                            <select class="form-control select2" name="company_id" id="company_id" required>
                                @foreach($companies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('company_id') ? old('company_id') : $assignedSubTask->company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('company'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedSubTask.fields.company_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.assignedSubTask.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $assignedSubTask->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedSubTask.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.assignedSubTask.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description', $assignedSubTask->description) }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedSubTask.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="hours_estimation">{{ trans('cruds.assignedSubTask.fields.hours_estimation') }}</label>
                            <input class="form-control" type="number" name="hours_estimation" id="hours_estimation" value="{{ old('hours_estimation', $assignedSubTask->hours_estimation) }}" step="1">
                            @if($errors->has('hours_estimation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hours_estimation') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedSubTask.fields.hours_estimation_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="requirement">{{ trans('cruds.assignedSubTask.fields.requirement') }}</label>
                            <div class="needsclick dropzone" id="requirement-dropzone">
                            </div>
                            @if($errors->has('requirement'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('requirement') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedSubTask.fields.requirement_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="proof_of_work">{{ trans('cruds.assignedSubTask.fields.proof_of_work') }}</label>
                            <div class="needsclick dropzone" id="proof_of_work-dropzone">
                            </div>
                            @if($errors->has('proof_of_work'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('proof_of_work') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedSubTask.fields.proof_of_work_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status_id">{{ trans('cruds.assignedSubTask.fields.status') }}</label>
                            <select class="form-control select2" name="status_id" id="status_id">
                                @foreach($statuses as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $assignedSubTask->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedSubTask.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_approved" value="0">
                                <input type="checkbox" name="is_approved" id="is_approved" value="1" {{ $assignedSubTask->is_approved || old('is_approved', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_approved">{{ trans('cruds.assignedSubTask.fields.is_approved') }}</label>
                            </div>
                            @if($errors->has('is_approved'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_approved') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedSubTask.fields.is_approved_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="target_date">{{ trans('cruds.assignedSubTask.fields.target_date') }}</label>
                            <input class="form-control date" type="text" name="target_date" id="target_date" value="{{ old('target_date', $assignedSubTask->target_date) }}">
                            @if($errors->has('target_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('target_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedSubTask.fields.target_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="completed_date">{{ trans('cruds.assignedSubTask.fields.completed_date') }}</label>
                            <input class="form-control date" type="text" name="completed_date" id="completed_date" value="{{ old('completed_date', $assignedSubTask->completed_date) }}">
                            @if($errors->has('completed_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('completed_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedSubTask.fields.completed_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="assigned_task_id">{{ trans('cruds.assignedSubTask.fields.assigned_task') }}</label>
                            <select class="form-control select2" name="assigned_task_id" id="assigned_task_id" required>
                                @foreach($assigned_tasks as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('assigned_task_id') ? old('assigned_task_id') : $assignedSubTask->assigned_task->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('assigned_task'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('assigned_task') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assignedSubTask.fields.assigned_task_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedRequirementMap = {}
Dropzone.options.requirementDropzone = {
    url: '{{ route('frontend.assigned-sub-tasks.storeMedia') }}',
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
@if(isset($assignedSubTask) && $assignedSubTask->requirement)
          var files =
            {!! json_encode($assignedSubTask->requirement) !!}
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
    url: '{{ route('frontend.assigned-sub-tasks.storeMedia') }}',
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
@if(isset($assignedSubTask) && $assignedSubTask->proof_of_work)
          var files =
            {!! json_encode($assignedSubTask->proof_of_work) !!}
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
</script>
@endsection