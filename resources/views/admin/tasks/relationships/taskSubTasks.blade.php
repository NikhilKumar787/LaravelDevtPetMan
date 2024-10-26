<div class="m-3">
    @can('sub_task_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.sub-tasks.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.subTask.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.subTask.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-taskSubTasks">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.subTask.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.subTask.fields.department') }}
                            </th>
                            <th>
                                {{ trans('cruds.subTask.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.subTask.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.subTask.fields.tag') }}
                            </th>
                            <th>
                                {{ trans('cruds.subTask.fields.attachment') }}
                            </th>
                            <th>
                                {{ trans('cruds.subTask.fields.frequency') }}
                            </th>
                            <th>
                                {{ trans('cruds.subTask.fields.due_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.subTask.fields.task') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subTasks as $key => $subTask)
                            <tr data-entry-id="{{ $subTask->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $subTask->id ?? '' }}
                                </td>
                                <td>
                                    {{ $subTask->department->name ?? '' }}
                                </td>
                                <td>
                                    {{ $subTask->name ?? '' }}
                                </td>
                                <td>
                                    {{ $subTask->description ?? '' }}
                                </td>
                                <td>
                                    @foreach($subTask->tags as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @if($subTask->attachment)
                                        <a href="{{ $subTask->attachment->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ App\Models\SubTask::FREQUENCY_SELECT[$subTask->frequency] ?? '' }}
                                </td>
                                <td>
                                    {{ $subTask->due_date ?? '' }}
                                </td>
                                <td>
                                    {{ $subTask->task->name ?? '' }}
                                </td>
                                <td>
                                    @can('sub_task_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.sub-tasks.show', $subTask->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('sub_task_edit')
                                        <a class="btn btn-link text-theme" href="{{ route('admin.sub-tasks.edit', $subTask->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('sub_task_delete')
                                        <form action="{{ route('admin.sub-tasks.destroy', $subTask->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('sub_task_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.sub-tasks.massDestroy') }}",
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
  let table = $('.datatable-taskSubTasks:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection