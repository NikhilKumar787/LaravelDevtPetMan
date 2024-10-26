@extends('layouts.customer')
@section('content')
<style>
    #table_check_filter{
        display: none;
    }
</style>
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
        <h4>Invoices</h4>
        <ul class="nav nav-pills all-service-ul mt-3">
        {{-- <li class="nav-item">
            <a class="nav-link" href="#">All Sales</a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('customer.invoices.index', ['type'=>'myrequests']) }}">Invoices</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.subcustomers.index') }}">Customers</a>
            
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.products.index') }}">Products & Services</a>
        </li>
        </ul>

    </div>
    <div class="px-4 py-4">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex justify-content-between">
                    <h6 class="font-weight-bolder">₹{{ isset($total_amount_unpaid_invoices) ? $total_amount_unpaid_invoices : '' }} Due/Undue Amount</h6>
                    <span class="font-weight-300"> (Last 15 days)</span>
                </div>
                <div class="invoice-stats-progress invoice-stats-progress-1">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h6 class="text text-danger">₹{{ isset($total_amount_notdue_invoices) ? $total_amount_notdue_invoices : '' }}</h6>
                            <p class="font-weight-500">Not Due Yet</p>
                            <input type="hidden" id="Not_Due_Yet" value="{{ isset($total_amount_notdue_invoices) ? $total_amount_notdue_invoices : '' }}">
                        </div>
                        <div class="">
                            <h6 class="text text-danger">₹{{ isset($total_amount_overdue_invoices) ? $total_amount_overdue_invoices : '' }}</h6>
                            <p class="font-weight-500">Over Due</p>
                            <input type="hidden" id="Over_Due" value="{{ isset($total_amount_overdue_invoices) ? $total_amount_overdue_invoices : '' }}">
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-danger" id="div1" role="progressbar"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-between">
                    <h6 class="font-weight-bolder">₹{{ isset($total_invoices_amount) ? $total_invoices_amount : '' }} Payable Amount</h6>
                   
                    <span class="font-weight-300"> (Last 30 days)</span>
                </div>
                <div class="invoice-stats-progress invoice-stats-progress-1">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h6 class="text text-success">₹{{ isset($total_undeposited_amount) ? $total_undeposited_amount : '' }}</h6>
                            <p class="font-weight-500">Not Deposited</p>
                            <input type="hidden" id="Not_Deposited" value="{{ isset($total_undeposited_amount) ? $total_undeposited_amount : '' }}">
                        </div>
                        <div class="">
                            <h6 class="text text-success">₹{{ isset($total_amount_deposited) ? $total_amount_deposited : '' }}</h6>
                            <p class="font-weight-500">Deposited</p>
                            <input type="hidden" id="Deposited" value="{{ isset($total_amount_deposited) ? $total_amount_deposited : '' }}">
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-success" id="div2" role="progressbar"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="p-4 bg-white d-flex justify-content-between align-items-center">
        <div class="form-group">
            <div class="d-flex flex-row">
            <select class="form-control filters" aria-label=".form-select-lg example" id="customer-filters" name="customer-filters">
                <option value="customer">Customer</option>
                @foreach($customer_details as $key => $label)
                <option value="{{ $label->id }}">{{ $label->first_name.' '.$label->middle_name.' '.$label->last_name }}</option>
                @endforeach
            </select>
            <select class="form-control filters" id="date-filters" name="date-filters">
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
            <select class="form-control filters"  id="status-filters" name="status-filters">
                <option value="status" >Status</option>
                <option value="0">Under Process</option>
                <option value="1">Completed</option>
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
              <div class="dropdown ml-3">
                <button onclick="myFunction('myDropdown3')" class=" dropbtn">Date</button>
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
        {{--<input id="idsDropdownTextField3" aria-invalid="false" class="form-control" type="text" readonly="" autocomplete="off" role="combobox" aria-controls="idsDropdown-Menu-1" aria-expanded="true" aria-haspopup="listbox" value="All">--}}
        <div class="">
            <div class="btn-group">
                <a href="{{ route('customer.invoices.create') }}"><button type="button" class="btn btn-success">Invoice Request</button></a>
                {{-- <button onclick="myFunction('myDropdown2')" type="button" class="btn btn-success  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                  <span class="sr-only">Toggle Dropdown</span>
                </button> --}}
                {{-- <div id="myDropdown2" class="dropdown-menu">
                  <a class="dropdown-item" href="#">Import Invoices</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Separated link</a>
                </div> --}}
              </div>
        </div>
    </div>
<!-- Posted Modal
<div class="modal fade" id="postedModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-control">
            <h5 class="text-text-success">Are You Sure For Do Your Invoice Posted ?</h6>
            <h6 class="text-text-success">If you want to Do Posted this invoice then click Po</h6>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Done</button>
      </div>
    </div>
  </div>
</div> -->

    {{-- check alert condition here --}}
    <div class="card-header">
        {{ trans('cruds.invoice.title_singular') }} {{ trans('global.list') }}
    </div>
    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Invoice" id="table_check">
            <thead>
                <tr>
                    {{-- <th width="10">
                        
                    </th> --}}
                    {{-- <th>
                        {{ trans('cruds.invoice.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.type') }}
                    </th> --}}
                    <th>
                        {{ trans('cruds.invoice.fields.invoice_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.invoice_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.customer') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.payable_amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.due_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.invoice_request_status') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.payment_status') }}
                    </th>
                    {{-- <th>
                        {{ trans('cruds.invoice.fields.customer_email') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.send_later') }}
                    </th> 
                    <th>
                        {{ trans('cruds.invoice.fields.place_of_supply') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.type_of_supply') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.message_on_invoice') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.message_on_statement') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.discount_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.discount_amount') }}
                    </th> --}}
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
    $('#apply_filters').click(function(){
        var customer_id = document.getElementById('customer-filters').value;
        var date_id = document.getElementById('date-filters').value;
        var status_id = document.getElementById('status-filters').value;
    
        invoiceList(customer_id,date_id,status_id);
    });
    $('#clear_filters').click(function(){
        window.location.reload();
    });
    $(document).ready(function(){
        var over_due = document.getElementById('Over_Due').value;
        var not_due_yet = document.getElementById('Not_Due_Yet').value;
        var not_deposited = document.getElementById('Not_Deposited').value;
        var deposited = document.getElementById('Deposited').value;
        var per1 = ((over_due/not_due_yet) * 100).toFixed(3);
        if(not_due_yet == 0){
            document.getElementById('div1').style.width = "100%";
        }else{
            document.getElementById('div1').style.width = per1+"%";
        }
        var per2 = ((deposited/not_deposited) * 100).toFixed(3);
        document.getElementById('div2').style.width = per2+"%";

        invoiceList();
    });

    function invoiceList(customer_id='customer',date_id='date',status_id='status'){
        var url = "{{ route('customer.invoices.index') }}";
            @if(request()->query('type')=='paid')
            url = "{{ route('customer.invoices.index',['type'=>'paid']) }}";
            @elseif(request()->query('type')=='unpaid')
            url = "{{ route('customer.invoices.index',['type'=>'unpaid']) }}";
            @elseif(request()->query('type')=='myrequests')
            url = "{{ route('customer.invoices.index',['type'=>'myrequests']) }}";
            @endif
            url = url+'&'+'customer_id='+customer_id+'&'+'date_id='+date_id+'&'+'status_id='+status_id;
            console.log(url);
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('invoice_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('customer.invoices.massDestroy') }}",
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
                'columnDefs': [
                    {
                    'targets': 0,
                    'checkboxes': {
                    'selectRow': false
                        }
                    }
                ],
                columns: [
                // { data: 'placeholder', name: 'placeholder'},
                // { data: 'id', name: 'id' },
                // { data: 'type', name: 'type' },
                { data: 'invoice_date', name: 'invoice_date'},
                { data: 'invoice_no', name: 'invoice_no' },
                { data: 'customer_name', name: 'customer_name' },
                { data: 'total_payable_amount', name: 'total_payable_amount' },
                // { data: 'customer_email', name: 'customer_email' },
                // { data: 'send_later', name: 'send_later' },
                { data: 'due_date', name: 'due_date' },
                { data: 'invoice_request_status', name: 'invoice_request_status'},
                { data: 'payment_status', name: 'payment_status'},
                // { data: 'place_of_supply_state', name: 'place_of_supply.state' },
                // { data: 'type_of_supply', name: 'type_of_supply' },
                // { data: 'message_on_invoice', name: 'message_on_invoice' },
                // { data: 'message_on_statement', name: 'message_on_statement' },
                // { data: 'discount_type', name: 'discount_type' },
                // { data: 'discount_amount', name: 'discount_amount' },
                { data: 'actions', name: '{{ trans('global.actions') }}' }
            ],
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 10,
            "initComplete": function( settings, json ) {
            $('.hidden_invoice_unread').closest('tr').css('background-color','#e4e2ff');
            $('.hidden_invoice_unread').closest('tr').css('color','#211b73');

        },
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
