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
@if(auth()->user()->profile != 'complete' || (empty($company)  || (!empty($company) && $company->profile != 'complete')))
<div class="warning-message-bg d-flex justify-content-between">
    <div class="">
        <h5 class="m-0 text-warning">Please complete your profile</h5>
        <p class="m-0">Please add your personal details and company details</p>
    </div>
    <div class="text-right">
        {{-- <button class="btn btn-light" type="submit">
            Cancel
        </button> --}}
        <a href="{{route('frontend.profile.edit')}}"><button class="btn btn-success" type="button">
            Complete
        </button></a>
    </div>
</div>
@endif


<div class="card">
    <div class="bg-white px-4 pt-4">
        <h4>{{isset($company->company_name) ? strtoupper($company->company_name) : 'HAMARA EMPIRE PROJECTS LIMITED'}}</h4>
    </div>
    <div class="px-4 py-4">
        <div class="row">
            <div class="col-md-3">
                <div class="profit-loss-box invoice-stats-progress-1">
                    <div class="">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="m-0">PROFIT AND LOSS</h6>
                            <div class="">
                                <div class="dropdown">
                                    <button onclick="myFunction('myDropdown6')" class="dropbtn prft-los-drp">Last 30 days<i class="right fa fa-fw fa-angle-down ml-1 nav-icon"></i></button>
                                    <div id="myDropdown6" class="dropdown-content prft-los-fltr-bx">
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-success"></i>Last 30 days</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>This month</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>The financial quater</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>This financial year</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last month</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last financial quater</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last financial year</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <h5 class="font-weight-bold m-0">-₹5,54,000</h5>
                        <p>Total Expense</p>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <h6 class="font-weight-bold m-0">-₹5,54,000</h6>
                            <p>Income</p>
                        </div>
                        <div class="col-7">
                            <div class="progress-bar bg-success" role="progressbar" style="height:20px" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h6 class="font-weight-bold m-0">-₹54,000</h6>
                            <p>Income</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="profit-loss-box invoice-stats-progress-1">
                    <div class="">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="m-0">EXPENSES</h6>
                            <div class="">
                                <div class="dropdown">
                                    <button onclick="myFunction('myDropdown7')" class="dropbtn prft-los-drp">Last 30 days<i class="right fa fa-fw fa-angle-down ml-1 nav-icon"></i></button>
                                    <div id="myDropdown7" class="dropdown-content prft-los-fltr-bx">
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-success"></i>Last 30 days</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>This month</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>The financial quater</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>This financial year</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last month</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last financial quater</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last financial year</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <h5 class="font-weight-bold m-0">-₹5,54,000</h5>
                        <p>Total Expenses</p>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <h6 class="font-weight-bold m-0">-₹5,54,000</h6>
                            <p>Bricks</p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <div class="profit-loss-box invoice-stats-progress-1">
                    <div class="">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="m-0">INVOICES</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6 class="font-weight-normal mb-2">₹41545456 <span>365days</span></h6>
                                        <div class="invoice-stats-progress invoice-stats-progress-1">
                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <h6 class="m-0 mb-1">₹54345</h6>
                                                    <p class="m-0 mb-1">Overdue Yet</p>
                                                </div>
                                                <div class="">
                                                    <h6 class="m-0 mb-1">₹4524</h6>
                                                    <p class="m-0 mb-1">Not due yet</p>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <h6 class="font-weight-normal mb-2">₹41545456 <span>365days</span></h6>
                                        <div class="invoice-stats-progress invoice-stats-progress-1">
                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <h6 class="m-0 mb-1">₹424</h6>
                                                    <p class="m-0 mb-1">Not Deposited</p>
                                                </div>
                                                <div class="">
                                                    <h6 class="m-0 mb-1">₹24241</h6>
                                                    <p class="m-0 mb-1">Depositede</p>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="profit-loss-box invoice-stats-progress-1">
                    <div class="">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="m-0">BANK ACCOUNTS</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="">
                                <div class="row">
                                    <div class="col-md-12 border-bottom py-2">
                                        <div class="d-flex justify-content-between">
                                            <p class="m-0 mb-1 font-weight-bold">HDFC Bank 24419</p>
                                            <p class="m-0 mb-1">Needs attention</p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p class="m-0 mb-1 ">Updated 870 days ago</p>
                                            <p class="m-0 mb-1"></p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p class="m-0 mb-1 ">Bank balance</p>
                                            <p class="m-0 mb-1">₹1,72,318.00t</p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p class="m-0 mb-1 ">In QuickBooks</p>
                                            <p class="m-0 mb-1">₹1,72,318.00</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom py-2">
                                        <div class="d-flex justify-content-between">
                                            <p class="m-0 mb-1 font-weight-bold">Cash</p>

                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p class="m-0 mb-1 ">In QuickBooks</p>
                                            <p class="m-0 mb-1">₹1,72,318.00</p>
                                        </div>
                                </div>
                                <div class="col-md-12 border-bottom py-2">
                                    <div class="d-flex justify-content-between">
                                        <p class="m-0 mb-1 font-weight-bold">Cash</p>

                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="m-0 mb-1 ">RBL BANK 11404</p>
                                        <p class="m-0 mb-1">₹1,72,318.00</p>
                                    </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="" class="m-0 text-success font-weight-bold">Connect accounts</a>
                                    <div class="">
                                        <div class="dropdown">
                                            <button onclick="myFunction('myDropdown8')" class="dropbtn prft-los-drp">Last 30 days<i class="right fa fa-fw fa-angle-down ml-1 nav-icon"></i></button>
                                            <div id="myDropdown8" class="dropdown-content prft-los-fltr-bx">
                                              <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-success"></i>Last 30 days</a>
                                              <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>This month</a>
                                              <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>The financial quater</a>
                                              <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>This financial year</a>
                                              <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last month</a>
                                              <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last financial quater</a>
                                              <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last financial year</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-4">
                <div class="profit-loss-box invoice-stats-progress-1">
                    <div class="">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="m-0">SALES</h6>
                            <div class="">
                                <div class="dropdown">
                                    <button onclick="myFunction('myDropdown9')" class="dropbtn prft-los-drp">Last 30 days<i class="right fa fa-fw fa-angle-down ml-1 nav-icon"></i></button>
                                    <div id="myDropdown9" class="dropdown-content prft-los-fltr-bx">
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-success"></i>Last 30 days</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>This month</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>The financial quater</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>This financial year</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last month</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last financial quater</a>
                                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last financial year</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <h5 class="font-weight-bold m-0">-₹5,54,000</h5>
                        <p>Total Expense</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="card-header">
        {{ trans('cruds.invoice.title_singular') }} {{ trans('global.list') }}
    </div>
</div>



<div class="card">
    <div class="bg-white px-4 pt-4">
        <h4>Banking</h4>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="dropdown">
                    <button onclick="myFunction('myDropdown9')" class="dropbtn prft-los-drp f-24">HDFC Bank 154564<i class="right fa fa-fw fa-angle-down ml-1 nav-icon"></i></button>
                    <div id="myDropdown9" class="dropdown-content prft-los-fltr-bx">
                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-success"></i>Last 30 days</a>
                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>This month</a>
                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>The financial quater</a>
                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>This financial year</a>
                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last month</a>
                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last financial quater</a>
                      <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last financial year</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-right">
                    <div class="btn-group">
                        <a href="http://127.0.0.1:8000/invoices/create"><button type="button" class="btn btn-success">Link Account</button></a>
                        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
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
            </div>
        </div>
    </div>




    <div class="px-4 py-4">
        <div class="row">
            <div class="col-md-3">
                <div class="bank-info-box">
                    <div class="bank-info-box-top">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="m-0">HDFC Bank 15454</h6>
                            <div class="">
                                <i class="right fa fa-fw fa-pen ml-1 nav-icon"></i>
                            </div>
                        </div>
                        <div class="">
                           <h5 class="font-weight-bold m-0">₹5,54,000</h5>
                           <div class="d-flex justify-content-between">
                            <p>Bank Balance</p>
                            <p>Update on 15-02-2022</p>
                           </div>

                       </div>
                    </div>
                    <div class="bank-info-box-bot">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <h5 class="font-weight-bold m-0">₹5,54,000</h5>
                                <p class="m-0">In Quickbook</p>
                            </div>
                             <i class="right fa fa-fw fa-info-circle nav-icon"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="px-4 pb-3 bg-white d-flex justify-content-between align-items-center">
        <div class="d-flex">
              <div class="dropdown">
                <button onclick="myFunction('myDropdown2')" class="dropbtn">Batch Action</button>
                <div id="myDropdown2" class="dropdown-content" style="">
                    <form>
                        <div class="form-row align-items-center">
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
                        </div>
                        <button type="submit" class="btn btn-light mr-3">Reset</button>
                        <button type="submit" class="btn btn-primary">Apply</button>
                      </form>
                </div>
              </div>
              <div class="dropdown ml-3">
                <button onclick="myFunction('myDropdown10')" class="dropbtn">All transactions (40)<i class="right fa fa-fw fa-angle-down ml-1 nav-icon"></i></button>
                <div id="myDropdown10" class="dropdown-content prft-los-fltr-bx">
                  <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-success"></i>Last 30 days</a>
                  <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>This month</a>
                  <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>The financial quater</a>
                  <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>This financial year</a>
                  <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last month</a>
                  <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last financial quater</a>
                  <a href="#"><i class="right fa fa-fw fa-check mr-1 nav-icon text-white"></i>Last financial year</a>
                </div>
            </div>
            <div class="ml-3">
                <div class="form-group">
                    <input type="text" class="form-control" id="inputZip" placeholder="search" style="min-width: 300px">
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




    <div class="card-header">
        {{ trans('cruds.invoice.title_singular') }} {{ trans('global.list') }}
    </div>
</div>




@endsection
@section('scripts')
@parent
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
