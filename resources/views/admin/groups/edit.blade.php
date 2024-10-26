@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.group.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.groups.update", [$group->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.group.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $group->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customers">{{ trans('cruds.group.fields.customers') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('customers') ? 'is-invalid' : '' }}" name="customers[]" id="customers" multiple>
                    @foreach($customers as $id => $customer)
                        <option value="{{ $id }}" {{ (in_array($id, old('customers', [])) || $group->customers->contains($id)) ? 'selected' : '' }}>{{ $customer }}</option>
                    @endforeach
                </select>
                @if($errors->has('customers'))
                    <span class="text-danger">{{ $errors->first('customers') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.group.fields.customers_helper') }}</span>
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