@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.accountName.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.account-names.update", [$accountName->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.accountName.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $accountName->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.accountName.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="account_type_id">{{ trans('cruds.accountName.fields.account_type') }}</label>
                            <select class="form-control select2" name="account_type_id" id="account_type_id" required>
                                @foreach($account_types as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('account_type_id') ? old('account_type_id') : $accountName->account_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('account_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('account_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.accountName.fields.account_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection