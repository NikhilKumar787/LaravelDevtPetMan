@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.accountName.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.account-names.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.accountName.fields.id') }}
                        </th>
                        <td>
                            {{ $accountName->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accountName.fields.name') }}
                        </th>
                        <td>
                            {{ $accountName->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accountName.fields.account_type') }}
                        </th>
                        <td>
                            {{ $accountName->account_type->type ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.account-names.index') }}">
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
            <a class="nav-link" href="#account_name_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="account_name_products">
            @includeIf('admin.accountNames.relationships.accountNameProducts', ['products' => $accountName->accountNameProducts])
        </div>
    </div>
</div>

@endsection