@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.subTask.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sub-tasks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.subTask.fields.id') }}
                        </th>
                        <td>
                            {{ $subTask->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subTask.fields.department') }}
                        </th>
                        <td>
                            {{ $subTask->department->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subTask.fields.name') }}
                        </th>
                        <td>
                            {{ $subTask->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subTask.fields.description') }}
                        </th>
                        <td>
                            {{ $subTask->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subTask.fields.tag') }}
                        </th>
                        <td>
                            @foreach($subTask->tags as $key => $tag)
                                <span class="label label-info">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subTask.fields.attachment') }}
                        </th>
                        <td>
                            @if($subTask->attachment)
                                <a href="{{ $subTask->attachment->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subTask.fields.frequency') }}
                        </th>
                        <td>
                            {{ App\Models\SubTask::FREQUENCY_SELECT[$subTask->frequency] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subTask.fields.due_date') }}
                        </th>
                        <td>
                            {{ $subTask->due_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subTask.fields.task') }}
                        </th>
                        <td>
                            {{ $subTask->task->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sub-tasks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection