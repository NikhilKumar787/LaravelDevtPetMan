@extends('layouts.admin')
@section('content')
@can('assigned_task_detail_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.assigned-task-details.create') }}">
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AssignedTaskDetail">
            <thead>
                <tr>
                    <th width="10">

                    </th>
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
                        Company Name
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.actions') }}
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('assigned_task_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.assigned-task-details.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.assigned-task-details.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'task_name', name: 'task.name' },
{ data: 'assigned_task_description', name: 'assigned_task.description' },
{ data: 'date', name: 'date' },
{ data: 'start_time', name: 'start_time' },
{ data: 'end_time', name: 'end_time' },
{ data: 'status_name', name: 'status.name' },
{ data: 'is_approved', name: 'is_approved' },
{ data: 'company_name', name: 'company_name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-AssignedTaskDetail').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection