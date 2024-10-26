@extends('layouts.customer')
@section('content')
@can('invoice_create')
    <!-- <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.invoices.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.invoice.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Invoice', 'route' => 'admin.invoices.parseCsvImport'])
        </div>
    </div> -->
@endcan
<div class="card">

    <div class="bg-white px-4 pt-4">
        <h4>Customers</h4>
        <ul class="nav nav-pills all-service-ul mt-3">
        {{-- <li class="nav-item">
            <a class="nav-link" href="#">All Sales</a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.invoices.index',['type'=>'myrequests']) }}">Invoices</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('customer.subcustomers.index') }}">Customers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.products.index') }}">Products & Services</a>
        </li>
        </ul>
    </div>
    <div class="px-4 py-4">
        <div class="d-flex justify-content-between">
            <h6 class="font-weight-bolder"> Total Customers :- {{ isset($customer_total) ? $customer_total : '' }}</h6>
            <span class="font-weight-bolder">365days</span>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="invoice-stats-progress invoice-stats-progress-1">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h6 class="text text-success">{{ isset($customer_approved) ? $customer_approved : '' }}</h6>
                            <p class="font-weight-500">Approved Customers</p>
                            <input type="hidden" id="Customer_approved" value="{{$customer_approved}}">
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
                            <h6 class="text text-danger">{{ isset($customer_pending) ? $customer_pending: '' }}</h6>
                            <p class="font-weight-500">Non Approved Customers</p>
                            <input type="hidden" id="Customer_pending" value="{{$customer_pending}}">
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
                <option value="customer_approve">Status</option>
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
        <div class="">
            {{-- <div class="btn-group">
                <a href="{{ route('customer.subcustomers.create') }}"><button type="button" class="btn btn-success">Add Customer</button></a>
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
              </div> --}}
        </div>

    </div>
    <div class="card-header">
        {{ trans('cruds.customer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-Invoice">
            <thead>
                <tr>
                    <th width="5">

                    <th>
                        {{ trans('cruds.customer.fields.customer_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.pan_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.company') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.customer.fields.state') }}
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
        
        subcustomerList(date_id,approve_id);
    });
    $('#clear_filters').click(function(){
        window.location.reload();
    });
    $(document).ready(function(){
        var customer_pending = document.getElementById('Customer_pending').value;
        var customer_approved = document.getElementById('Customer_approved').value;
        var customer_total = parseInt(document.getElementById('Customer_approved').value)+parseInt(document.getElementById('Customer_pending').value);
        var per1 = ((customer_approved/customer_total) * 100).toFixed(0);
        var per2 = ((customer_pending/customer_total) * 100).toFixed(0);
        document.getElementById('div1').style.width = per1+"%";
        document.getElementById('div2').style.width = per2+"%";
        subcustomerList();
    });

    function subcustomerList(date_id="date",approve_id="customer_approve") {
    url = "{{ route('customer.subcustomers.index') }}";
    url = url+'?'+'date_id='+date_id+'&'+'approve_id='+approve_id;
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('customer_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('customer.subcustomers.massDestroy') }}",
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
        { data: 'first_name', name: 'first_name' },
        { data: 'email', name: 'email' },
        { data: 'pan_no', name: 'pan_no' },
        { data: 'company', name: 'company' },
        { data: 'city', name: 'city' },
        { data: 'state', name: 'state' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
    let table = $('.datatable-Invoice').DataTable(dtOverrideGlobals);
    table.ajax.url(url).load();
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

}

</script>
<script>
    /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    function myFunction(dropid) {
      document.getElementById(dropid).classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
</script>
@endsection
