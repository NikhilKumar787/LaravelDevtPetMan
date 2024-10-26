@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.gst.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.gst.update", $gst->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="gst">{{ trans('cruds.gst.fields.gst') }}</label>
                <input class="form-control {{ $errors->has('gst') ? 'is-invalid' : '' }}" type="text" name="gst" id="gst" value="{{ old('gst', $gst->gst) }}" required>
                @if($errors->has('gst'))
                    <span class="text-danger">{{ $errors->first('gst') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.gst.fields.gst_helper') }}</span>
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