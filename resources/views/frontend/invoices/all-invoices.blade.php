@extends('layouts.frontend')
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

<div class="">
<div class="bg-white px-4 pt-4">
    <h4>Sales</h4>
    <ul class="nav nav-pills all-service-ul mt-3">
    <li class="nav-item">
        <a class="nav-link active" href="#">All Sales</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Invoices</a>
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
    <div class="d-flex justify-content-between mb-4">
        <h4 class="font-weight-normal">Sales Transactions</h4>
        <div class="btn-group">
            <button type="button" class="btn btn-danger">Action</button>
            <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Separated link</a>
            </div>
          </div>
    </div>

    <div class="row no-gutters">
        <div class="col-md-3">
            <div class="invoice-stats invoice-stats-1">
                <h6>₹0</h6>
                <p>0 Estimate</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="invoice-stats invoice-stats-2">
                <h6>₹0</h6>
                <p>0 Estimate</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="invoice-stats invoice-stats-3">
                <h6>₹0</h6>
                <p>0 Estimate</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="invoice-stats invoice-stats-4">
                <h6>₹0</h6>
                <p>0 Estimate</p>
            </div>
        </div>
    </div>
</div>
<div class="px-4 pb-3 bg-white d-flex justify-content-between align-items-center">
    <div class="">
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn">Filter</button>
            <div id="myDropdown" class="dropdown-content all-invoice-fliter">
                <form>
                    <div class="form-row align-items-center">
                      <div class="form-group col-md-6">
                            <label for="inputState">Type</label>
                            <select id="inputState" class="form-control">
                              <option selected>Choose...</option>
                              <option>...</option>
                            </select>
                      </div>
                      <div class="form-group col-md-6">
                        <a class="btn btn-link text-success p-0" href="">View Deleted</a>
                      </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control">
                              <option selected>Choose...</option>
                              <option>...</option>
                            </select>
                          </div>
                        <div class="form-group col-md-6">
                            <label for="inputState">Delivery Method</label>
                            <select id="inputState" class="form-control">
                              <option selected>Choose...</option>
                              <option>...</option>
                            </select>
                        </div>

                            <div class="form-group col-md-4">
                                <label for="inputState">Date</label>
                                <select id="inputState" class="form-control">
                                  <option selected>Choose...</option>
                                  <option>...</option>
                                </select>
                              </div>

                          <div class="form-group col-md-4">
                            <label for="inputZip">From</label>
                            <input type="date" class="form-control" id="inputZip">
                          </div>
                          <div class="form-group col-md-4">
                            <label for="inputZip">To</label>
                            <input type="date" class="form-control" id="inputZip">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputState">Customer</label>
                            <select id="inputState" class="form-control">
                              <option selected>Choose...</option>
                              <option>...</option>
                            </select>
                        </div>
                    </div>




                    <button type="submit" class="btn btn-light mr-3">Reset</button>
                    <button type="submit" class="btn btn-primary">Apply</button>
                  </form>
            </div>
          </div>
          <div class="dropdown ml-2">
            <button onclick="myFunction()" class="dropbtn">Batch Action</button>
            <div id="myDropdown" class="dropdown-content">
              <a href="#">Link 1</a>
              <a href="#">Link 2</a>
              <a href="#">Link 3</a>
            </div>
          </div>
    </div>
    <div class="">
        <button class="btn btn-link p-0 text-muted"><i class="fa fa-print"></i></button>
        <button class="btn btn-link p-0 text-muted mx-4"><i class="fa fa-edit"></i></button>
        <button class="btn btn-link p-0 text-muted"><i class="fa fa-cog"></i></button>
    </div>

</div>

<div class="">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
          </tr>
        </tbody>
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
    url: "{{ route('admin.invoices.massDestroy') }}",
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
    ajax: "{{ route('admin.invoices.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'type', name: 'type' },
{ data: 'invoice_date', name: 'invoice_date' },
{ data: 'invoice_no', name: 'invoice_no' },
{ data: 'customer_first_name', name: 'customer.first_name' },
{ data: 'customer_email', name: 'customer_email' },
{ data: 'send_later', name: 'send_later' },
{ data: 'due_date', name: 'due_date' },
{ data: 'place_of_supply_state', name: 'place_of_supply.state' },
{ data: 'type_of_supply', name: 'type_of_supply' },
{ data: 'message_on_invoice', name: 'message_on_invoice' },
{ data: 'message_on_statement', name: 'message_on_statement' },
{ data: 'discount_type', name: 'discount_type' },
{ data: 'discount_amount', name: 'discount_amount' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
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
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
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
