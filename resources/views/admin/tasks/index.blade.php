@extends('layouts.admin')
@section('content')
@can('task_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tasks.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.task.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Task', 'route' => 'admin.tasks.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.task.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Task">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.task.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.department') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.tag') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.attachment') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.frequency') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.due_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.actions') }}
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>

 <!-- Modal -->
 <div class="modal fade" id="assignedEmployeeModel" tabindex="-1" role="dialog" aria-labelledby="descriptionModelPopupTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Assigned Task To Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="col-md-12">
                        <input type="hidden" id="task_assigned_id" value="">
                        <label for="assigned_task_to_employee" class="required">Assigned To Employee*</label>
                        <select name="" id="assigned_task_to_employee" class="form-control" required>
                            @foreach($assigned_employees as $id => $entry)
                                <option value="{{ $id }}">{{ $entry }}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="assigned_employee_done">Done</button>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('scripts')
@parent
<script>
    $(document).on('click','.assigned_task_employee',function(){
        $("#assignedEmployeeModel").modal('show');
        var task_id = $(this).attr('task_id');
        $("#task_assigned_id").val(task_id);
    });
    $('#assigned_employee_done').click(function(){
        var task_employee = $("#assigned_task_to_employee").val();
        var task_assigned_id = $("#task_assigned_id").val();
        $.ajax({
            url: "{{ route('admin.tasks.assigned-task-employee') }}",
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: { 'employee': task_employee,
                    'task_id': task_assigned_id },                        
            success: function(data) {
                sweetAlert("Thanks", "Employee Assigned Successfully!", "success");
                $("#assignedEmployeeModel").modal('hide');
                    if(data.length != 0){
                        console.log(data);
                    }
            },
            error: function(error) {
                console.log(error, 'err');
                alert("Error occured");
            }

        });
    });
</script>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('task_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tasks.massDestroy') }}",
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
    ajax: "{{ route('admin.tasks.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'department_name', name: 'department.name' },
{ data: 'name', name: 'name' },
{ data: 'description', name: 'description' },
{ data: 'tag', name: 'tags.name' },
{ data: 'attachment', name: 'attachment', sortable: false, searchable: false },
{ data: 'frequency', name: 'frequency' },
{ data: 'due_date', name: 'due_date' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Task').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection