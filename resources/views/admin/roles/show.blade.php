@extends('layouts.admin')
@section('content')

<div class="page-show-wrapper">
    <div class="d-flex justify-content-between mb-2">
        <h5 class="page-heading"> {{ trans('global.show') }} {{ trans('cruds.role.title') }}</h5>
        <a class="back-to-list" href="{{ route('admin.roles.index') }}}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>  {{ trans('cruds.role.fields.id') }}</h6>
                <p>  {{ $role->id }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.role.fields.title') }}</h6>
                <p>{{ $permission->title }}</p>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.id') }}
                        </th>
                        <td>
                            {{ $role->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.title') }}
                        </th>
                        <td>
                           
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.permissions') }}
                        </th>
                        <td>
                            @foreach($role->permissions as $key => $permissions)
                                <span class="label label-info">{{ $permissions->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.roles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection