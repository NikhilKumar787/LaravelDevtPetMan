@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.gst.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gst.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="info-show-box">
                        <h6>
                            {{ trans('cruds.gst.fields.id') }}
                        </h6>
                        <p>
                            {{ isset($gst->id) ? $gst->id : '' }}
                        </p>
                    </div>
                </div>
                 <div class="col-md-3">
                    <div class="info-show-box">
                        <h6>
                            {{ trans('cruds.gst.fields.gst') }}
                        </h6>
                        <p>
                            {{ isset($gst->gst) ? $gst->gst : '' }} %
                        </p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gst.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

{{-- <div class="card">
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
</div> --}}

@endsection