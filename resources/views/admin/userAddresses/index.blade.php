@extends('layouts.admin')
@section('content')
@can('user_address_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.user-addresses.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.userAddress.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.userAddress.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-UserAddress">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.userAddress.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAddress.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAddress.fields.phone_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAddress.fields.addressline_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAddress.fields.addressline_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAddress.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAddress.fields.zip_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAddress.fields.state') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAddress.fields.customer') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAddress.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAddress.fields.uuid') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAddress.fields.type') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAddress.fields.same_as') }}
                    </th>
                    <th>
                        {{ trans('cruds.userAddress.fields.default_address') }}
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
@can('user_address_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-addresses.massDestroy') }}",
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
    ajax: "{{ route('admin.user-addresses.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'phone_no', name: 'phone_no' },
{ data: 'addressline_1', name: 'addressline_1' },
{ data: 'addressline_2', name: 'addressline_2' },
{ data: 'city', name: 'city' },
{ data: 'zip_code', name: 'zip_code' },
{ data: 'state', name: 'state' },
{ data: 'customer_first_name', name: 'customer.first_name' },
{ data: 'user_name', name: 'user.name' },
{ data: 'uuid', name: 'uuid' },
{ data: 'type', name: 'type' },
{ data: 'same_as', name: 'same_as' },
{ data: 'default_address', name: 'default_address' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-UserAddress').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection