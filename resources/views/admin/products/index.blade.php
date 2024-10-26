@extends('layouts.admin')
@section('content')
@can('product_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.products.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.product.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Product', 'route' => 'admin.products.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.product.title_singular') }} {{ trans('global.list') }}
    </div>
    
    <div class="card-body">
            <div class="d-flex col-md-7">
                <select class="form-control filters select2" aria-label=".form-select-lg example" id="company-filter" name="company-filter">
                    <option value="company">Company</option>
                    @foreach($company_list as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary filters-buttons" id="apply_filter">Apply Filter</button>
                <button class="btn btn-danger filters-buttons" id="clear_filter">Clear Filters</button>
            </div>
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Product">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.product.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.hsn') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.unit') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.sales_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.tax_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.gst') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.cess') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.cess_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.purchase_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.price_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.item_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.wholesale_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.item_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.income_account_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.account_group') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.account_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.account_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.category') }}
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
$(document).on('click', '#apply_filter', function(){
    var company_id = $('#company-filter').val();
    console.log(company_id);
    productList(company_id);
});

$(document).on('click', '#clear_filter', function(){
    window.location.reload();
});

$(document).ready(function(){
    productList();
});

function productList (company_id='company') {
    var url = "{{ route('admin.products.index') }}";
    url = url+'?'+'company_id='+company_id;
    console.log(url);
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.products.massDestroy') }}",
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
{ data: 'name', name: 'name' },
{ data: 'description', name: 'description' },
{ data: 'hsn', name: 'hsn' },
{ data: 'unit', name: 'unit' },
{ data: 'sales_price', name: 'sales_price' },
{ data: 'tax_type', name: 'tax_type' },
{ data: 'gst', name: 'gst' },
{ data: 'cess', name: 'cess' },
{ data: 'cess_type', name: 'cess_type' },
{ data: 'purchase_price', name: 'purchase_price' },
{ data: 'price_type', name: 'price_type' },
{ data: 'item_type', name: 'item_type' },
{ data: 'wholesale_price', name: 'wholesale_price' },
{ data: 'item_code', name: 'item_code' },
{ data: 'income_account_type', name: 'income_account_type' },
{ data: 'account_group', name: 'account_group' },
{ data: 'account_type_type', name: 'account_type.type' },
{ data: 'account_name_name', name: 'account_name.name' },
{ data: 'category', name: 'categories.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Product').DataTable(dtOverrideGlobals);
  table.ajax.url(url).load();
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

}

</script>
@endsection
