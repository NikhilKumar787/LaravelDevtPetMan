@extends('layouts.admin')
@section('content')

<div class="page-show-wrapper">

    <div class="d-flex justify-content-between mb-2">
        <h5 class="page-heading">  {{ trans('global.show') }} {{ trans('cruds.userAlert.title') }}</h5>
        <a class="back-to-list" href="{{ route('admin.user-alerts.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>
    
    <div class="row">
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.userAlert.fields.id') }}</h6>
                <p> {{ $userAlert->id }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.userAlert.fields.alert_text') }}</h6>
                <p> {{ $userAlert->alert_text }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.userAlert.fields.alert_link') }}</h6>
                <a class="small text-wrap" href=""> {{ $userAlert->alert_link }}</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.userAlert.fields.user') }}</h6>
                @foreach($userAlert->users as $key => $user)
                <span class="label label-link">{{ $user->name }}</span>
            @endforeach
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.userAlert.fields.created_at') }}</h6>
                <p>{{ $userAlert->created_at }}</p>
            </div>
        </div>
    </div>
</div>



@endsection