<div class="m-3">
    @can('assigned_sub_task_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.assigned-sub-tasks.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.assignedSubTask.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.assignedSubTask.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-assignedTaskAssignedSubTasks">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.assignedSubTask.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedSubTask.fields.task') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedSubTask.fields.assigned_to') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedSubTask.fields.company') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedSubTask.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedSubTask.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedSubTask.fields.hours_estimation') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedSubTask.fields.requirement') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedSubTask.fields.proof_of_work') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedSubTask.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedSubTask.fields.is_approved') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedSubTask.fields.target_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedSubTask.fields.completed_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedSubTask.fields.assigned_task') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignedSubTasks as $key => $assignedSubTask)
                            <tr data-entry-id="{{ $assignedSubTask->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $assignedSubTask->id ?? '' }}
                                </td>
                                <td>
                                    {{ $assignedSubTask->task->name ?? '' }}
                                </td>
                                <td>
                                    {{ $assignedSubTask->assigned_to->name ?? '' }}
                                </td>
                                <td>
                                    {{ $assignedSubTask->company->username_for_pan_tan ?? '' }}
                                </td>
                                <td>
                                    {{ $assignedSubTask->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $assignedSubTask->description ?? '' }}
                                </td>
                                <td>
                                    {{ $assignedSubTask->hours_estimation ?? '' }}
                                </td>
                                <td>
                                    @foreach($assignedSubTask->requirement as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($assignedSubTask->proof_of_work as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $assignedSubTask->status->name ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $assignedSubTask->is_approved ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $assignedSubTask->is_approved ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $assignedSubTask->target_date ?? '' }}
                                </td>
                                <td>
                                    {{ $assignedSubTask->completed_date ?? '' }}
                                </td>
                                <td>
                                    {{ $assignedSubTask->assigned_task->description ?? '' }}
                                </td>
                                <td>
                                    @can('assigned_sub_task_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.assigned-sub-tasks.show', $assignedSubTask->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('assigned_sub_task_edit')
                                        <a class="btn btn-xs btn-warning" href="{{ route('admin.assigned-sub-tasks.edit', $assignedSubTask->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('assigned_sub_task_delete')
                                        <form action="{{ route('admin.assigned-sub-tasks.destroy', $assignedSubTask->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('assigned_sub_task_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.assigned-sub-tasks.massDestroy') }}",
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
  let table = $('.datatable-assignedTaskAssignedSubTasks:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection