@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.department.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.departments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.department.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.department.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="department_head_id">{{ trans('cruds.department.fields.department_head') }}</label>
                <select class="form-control select2 {{ $errors->has('department_head') ? 'is-invalid' : '' }}" name="department_head_id" id="department_head_id" required>
                    @foreach($department_heads as $id => $entry)
                        <option value="{{ $id }}" {{ old('department_head_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('department_head'))
                    <span class="text-danger">{{ $errors->first('department_head') }}</span>
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