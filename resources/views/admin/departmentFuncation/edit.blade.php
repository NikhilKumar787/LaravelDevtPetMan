@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.department.fields.department_funcation') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.department_funcations.update", [$departmentFuncation->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.department.fields.funcation_name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="funcation_name" id="name" value="{{ old('name', $departmentFuncation->funcation_name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.department.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="department_id">{{ trans('cruds.department.title') }}</label>
                <select class="form-control select2 {{ $errors->has('department_head') ? 'is-invalid' : '' }}" name="department_id" id="department_id" required>
                    @foreach($department_id as $id => $entry)
                        <option value="{{ $id }}" {{ (old('department_id') ? old('department_id') : $departmentFuncation->department->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('department_head'))
                    <span class="text-danger">{{ $errors->first('department_id') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.department.fields.department_head_helper') }}</span>
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