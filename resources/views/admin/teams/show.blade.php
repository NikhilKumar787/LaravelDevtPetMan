@extends('layouts.admin')
@section('content')

<div class="page-show-wrapper">

    <div class="d-flex justify-content-between mb-2">
        <h5 class="page-heading">  {{ trans('global.show') }} {{ trans('cruds.team.title') }}</h5>
        <a class="back-to-list" href="{{ route('admin.teams.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>
<div class="row">

    <div class="col-md-3">
        <div class="info-show-box">
            <h6>{{ trans('cruds.team.fields.id') }}</h6>
            <p>{{ $team->id }}</p>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="info-show-box">
            <h6> {{ trans('cruds.team.fields.name') }}</h6>
            <p>  {{ $team->name }}</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="info-show-box">
            <h6> {{ trans('cruds.team.fields.owner') }}</h6>
            <p>{{ $team->owner->name ?? '' }}</p>
        </div>
    </div>

</div>



</div>



@endsection