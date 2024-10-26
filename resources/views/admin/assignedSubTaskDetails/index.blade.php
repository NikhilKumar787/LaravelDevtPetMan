@extends('layouts.admin')
@section('content')
@can('assigned_task_detail_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.assigned-sub-task-details.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.assignedSubTaskDetail.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.assignedSubTaskDetail.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AssignedSubTaskDetail">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.assignedSubTaskDetail.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedSubTaskDetail.fields.sub_task') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedSubTaskDetail.fields.assigned_sub_task_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedSubTaskDetail.fields.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedSubTaskDetail.fields.start_time') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedSubTaskDetail.fields.end_time') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedSubTaskDetail.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedSubTaskDetail.fields.is_approved') }}
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
@can('assigned_sub_task_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.assigned-sub-task-details.massDestroy') }}",
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
    ajax: "{{ route('admin.assigned-sub-task-details.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'sub_task_name', name: 'sub_task.name' },
{ data: 'assigned_sub_task_description', name: 'assigned_sub_task.description' },
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
  let table = $('.datatable-AssignedSubTaskDetail').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection