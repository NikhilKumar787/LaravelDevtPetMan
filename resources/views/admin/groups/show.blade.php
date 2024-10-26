@extends('layouts.admin')
@section('content')




    <div class="page-show-wrapper">
        <div class="d-flex justify-content-between mb-2">
            <h5 class="page-heading"> {{ trans('global.show') }} {{ trans('cruds.group.title') }}</h5>
            <a class="back-to-list" href="{{ route('admin.groups.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="info-show-box">
                    <h6> {{ trans('cruds.group.fields.id') }}</h6>
                    <p> {{ $group->id }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-show-box">
                    <h6> {{ trans('cruds.group.fields.name') }}</h6>
                    <p>{{ $group->name }}</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="info-show-box">
                    <h6>   {{ trans('cruds.group.fields.customers') }}</h6>
                    @foreach($group->customers as $key => $customers)
                    <span class="label label-link font-weight-bold">{{ $customers->first_name }},</span>
                     @endforeach
                </div>
            </div>
        </div>

</div>



@endsection