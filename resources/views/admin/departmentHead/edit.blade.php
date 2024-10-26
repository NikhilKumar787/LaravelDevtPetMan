@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.department.fields.department_head') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.department-head.update",[$departmentHead->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="row company-department-div mt-3 align-items-end bg-light p-2">
                   <div class="col-md-5">
                        <label for="">Department</label>
                        <input class="form-control" type="text" name="company_department" id="company_department" value="{{$departmentHead->department_name->name}}"readonly>
                        {{-- <select class="form-control select2 company_department {{ $errors->has('company_department') ? 'is-invalid' : '' }}"
                            name="company_department[]" id="company_department">
                            @foreach ($departmentTypes as $id => $entry)
                                <option value="{{ $id }}" {{ (old('company_department') ? old('company_department') : $departmentHead->department_name->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach

                        </select> --}}
                    </div>
                    <div class="col-md-5">
                        <label for="">Department head</label>
                        <select class="form-control select2 head_id {{ $errors->has('head_id') ? 'is-invalid' : '' }}"
                            name="head_id" id="head_id">
                            @foreach ($departmenthead as $id => $entry)
                                <option value="{{ $id }}" {{ (old('head_id') ? old('head_id') : $departmentHead->department_head->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach

                        </select>
                    </div>
                    {{-- <div class="col-md-2 clone-department-div">
                        <button class="btn btn-success clone-department-btn" type="button">Add+</button>
                    </div> --}}

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
