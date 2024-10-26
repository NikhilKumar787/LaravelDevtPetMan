@extends('layouts.admin')
@section('content')




    <div class="page-show-wrapper">
        <div class="d-flex justify-content-between mb-2">
            <h5 class="page-heading"> {{ trans('global.show') }} {{ trans('cruds.userAddress.title') }}</h5>
            <a class="back-to-list" href="{{ route('admin.permissions.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


        <div class="row">
            <div class="col-md-3">
                <div class="info-show-box">
                    <h6>{{ trans('cruds.userAddress.fields.id') }}</h6>
                    <p>{{ $userAddress->id }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-show-box">
                    <h6>{{ trans('cruds.userAddress.fields.name') }}</h6>
                    <p>{{ $userAddress->name }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-show-box">
                    <h6>{{ trans('cruds.userAddress.fields.phone_no') }}</h6>
                    <p>{{ $userAddress->phone_no }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-show-box">
                    <h6>{{ trans('cruds.userAddress.fields.addressline_1') }}</h6>
                    <p>{{ $userAddress->addressline_1 }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-show-box">
                    <h6>{{ trans('cruds.userAddress.fields.addressline_2') }}</h6>
                    <p>{{ $userAddress->addressline_2 }}}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-show-box">
                    <h6>{{ trans('cruds.userAddress.fields.city') }}</h6>
                    <p> {{ $userAddress->city }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-show-box">
                    <h6> {{ trans('cruds.userAddress.fields.zip_code') }}</h6>
                    <p>  {{ $userAddress->zip_code }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-show-box">
                    <h6>  {{ trans('cruds.userAddress.fields.state') }}</h6>
                    <p>{{ $userAddress->state }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-show-box">
                    <h6>{{ trans('cruds.userAddress.fields.customer') }}</h6>
                    <p> {{ $userAddress->customer->first_name ?? '' }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-show-box">
                    <h6> {{ trans('cruds.userAddress.fields.user') }}</h6>
                    <p> {{ $userAddress->user->name ?? '' }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-show-box">
                    <h6>{{ trans('cruds.userAddress.fields.uuid') }}</h6>
                    <p> {{ $userAddress->uuid }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-show-box">
                    <h6>{{ trans('cruds.userAddress.fields.type') }}</h6>
                    <p>{{ App\Models\UserAddress::TYPE_SELECT[$userAddress->type] ?? '' }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-show-box">
                    <h6>  {{ trans('cruds.userAddress.fields.same_as') }}</h6>
                    <p> <input type="checkbox" disabled="disabled" {{ $userAddress->same_as ? 'checked' : '' }}></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-show-box">
                    <h6>    {{ trans('cruds.userAddress.fields.default_address') }}</h6>
                    <p> <input type="checkbox" disabled="disabled" {{ $userAddress->default_address ? 'checked' : '' }}></p>
                </div>
            </div>
        </div>



  
</div>



@endsection