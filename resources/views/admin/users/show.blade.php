@extends('layouts.admin')
@section('content')

<div class="page-show-wrapper">
    <div class="d-flex justify-content-between mb-2">
        <h5 class="page-heading">   {{ trans('global.show') }} {{ trans('cruds.user.title') }}</h5>
        <a class="back-to-list" href="{{ route('admin.roles.index') }}}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>  {{ trans('cruds.user.fields.id') }}</h6>
                <p>   {{ $user->id }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.user.fields.name') }}</h6>
                <p>{{ $user->name }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.user.fields.email') }}</h6>
                <p>{{ $user->email }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.user.fields.email_verified_at') }}</h6>
                <p> {{ $user->email_verified_at }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.user.fields.approved') }}</h6>
                <p> <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.role.fields.title') }}</h6>
                {{-- <p>{{ $permission->title }}</p> --}}
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.user.fields.verified') }}</h6>
                <p> <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.user.fields.roles') }}</h6>
                
                    @foreach($user->roles as $key => $roles)
                        <span class="label label-info">{{ $roles->title }}</span>
                    @endforeach
                
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.user.fields.identity_proof') }}</h6>
                @foreach($user->identity_proof as $key => $media)
                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                        <img src="{{ $media->getUrl('thumb') }}">
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.user.fields.address_proof') }}</h6>
            
                    @foreach($user->address_proof as $key => $media)
                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                        <img src="{{ $media->getUrl('thumb') }}">
                    </a>
                @endforeach
                
            </div>                       
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.user.fields.passport_size_photo') }}</h6>
                
                    @if($user->passport_size_photo)
                    <a href="{{ $user->passport_size_photo->getUrl() }}" target="_blank" style="display: inline-block">
                        <img src="{{ $user->passport_size_photo->getUrl('thumb') }}">
                    </a>
                @endif
                
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.user.fields.department') }}</h6>
                @foreach($user->departments as $key => $department)
                    <span class="label label-info">{{ $department->name }}</span>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="page-show-wrapper">
    <div class="d-flex justify-content-between mb-2">
        <h5 class="page-heading">{{ trans('global.relatedData') }}</h5>
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