@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.termsAndcondition.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.terms-andconditions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.termsAndcondition.fields.id') }}
                        </th>
                        <td>
                            {{ $termsAndcondition->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.termsAndcondition.fields.name') }}
                        </th>
                        <td>
                            {{ $termsAndcondition->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.termsAndcondition.fields.body') }}
                        </th>
                        <td>
                            {!! $termsAndcondition->body !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.terms-andconditions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection