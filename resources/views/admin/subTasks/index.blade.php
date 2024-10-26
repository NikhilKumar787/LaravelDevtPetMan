@extends('layouts.admin')
@section('content')
@can('sub_task_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.sub-tasks.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.subTask.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'SubTask', 'route' => 'admin.sub-tasks.parseCsvImport'])
        </div>
    </div>    
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.subTask.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-SubTask">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.subTask.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.subTask.fields.company') }}
                    </th>
                    <th>
                        {{ trans('cruds.subTask.fields.department') }}
                    </th>
                    <th>
                        {{ trans('cruds.subTask.fields.task') }}
                    </th>
                    <th>
                        {{ trans('cruds.subTask.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.subTask.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.subTask.fields.assigned_employee') }}
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
    url = "{{ route('admin.sub-tasks.index') }}"
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('sub_task_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.sub-tasks.massDestroy') }}",
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
    ajax: url,
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'company_name', name: 'company_name' },
{ data: 'task_name', name: 'task.name' },
{ data: 'department_name', name: 'department.name' },
{ data: 'name', name: 'name' },
{ data: 'description', name: 'description' },
{ data: 'assigned_to', name: 'assigned_to' },
{ data: 'attachment', name: 'attachment', sortable: false, searchable: false },
{ data: 'frequency', name: 'frequency' },
{ data: 'due_date', name: 'due_date' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-SubTask').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection