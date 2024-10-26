<div class="m-3">
    @can('assigned_task_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.assigned-tasks.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.assignedTask.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.assignedTask.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-assignedToAssignedTasks">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.assignedTask.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedTask.fields.task') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedTask.fields.assigned_to') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedTask.fields.company') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedTask.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedTask.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedTask.fields.hours_estimation') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedTask.fields.requirement') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedTask.fields.proof_of_work') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedTask.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedTask.fields.is_approved') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedTask.fields.target_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.assignedTask.fields.completed_date') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignedTasks as $key => $assignedTask)
                            <tr data-entry-id="{{ $assignedTask->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $assignedTask->id ?? '' }}
                                </td>
                                <td>
                                    {{ $assignedTask->task->name ?? '' }}
                                </td>
                                <td>
                                    {{ $assignedTask->assigned_to->name ?? '' }}
                                </td>
                                <td>
                                    {{ $assignedTask->company->username_for_pan_tan ?? '' }}
                                </td>
                                <td>
                                    {{ $assignedTask->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $assignedTask->description ?? '' }}
                                </td>
                                <td>
                                    {{ $assignedTask->hours_estimation ?? '' }}
                                </td>
                                <td>
                                    @foreach($assignedTask->requirement as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($assignedTask->proof_of_work as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $assignedTask->status->name ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $assignedTask->is_approved ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $assignedTask->is_approved ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $assignedTask->target_date ?? '' }}
                                </td>
                                <td>
                                    {{ $assignedTask->completed_date ?? '' }}
                                </td>
                                <td>
                                    @can('assigned_task_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.assigned-tasks.show', $assignedTask->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('assigned_task_edit')
                                        <a class="btn btn-link text-theme" href="{{ route('admin.assigned-tasks.edit', $assignedTask->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('assigned_task_delete')
                                        <form action="{{ route('admin.assigned-tasks.destroy', $assignedTask->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('assigned_task_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.assigned-tasks.massDestroy') }}",
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
  let table = $('.datatable-assignedToAssignedTasks:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection