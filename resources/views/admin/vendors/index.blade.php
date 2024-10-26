@extends('layouts.admin')
@section('content')
@can('vendor_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.vendors.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.vendor.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Vendor', 'route' => 'admin.vendors.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.vendor.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Vendor">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.first_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.middle_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.last_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.company_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.gst_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.gstin') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.state') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.pin_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.mobile') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.pancard') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.other') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.website') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.payment_method') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.term') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.account_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.tax_reg_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.effective_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.apply_tds') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.entity') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.section') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.calculation_threshold') }}
                    </th>
                    <th>
                        {{ trans('cruds.vendor.fields.is_my_customer') }}
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
@can('vendor_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.vendors.massDestroy') }}",
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
    ajax: "{{ route('admin.vendors.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'first_name', name: 'first_name' },
{ data: 'middle_name', name: 'middle_name' },
{ data: 'last_name', name: 'last_name' },
{ data: 'company_name', name: 'company_name' },
{ data: 'gst_type', name: 'gst_type' },
{ data: 'gstin', name: 'gstin' },
{ data: 'address', name: 'address' },
{ data: 'city_name', name: 'city.name' },
{ data: 'state_state', name: 'state.state' },
{ data: 'pin_code', name: 'pin_code' },
{ data: 'mobile', name: 'mobile' },
{ data: 'email', name: 'email' },
{ data: 'pancard', name: 'pancard' },
{ data: 'other', name: 'other' },
{ data: 'website', name: 'website' },
{ data: 'notes', name: 'notes' },
{ data: 'payment_method', name: 'payment_method' },
{ data: 'term_name', name: 'term.name' },
{ data: 'account_no', name: 'account_no' },
{ data: 'tax_reg_no', name: 'tax_reg_no' },
{ data: 'effective_date', name: 'effective_date' },
{ data: 'apply_tds', name: 'apply_tds' },
{ data: 'entity', name: 'entity' },
{ data: 'section', name: 'section' },
{ data: 'calculation_threshold', name: 'calculation_threshold' },
{ data: 'is_my_customer', name: 'is_my_customer' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Vendor').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection