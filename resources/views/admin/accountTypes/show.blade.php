@extends('layouts.admin')
@section('content')

<div class="page-show-wrapper">

    <div class="d-flex justify-content-between mb-2">
        <h5 class="page-heading"> {{ trans('global.show') }} {{ trans('cruds.accountType.title') }}</h5>
        <a class="back-to-list" href="{{ route('admin.account-types.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.accountType.fields.id') }}</h6>
                <p> {{ $accountType->id }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>   {{ trans('cruds.accountType.fields.type') }}</h6>
                <p> {{ App\Models\AccountType::TYPE_SELECT[$accountType->type] ?? '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6> {{ trans('cruds.accountType.fields.account_group') }}</h6>
                <p>{{ App\Models\AccountType::ACCOUNT_GROUP_SELECT[$accountType->account_group] ?? '' }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-show-box">
                <h6>{{ trans('cruds.accountType.fields.name') }}</h6>
                <p> {{ $accountType->name }}</p>
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
            <a class="nav-link" href="#account_type_account_names" role="tab" data-toggle="tab">
                {{ trans('cruds.accountName.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="account_type_account_names">
            @includeIf('admin.accountTypes.relationships.accountTypeAccountNames', ['accountNames' => $accountType->accountTypeAccountNames])
        </div>
    </div>
</div>

@endsection