@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.team-members.invite') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-auto">
                    <input class="form-control" type="text" name="email" id="email" placeholder="Email">
                </div>
                <div class="col p-0">
                    <button class="btn btn-success" type="submit">
                        Invite
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.user.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email_verified_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.approved') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.verified') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.roles') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.identity_proof') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.address_proof') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.passport_size_photo') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.department') }}
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
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
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
    ajax: "{{ route('admin.users.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'email', name: 'email' },
{ data: 'email_verified_at', name: 'email_verified_at' },
{ data: 'approved', name: 'approved' },
{ data: 'verified', name: 'verified' },
{ data: 'roles', name: 'roles.title' },
{ data: 'identity_proof', name: 'identity_proof', sortable: false, searchable: false },
{ data: 'address_proof', name: 'address_proof', sortable: false, searchable: false },
{ data: 'passport_size_photo', name: 'passport_size_photo', sortable: false, searchable: false },
{ data: 'department', name: 'departments.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-User').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection