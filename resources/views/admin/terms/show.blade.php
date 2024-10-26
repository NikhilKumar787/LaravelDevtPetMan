@extends('layouts.admin')
@section('content')

<div class="page-show-wrapper">
    <div class="d-flex justify-content-between mb-2">
        <h5 class="page-heading"> {{ trans('global.show') }} {{ trans('cruds.term.title') }}</h5>
        <a class="back-to-list" href="{{ route('admin.terms.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.term.fields.id') }}</h6>
                <p>{{ $term->id }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.term.fields.name') }}</h6>
                <p>  {{ $term->name }}</p>
            </div>
        </div>
    </div>
</div>



@endsection