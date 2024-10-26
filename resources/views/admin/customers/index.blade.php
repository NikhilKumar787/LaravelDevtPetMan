@extends('layouts.admin')
@section('content')
@can('customer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.customers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.customer.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Customer', 'route' => 'admin.customers.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.customer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Customer">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.first_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.middle_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.last_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.gstin') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.gst_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.gst_customer_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.mobile') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.state') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.country') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.pin_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.company') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.other') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.website') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.term') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.pan_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.tan') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.payment_method') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.delivery_method') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.attachment') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.optional_data_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.optional_data_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.is_my_vendor') }}
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
@can('customer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.customers.massDestroy') }}",
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
    ajax: "{{ route('admin.customers.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'first_name', name: 'first_name' },
{ data: 'middle_name', name: 'middle_name' },
{ data: 'last_name', name: 'last_name' },
{ data: 'gstin', name: 'gstin' },
{ data: 'gst_type', name: 'gst_type' },
{ data: 'gst_customer_name', name: 'gst_customer_name' },
{ data: 'mobile', name: 'mobile' },
{ data: 'address', name: 'address' },
{ data: 'city_name', name: 'city.name' },
{ data: 'state_state', name: 'state.state' },
{ data: 'country_name', name: 'country.name' },
{ data: 'pin_code', name: 'pin_code' },
{ data: 'company', name: 'company' },
{ data: 'other', name: 'other' },
{ data: 'website', name: 'website' },
{ data: 'phone', name: 'phone' },
{ data: 'term_name', name: 'term.name' },
{ data: 'notes', name: 'notes' },
{ data: 'pan_no', name: 'pan_no' },
{ data: 'tan', name: 'tan' },
{ data: 'payment_method', name: 'payment_method' },
{ data: 'delivery_method', name: 'delivery_method' },
{ data: 'attachment', name: 'attachment', sortable: false, searchable: false },
{ data: 'optional_data_1', name: 'optional_data_1' },
{ data: 'optional_data_2', name: 'optional_data_2' },
{ data: 'email', name: 'email' },
{ data: 'is_my_vendor', name: 'is_my_vendor' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Customer').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection