@extends('layouts.frontend')
@section('content')
@can('invoice_create')
    <!-- <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('frontend.invoices.create') }}">
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
        <h4>Sales</h4>
        <ul class="nav nav-pills all-service-ul mt-3">
        <li class="nav-item">
            <a class="nav-link" href="#">All Sales</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#">Invoices</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Customers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link">Products & Services</a>
        </li>
        </ul>
    </div>
    <div class="px-4 py-4">
        <div class="d-flex justify-content-between">
            <h6 class="font-weight-normal">₹41545456 <span>365days</span></h6>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="invoice-stats-progress invoice-stats-progress-1">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h6>₹0</h6>
                            <p>0 Estimate</p>
                        </div>
                        <div class="">
                            <h6>₹0</h6>
                            <p>0 Estimate</p>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="invoice-stats-progress invoice-stats-progress-1">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h6>₹0</h6>
                            <p>0 Estimate</p>
                        </div>
                        <div class="">
                            <h6>₹0</h6>
                            <p>0 Estimate</p>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="px-4 pb-3 bg-white d-flex justify-content-between align-items-center">
        <div class="">
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
              <div class="dropdown ml-2" >
                <button onclick="myFunction('myDropdown3')" class="dropbtn">Date</button>
                <div id="myDropdown3" class="dropdown-content" style="max-height: 250px;min-width:200px">
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
        </div>
        <div class="">
            <div class="btn-group">
                <a href="{{ route('frontend.invoices.create') }}"><button type="button" class="btn btn-success">Create Invoice</button></a>
                <button onclick="myFunction('myDropdown2')" type="button" class="btn btn-success  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div id="myDropdown2" class="dropdown-menu">
                  <a class="dropdown-item" href="#">Import Invoices</a>
                  {{-- <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Separated link</a> --}}
                </div>
              </div>
        </div>

    </div>
    <div class="card-header">
        {{ trans('cruds.invoice.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Invoice">
            <thead>
                <tr>
                    <th width="10">

                    </th>
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
                    {{-- <th>
                        {{ trans('cruds.invoice.fields.customer_email') }}
                    </th>
                    <th>
                        {{ trans('cruds.invoice.fields.send_later') }}
                    </th> --}}
                    <th>
                        {{ trans('cruds.invoice.fields.due_date') }}
                    </th>
                    {{-- <th>
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
                        &nbsp;
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
    @can('invoice_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('frontend.invoices.massDestroy') }}",
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
    ajax: "{{ route('frontend.invoices.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        // { data: 'id', name: 'id' },
        // { data: 'type', name: 'type' },
        { data: 'invoice_date', name: 'invoice_date' },
        { data: 'invoice_no', name: 'invoice_no' },
        { data: 'customer_first_name', name: 'customer.first_name' },
        // { data: 'customer_email', name: 'customer_email' },
        // { data: 'send_later', name: 'send_later' },
        { data: 'due_date', name: 'due_date' },
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
  };
    let table = $('.datatable-Invoice').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

});




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
