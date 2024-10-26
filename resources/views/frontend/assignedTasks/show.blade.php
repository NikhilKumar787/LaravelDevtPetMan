@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.assignedTask.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.assigned-tasks.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assignedTask.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $assignedTask->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assignedTask.fields.task') }}
                                    </th>
                                    <td>
                                        {{ $assignedTask->task->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assignedTask.fields.assigned_to') }}
                                    </th>
                                    <td>
                                        {{ $assignedTask->assigned_to->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assignedTask.fields.company') }}
                                    </th>
                                    <td>
                                        {{ $assignedTask->company->username_for_pan_tan ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assignedTask.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $assignedTask->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assignedTask.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $assignedTask->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assignedTask.fields.hours_estimation') }}
                                    </th>
                                    <td>
                                        {{ $assignedTask->hours_estimation }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assignedTask.fields.requirement') }}
                                    </th>
                                    <td>
                                        @foreach($assignedTask->requirement as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assignedTask.fields.proof_of_work') }}
                                    </th>
                                    <td>
                                        @foreach($assignedTask->proof_of_work as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assignedTask.fields.status') }}
                                    </th>
                                    <td>
                                        {{ $assignedTask->status->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assignedTask.fields.is_approved') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $assignedTask->is_approved ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.assigned-tasks.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection