@extends('layouts.admin')
@section('content')
@can('assigned_sub_task_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.assigned-sub-tasks.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.assignedSubTask.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'AssignedSubTask', 'route' => 'admin.assigned-sub-tasks.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.assignedSubTask.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AssignedSubTask">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.assignedSubTask.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedSubTask.fields.company')}}
                    </th>
                    <th>
                        {{ trans('cruds.assignedSubTask.fields.task') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedSubTask.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedSubTask.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedSubTask.fields.assigned_to') }}
                    </th>
                    {{-- <th>
                        {{ trans('cruds.assignedSubTask.fields.hours_estimation') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedSubTask.fields.requirement') }}
                    </th>
                    <th>
                        {{ trans('cruds.assignedSubTask.fields.proof_of_work') }}
                    </th> --}}
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
                        {{ trans('cruds.assignedSubTask.fields.assigned_task_description') }}
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
<div class="modal fade" id="descriptionModelPopup" tabindex="-1" role="dialog"
    aria-labelledby="descriptionModelPopupTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">End Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="hdnTrackingId">
                <input type="hidden" id="hdnAssignedTaskId">
                <div class="row">
                    <div class="col-md-12">
                        <label for="description" class="required">Description*</label>
                        <textarea name="" id="description" rows="5" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="status" class="required">Status*</label>
                        <select name="" id="status" class="form-control" required>
                            @foreach($statuses as $id => $entry)
                                <option value="{{ $id }}">{{ $entry }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-2">
                    <p style="color:red" id="popupErrorMsg"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savePopup">Save changes</button>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('scripts')
@parent
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).on('click', '.project-tracker', function() {
    assigned_sub_task_id = $(this).attr("row_id");
    tracker_id = $(this).attr("tracker_id");
    if (tracker_id) {
        $('#descriptionModelPopup').modal('show');
        $('#hdnTrackingId').val(tracker_id);
        $('#hdnAssignedTaskId').val(assigned_sub_task_id);
        // var a = $(this);

    } else {
        if ($('.recorder').is(':visible')) {
            Swal.fire('kindly stop the previous task first')
            return false;
        }
        var a = $(this);
        $.post('{{route("admin.assigned-sub-tasks.tracker")}}', {
                "assigned_sub_task_id": assigned_sub_task_id,
                "tracker_id": tracker_id,
                "_token": "{{csrf_token()}}"
            },
            function(data, status) {
                if (data.status == 1) {
                    $(`a[row_id='${assigned_sub_task_id}']`).text("start");
                    $('.recorder').addClass('d-none');
                    a.removeAttr("tracker_id");
                } else {
                    a.attr("tracker_id", data.tracker_id)
                    $(`a[row_id='${assigned_sub_task_id}']`).text("stop");
                    $('.recorder').removeClass('d-none');
                }
            });
    }

})
</script>
<script>
    $('#savePopup').click(function() {
        $('#popupErrorMsg').text('');
        let des = $('#description').val();
        let sta = $('#status').val();
        let tracking_id = $('#hdnTrackingId').val();
        let assigned_sub_task_id = $('#hdnAssignedTaskId').val();
        if (des != '' && sta != '') {
            $.post('{{route("admin.assigned-sub-tasks.tracker")}}', {
                    "assigned_sub_task_id": assigned_sub_task_id,
                    "tracker_id": tracking_id,
                    "description": des,
                    "status": sta,
                    "_token": "{{csrf_token()}}"
                },
                function(data, status) {
                    var a = $(`a[row_id='${assigned_sub_task_id}']`);
                    if (data.status == 1) {
                        $(`a[row_id='${assigned_sub_task_id}']`).text("start");
                        $('.recorder').addClass('d-none');
                        a.removeAttr("tracker_id");
                        if (sta == 4) {
                            a.hide();
                        }
                    } else {
                        a.attr("tracker_id", data.tracker_id)
                        $(`a[row_id='${assigned_sub_task_id}']`).text("stop");
                        $('.recorder').removeClass('d-none');
                    }
                    $('#descriptionModelPopup').modal('hide');
                });
        } else {
            $('#popupErrorMsg').text('both fields are mandatory');
        }
    })
    </script>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('assigned_sub_task_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.assigned-sub-tasks.massDestroy') }}",
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
    ajax: "{{ route('admin.assigned-sub-tasks.index') }}",
    columns: [
    { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'company_name', name: 'company_name' },
{ data: 'task_name', name: 'task_name' },
{ data: 'user_name', name: 'user_name' },
{ data: 'description', name: 'description' },
{ data: 'assigned_to_name', name: 'assigned_to_name' },
// { data: 'hours_estimation', name: 'hours_estimation' },
// { data: 'requirement', name: 'requirement', sortable: false, searchable: false },
// { data: 'proof_of_work', name: 'proof_of_work', sortable: false, searchable: false },
{ data: 'status_name', name: 'status_name' },
{ data: 'is_approved', name: 'is_approved' },
{ data: 'target_date', name: 'target_date' },
{ data: 'completed_date', name: 'completed_date' },
{ data: 'assigned_task_description', name: 'assigned_task_description' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-AssignedSubTask').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection