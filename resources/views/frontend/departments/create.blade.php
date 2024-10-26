@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.department.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.departments.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.department.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.department.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="department_head_id">{{ trans('cruds.department.fields.department_head') }}</label>
                            <select class="form-control select2" name="department_head_id" id="department_head_id" required>
                                @foreach($department_heads as $id => $entry)
                                    <option value="{{ $id }}" {{ old('department_head_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('department_head'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('department_head') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection