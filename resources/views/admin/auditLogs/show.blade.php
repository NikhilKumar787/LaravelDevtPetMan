@extends('layouts.admin')
@section('content')

<div class="page-show-wrapper">
    <div class="d-flex justify-content-between mb-2">
        <h5 class="page-heading">{{ trans('global.show') }} {{ trans('cruds.auditLog.title') }}</h5>
        <a class="back-to-list" href="{{ route('admin.permissions.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <div class="row">
       
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.auditLog.fields.id') }}</h6>
                <p> {{ $auditLog->id }}</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.auditLog.fields.description') }}</h6>
                <p>{{ $auditLog->description }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.auditLog.fields.subject_id') }}</h6>
                <p>{{ $auditLog->subject_id }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.auditLog.fields.subject_type') }}</h6>
                <p>{{ $auditLog->subject_type }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.auditLog.fields.user_id') }}</h6>
                <p>{{ $auditLog->user_id }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.auditLog.fields.properties') }}</h6>
                <p style="word-wrap: break-word;">{{ $auditLog->properties }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.auditLog.fields.host') }}</h6>
                <p> {{ $auditLog->host }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.auditLog.fields.created_at') }}</h6>
                <p> {{ $auditLog->created_at }}</p>
            </div>
        </div>
    </div>
</div>
@endsection