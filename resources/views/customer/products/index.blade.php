@extends('layouts.customer')
@section('content')
@can('invoice_create')
    {{-- <!-- <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.invoices.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.invoice.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Invoice', 'route' => 'admin.invoices.parseCsvImport'])
        </div>
    </div> --> --}}
@endcan
<div class="card">

    <div class="bg-white px-4 pt-4">
        <h4>Products</h4>
        <ul class="nav nav-pills all-service-ul mt-3">
        {{-- <li class="nav-item">
            <a class="nav-link" href="#">All Sales</a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.invoices.index',['type'=>'myrequests']) }}">Invoices</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.subcustomers.index') }}">Customers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('customer.products.index') }}">Products & Services</a>
        </li>
        </ul>

    </div>
    <div class="px-4 py-4">
        <div class="d-flex justify-content-between">
            <h6 class="font-weight-bolder"> Total Products :- {{ isset($product_total) ? $product_total : '' }}</h6>
            <span class="font-weight-bolder">365days</span>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="invoice-stats-progress invoice-stats-progress-1">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h6 class="text text-success">{{ isset($product_approved) ? $product_approved : '' }}</h6>
                            <p class="font-weight-500">Approved Products</p>
                            <input type="hidden" id="Product_approved" value="{{$product_approved}}">
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-success" id="div1" role="progressbar"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="invoice-stats-progress invoice-stats-progress-1">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h6 class="text text-danger">{{ isset($product_pending) ? $product_pending: '' }}</h6>
                            <p class="font-weight-500">Non Approved Products</p>
                            <input type="hidden" id="Product_pending" value="{{$product_pending}}">
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-danger" id="div2"  role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="px-4 pb-3 bg-white d-flex justify-content-between align-items-center">
        <div class="form-group">
            <div class="d-flex flex-row">
            <select class="form-control filters" id="date_filter" name="date_filter">
                <option value="date">Date</option>
                <option value='today'>Today</option>
                <option value='yesterday'>Yesterday</option>
                <option value='this_week'>This Week</option>
                <option value='last_week'>Last Week</option>
                <option value='this_month'>This Month</option>
                <option value='last_month'>Last Month</option>
                <option value='this_year'>This Year</option>
                <option value='last_year'>Last Year</option>
            </select>
            <select class="form-control filters"  id="approve_filter" name="approve_filter">
                <option value="product_approve">Status</option>
                <option value="1">Approved</option>
                <option value="0">Non Approved</option>
            </select>
            <button class="btn btn-primary filters-buttons" id="apply_filters">Apply Filter</button>
            <button class="btn btn-danger filters-buttons" id="clear_filters">Clear Filters</button>
        </div>
    </div>
        {{--<div class="">
            <div class="dropdown">
                <button onclick="myFunction('myDropdown')" class="dropbtn" disabled>Batch Action</button>
                <div id="myDropdown" class="dropdown-content">
                  <a href="#">Link 1</a>
                  <a href="#">Link 2</a>
                  <a href="#">Link 3</a>
                </div>
              </div>
              <div class="dropdown ml-2">
                <button onclick="myFunction('myDropdown1')" class="dropbtn">Status</button>
                <div id="myDropdown1" class="dropdown-content">
                  <a href="#">All</a>
                  <a href="#">Needs Attention</a>
                  <hr>
                  <a href="#">Unpaid</a>
                  <a href="#">   -Overdue</a>
                  <a href="#">   - Not due</a>
                  <hr>
                  <a href="#">Paid</a>
                  <a href="#">  - Deposited</a>
                  <a href="#">  - Not Deposited</a>
                </div>
              </div>
              <div class="dropdown ml-2">
                <button onclick="myFunction('myDropdown3')" class="dropbtn">Date</button>
                <div id="myDropdown3" class="dropdown-content">
                  <a href="#">Today</a>
                  <a href="#">This month</a>
                  <a href="#">Last month</a>
                  <a href="#">Last 3 months</a>
                  <a href="#">Last 6 months</a>
                  <a href="#">Last 12 months</a>
                  <a href="#">Year to date</a>
                  <a href="#">2021</a>
                  <a href="#">2020</a>
                  <a href="#">2019</a>
                </div>
              </div>
        </div>--}}
        {{-- <div class="">
            <div class="btn-group">
                <a href="{{ route('customer.products.create') }}"><button type="button" class="btn btn-success">Add Product/Service</button></a>
                <button onclick="myFunction('myDropdown2')" type="button" class="btn btn-success  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div id="myDropdown2" class="dropdown-menu">
                  <a class="dropdown-item" href="#">Import Invoices</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Separated link</a> 
                </div>
              </div>
        </div> --}}

    </div>
    <div class="card-header">
        {{ trans('cruds.product.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Product">
            <thead>
                <tr>
                    <th width="10">
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
                        {{ trans('cruds.product.fields.rate_exclusive') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.actions') }}
                    </th>
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
    $('#apply_filters').click(function(){
        var date_id = document.getElementById('date_filter').value;
        var approve_id = document.getElementById('approve_filter').value;
    
        productList(date_id,approve_id);
    });
    $('#clear_filters').click(function(){
        window.location.reload();
    });
    $(document).ready(function(){
        var product_pending = document.getElementById('Product_pending').value;
        var product_approved = document.getElementById('Product_approved').value;
        var product_total = parseInt(document.getElementById('Product_approved').value)+parseInt(document.getElementById('Product_pending').value);
        var per1 = ((product_approved/product_total) * 100).toFixed(0);
        var per2 = ((product_pending/product_total) * 100).toFixed(0);
        document.getElementById('div1').style.width = per1+"%";
        document.getElementById('div2').style.width = per2+"%";
        productList();
    });
    function productList(date_id='date',approve_id='product_approve'){
    url = "{{ route('customer.products.index') }}";
    url = url+'?'+'date_id='+date_id+'&'+'approve_id='+approve_id;
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('customer.products.massDestroy') }}",
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
