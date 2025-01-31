@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('assigned_task_detail_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.assigned-task-details.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.assignedTaskDetail.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.assignedTaskDetail.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-AssignedTaskDetail">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assignedTaskDetail.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assignedTaskDetail.fields.task') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assignedTaskDetail.fields.assigned_task') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assignedTaskDetail.fields.date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assignedTaskDetail.fields.start_time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assignedTaskDetail.fields.end_time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assignedTaskDetail.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assignedTaskDetail.fields.is_approved') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assignedTaskDetails as $key => $assignedTaskDetail)
                                    <tr data-entry-id="{{ $assignedTaskDetail->id }}">
                                        <td>
                                            {{ $assignedTaskDetail->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assignedTaskDetail->task->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assignedTaskDetail->assigned_task->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assignedTaskDetail->date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assignedTaskDetail->start_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assignedTaskDetail->end_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assignedTaskDetail->status->name ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $assignedTaskDetail->is_approved ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $assignedTaskDetail->is_approved ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('assigned_task_detail_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.assigned-task-details.show', $assignedTaskDetail->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('assigned_task_detail_edit')
                                                <a class="btn btn-link text-theme" href="{{ route('frontend.assigned-task-details.edit', $assignedTaskDetail->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('assigned_task_detail_delete')
                                                <form action="{{ route('frontend.assigned-task-details.destroy', $assignedTaskDetail->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('assigned_task_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.assigned-task-details.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-AssignedTaskDetail:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection