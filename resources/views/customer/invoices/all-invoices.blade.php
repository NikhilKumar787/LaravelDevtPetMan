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
            <button onclick="myFunction('myDropdown')" class="dropbtn">Filter</button>
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
            <button onclick="myFunction('myDropdown2')" class="dropbtn">Batch Action</button>
            <div id="myDropdown2" class="dropdown-content" style="min-width: 200px">
              <a href="#">Print transactions</a>
              <a href="#">Print delivery challan</a>
              <a href="#">Send transactions</a>
              <a href="#">Send reminders</a>
            </div>
          </div>
    </div>
    <div class="d-flex">
        <button class="btn btn-link p-0 text-muted"><i class="fa fa-print"></i></button>
        <button class="btn btn-link p-0 text-muted mx-4"><i class="fa fa-edit"></i></button>
        <div class="dropdown" >
          <button class="btn btn-link p-0 m-0 text-muted dropbtn" onclick="myFunction('myDropdown3')"><i class="fa fa-cog pointer-none"></i></button>
          <div id="myDropdown3" class="dropdown-content" style="min-width: 200px; right:0">
            <form class="column-filter">
              <p class="mb-1">Column</p>
              <div class="column-filter-checks-bg">
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Method</label>
              </div>
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="customCheck2">
                <label class="custom-control-label" for="customCheck2">Source</label>
              </div>
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="customCheck3">
                <label class="custom-control-label" for="customCheck3">Ageing</label>
              </div>
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="customCheck4">
                <label class="custom-control-label" for="customCheck4">Email</label>
              </div>
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="customCheck3">
                <label class="custom-control-label" for="customCheck3">Ageing</label>
              </div>
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="customCheck4">
                <label class="custom-control-label" for="customCheck4">Email</label>
              </div>
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="customCheck3">
                <label class="custom-control-label" for="customCheck3">Ageing</label>
              </div>
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="customCheck4">
                <label class="custom-control-label" for="customCheck4">Email</label>
              </div>
              </div>  
              <div class="form-group mt-2">
                <p class="mb-1">Rows</p>
                <select class="form-control" id="exampleFormControlSelect2">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>  
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="customCheck4">
                <label class="custom-control-label" for="customCheck4">Compact</label>
              </div> 
              <a class="btn btn-link p-0 m-0 text-left text-success mt-3" href="">switch</a>        
            </form>             
          </div>
        </div>
    </div>   
</div>

<div class="">
    <table class="table bg-white">
        <thead>
          <tr>
            <th scope="col">
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="customCheck5">
                <label class="custom-control-label" for="customCheck5"></label>
              </div>
            </th>
            <th scope="col">DATE</th>
            <th scope="col">TYPE</th>
            <th scope="col">NO.</th>
            <th scope="col">CUSTOMER</th>
            <th scope="col">MEMO</th>
            <th scope="col">DUE DATE</th>
            <th scope="col">BALANCE</th>
            <th scope="col">TOTAL BEFORE TAX</th>
            <th scope="col">TAX</th>
            <th scope="col">TOTAL</th>
            <th scope="col">STATUS</th>
            <th scope="col">ACTION</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td scope="row">
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="customCheck6">
                <label class="custom-control-label" for="customCheck6"></label>
              </div>
            </td>
            <td>13/08/2022</td>
            <td>Payment</td>
            <td>-</td>
            <td>500 DLF</td>
            <td>-</td>
            <td>13/08/2022</td>
            <td>₹0.00</td>
            <td>-₹6,014.62</td>
            <td>₹0.00</td>
            <td>-₹6,014.62</td>
            <td>Closed</td>
            <td>
              <div class="dropdown">
                <button onclick="myFunction('myDropdown4')" class="dropbtn p-0 border-0 font-weight-normal">Receive payment <i class="right fa fa-fw fa-angle-down nav-icon"></i></button>
                <div id="myDropdown4" class="dropdown-content" style="min-width: 170px">
                  <a href="#">Print</a>
                  <a href="#">Send</a>
                  <a href="#">Copy</a>
                  <a href="#">Delete</a>
                </div>
              </div>
            </td>
          </tr>   
          <tr>
            <td scope="row">
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="customCheck6">
                <label class="custom-control-label" for="customCheck6"></label>
              </div>
            </td>
            <td>13/08/2022</td>
            <td>Payment</td>
            <td>-</td>
            <td>500 DLF</td>
            <td>-</td>
            <td>13/08/2022</td>
            <td>₹0.00</td>
            <td>-₹6,014.62</td>
            <td>₹0.00</td>
            <td>-₹6,014.62</td>
            <td>Closed</td>
            <td>
              <div class="dropdown">
                <button onclick="myFunction('myDropdown4')" class="dropbtn p-0 border-0 font-weight-normal">Receive payment <i class="right fa fa-fw fa-angle-down nav-icon"></i></button>
                <div id="myDropdown4" class="dropdown-content" style="min-width: 170px">
                  <a href="#">Print</a>
                  <a href="#">Send</a>
                  <a href="#">Copy</a>
                  <a href="#">Delete</a>
                </div>
              </div>
            </td>
          </tr> 
          <tr>
            <td scope="row">
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="customCheck6">
                <label class="custom-control-label" for="customCheck6"></label>
              </div>
            </td>
            <td>13/08/2022</td>
            <td>Payment</td>
            <td>-</td>
            <td>500 DLF</td>
            <td>-</td>
            <td>13/08/2022</td>
            <td>₹0.00</td>
            <td>-₹6,014.62</td>
            <td>₹0.00</td>
            <td>-₹6,014.62</td>
            <td>Closed</td>
            <td>
              <div class="dropdown">
                <button onclick="myFunction('myDropdown4')" class="dropbtn p-0 border-0 font-weight-normal">Receive payment <i class="right fa fa-fw fa-angle-down nav-icon"></i></button>
                <div id="myDropdown4" class="dropdown-content" style="min-width: 170px">
                  <a href="#">Print</a>
                  <a href="#">Send</a>
                  <a href="#">Copy</a>
                  <a href="#">Delete</a>
                </div>
              </div>
            </td>
          </tr> 
          <tr>
            <td scope="row">
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input" id="customCheck6">
                <label class="custom-control-label" for="customCheck6"></label>
              </div>
            </td>
            <td>13/08/2022</td>
            <td>Payment</td>
            <td>-</td>
            <td>500 DLF</td>
            <td>-</td>
            <td>13/08/2022</td>
            <td>₹0.00</td>
            <td>-₹6,014.62</td>
            <td>₹0.00</td>
            <td>-₹6,014.62</td>
            <td>Closed</td>
            <td>
              <div class="dropdown">
                <button onclick="myFunction('myDropdown4')" class="dropbtn p-0 border-0 font-weight-normal">Receive payment <i class="right fa fa-fw fa-angle-down nav-icon"></i></button>
                <div id="myDropdown4" class="dropdown-content" style="min-width: 170px">
                  <a href="#">Print</a>
                  <a href="#">Send</a>
                  <a href="#">Copy</a>
                  <a href="#">Delete</a>
                </div>
              </div>
            </td>
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
    function myFunction(dropid) {     
      $('.dropdown-content').removeClass('show')     
      document.getElementById(dropid).classList.toggle("show");
     // document.getElementsByClassName("dropdown-content").remove("show");
     
    }    
    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        //alert(dropdowns)
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