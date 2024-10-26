@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.accountName.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.account-names.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.accountName.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.accountName.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="account_type_id">{{ trans('cruds.accountName.fields.account_type') }}</label>
                <select class="form-control select2 {{ $errors->has('account_type') ? 'is-invalid' : '' }}" name="account_type_id" id="account_type_id" required>
                    @foreach($account_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('account_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('account_type'))
                    <span class="text-danger">{{ $errors->first('account_type') }}</span>
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



@endsection
