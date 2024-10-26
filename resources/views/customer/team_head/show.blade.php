@extends('layouts.customer')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.customer.fields.team_head') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('customer.team-head.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.verified') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.user.fields.identity_proof') }}
                        </th>
                        <td>
                            @foreach($user->identity_proof as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr> --}}
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.user.fields.address_proof') }}
                        </th>
                        <td>
                            @foreach($user->address_proof as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr> --}}
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.user.fields.passport_size_photo') }}
                        </th>
                        <td>
                            @if($user->passport_size_photo)
                                <a href="{{ $user->passport_size_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $user->passport_size_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr> --}}
                    {{-- <tr>
                        <th>
                            {{ trans('cruds.user.fields.department') }}
                        </th>
                        <td>
                            @foreach($user->departments as $key => $department)
                                <span class="label label-info">{{ $department->name }}</span>
                            @endforeach
                        </td>
                    </tr> --}}
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('customer.team.index') }}">
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
            <a class="nav-link" href="#assigned_to_assigned_tasks" role="tab" data-toggle="tab">
                {{ trans('cruds.assignedTask.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_assigned_tasks" role="tab" data-toggle="tab">
                {{ trans('cruds.assignedTask.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_addresses" role="tab" data-toggle="tab">
                {{ trans('cruds.userAddress.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="assigned_to_assigned_tasks">
            @includeIf('admin.users.relationships.assignedToAssignedTasks', ['assignedTasks' => $user->assignedToAssignedTasks])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_assigned_tasks">
            @includeIf('admin.users.relationships.userAssignedTasks', ['assignedTasks' => $user->userAssignedTasks])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_addresses">
            @includeIf('admin.users.relationships.userUserAddresses', ['userAddresses' => $user->userUserAddresses])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
        </div>
    </div>
</div>

@endsection