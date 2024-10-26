@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.department.fields.department_head') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.department-head.index',['company' => $departmentHead->company_id]) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.department.fields.id') }}
                        </th>
                        <td>
                            {{ $departmentHead->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.department.title') }}
                        </th>
                        <td>
                            {{ $departmentHead->department_name->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.department.fields.department_head') }}
                        </th>
                        <td>
                            {{ $departmentHead->department_head->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.department-head.index',['company' => $departmentHead->company_id]) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#department_tasks" role="tab" data-toggle="tab">
                {{ trans('cruds.task.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="department_tasks">
            {{-- @includeIf('admin.departments.relationships.departmentTasks', ['tasks' => $department->departmentTasks]) --}}
        </div>
    </div>
</div>

@endsection