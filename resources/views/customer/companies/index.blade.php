@extends('layouts.customer')
@section('content')
@can('company_create')
    <div style="margin-bottom: 20px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="{{ route('admin.companies.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.company.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Company', 'route' => 'admin.companies.parseCsvImport'])
        </div>
    </div>
@endcan

<!-- <div class="company-list-bg">
    <div class="row">
        <div class="col-md-3">
            <div class="company-list-box">
                <div class="company-list-logo">
                    <img class="img-fluid" src="{{asset('img/hdfc.svg')}}" width="" alt="razorpay">
                </div>
                <h2>HDFC Bank</h2>
                <h3>Gstin: <span>56465451321</span></h3>
                <h3>City: <span>56465451321</span></h3>
                <h3 class="mb-3">State: <span>56465451321</span></h3>
                <a class="company-lis-view-btn" href="">View Details</a>
                <a class="company-lis-edit-btn" href="">Edit or Delete</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="company-list-box">
                <div class="company-list-logo">
                    <img class="img-fluid" src="{{asset('img/hdfc.svg')}}" width="" alt="razorpay">
                </div>
                <h2>HDFC Bank</h2>
                <h3>Gstin: <span>56465451321</span></h3>
                <h3>City: <span>56465451321</span></h3>
                <h3 class="mb-3">State: <span>56465451321</span></h3>
                <a class="company-lis-view-btn" href="">View Details</a>
                <a class="company-lis-edit-btn" href="">Edit or Delete</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="company-list-box">
                <div class="company-list-logo">
                    <img class="img-fluid" src="{{asset('img/hdfc.svg')}}" width="" alt="razorpay">
                </div>
                <h2>HDFC Bank</h2>
                <h3>Gstin: <span>56465451321</span></h3>
                <h3>City: <span>56465451321</span></h3>
                <h3 class="mb-3">State: <span>56465451321</span></h3>
                  <a class="company-lis-view-btn" href="">View Details</a>
                <a class="company-lis-edit-btn" href="">Edit or Delete</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="company-list-box">
                <div class="company-list-logo">
                    <img class="img-fluid" src="{{asset('img/hdfc.svg')}}" width="" alt="razorpay">
                </div>
                <h2>HDFC Bank</h2>
                <h3>Gstin: <span>56465451321</span></h3>
                <h3>City: <span>56465451321</span></h3>
                <h3 class="mb-3">State: <span>56465451321</span></h3>
                  <a class="company-lis-view-btn" href="">View Details</a>
                <a class="company-lis-edit-btn" href="">Edit or Delete</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="company-list-box">
                <div class="company-list-logo">
                    <img class="img-fluid" src="{{asset('img/hdfc.svg')}}" width="" alt="razorpay">
                </div>
                <h2>HDFC Bank</h2>
                <h3>Gstin: <span>56465451321</span></h3>
                <h3>City: <span>56465451321</span></h3>
                <h3 class="mb-3">State: <span>56465451321</span></h3>
                  <a class="company-lis-view-btn" href="">View Details</a>
                <a class="company-lis-edit-btn" href="">Edit or Delete</a>
            </div>
        </div>
    </div>
</div> -->



<div class="company-details-bg">
    <h6 class="mb-4">Company Details</h6>
    <div class="row justify-content-between border-bottom pb-4 align-items-center">
        <div class="col-md-4">
            <div class="company-details-box">
                <div class="company-list-detail-logo">
                    <img class="img-fluid" src="{{ $company->company_logo->url ?? ''}}" width="" alt="">
                </div>
                <h4>{{ isset($company->company_name) ? $company->company_name : '' }}</h4>
            </div>
        </div>
        <div class="col-4 text-right">
            <a class="font-weight-bold text-theme" href=""> <i class="fa fa-reply"></i> Back to List</a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Gstin</h4>
                <h5>{{ isset($company->gstin) ? $company->gstin : '' }}</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Address Line 1</h4>
                <div class="">
                    <h5>{{ isset($company->address_line_1) ? $company->address_line_1 : '' }} ,</h5>
                    <h5>{{ isset($company->address_line_2) ? $company->address_line_2 : '' }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="company-details-box-info">
                <h4>City</h4>
                <h5>{{ isset($company->city->name) ? $company->city->name : '' }}</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="company-details-box-info">
                <h4>State</h4>
                <h5>{{ isset($company->state->state) ? $company->state->state : '' }}</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Copy Of Pan Tan</h4>
                <h5>24AAACC4175D1Z4</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Gst Certificate</h4>
                <h5>24AAACC4175D1Z4</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Vat Certficate</h4>
                <h5>24AAACC4175D1Z4</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Username For Pan Tan</h4>
                <h5>{{ isset($company->username_for_pan_tan) ? $company->username_for_pan_tan : '' }}</h5>
            </div>
        </div>
        {{--<div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Password For Pan Tan</h4>
                <h5>{{ $company->password_for_pan_tan == null ? '' : $company->password_for_pan_tan }}</h5>
            </div>
        </div>--}}
        <div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Username For Gst Vat Icegate Dgft</h4>
                <h5>{{ isset($company->username_for_gst_vat_icegate_dgft) ? $company->username_for_gst_vat_icegate_dgft : '' }}</h5>
            </div>
        </div>
        {{--<div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Password For Gst Vat Icegate Dgft</h4>
                <h5>{{ $company->password_for_gst_vat_icegate_dgft == null ? '' : $company->password_for_gst_vat_icegate_dgft }}</h5>
            </div>
        </div>--}}
        <div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Username For E Way E Invoicing</h4>
                <h5>{{ isset($company->username_for_e_way_e_invoicing) ? $company->username_for_e_way_e_invoicing : '' }}</h5>
            </div>
        </div>
        {{--<div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Password For E Way E Invoicing</h4>
                <h5>{{ $company->password_for_e_way_e_invoicing == null ? '' : $company->password_for_e_way_e_invoicing}}</h5>
            </div>
        </div>--}}
        <div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Username For Traces</h4>
                <h5>{{ isset($company->username_for_traces) ? $company->username_for_traces : '' }}</h5>
            </div>
        </div>
        {{--<div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Password For Traces</h4>
                <h5>{{ $company->password_for_traces == null ? '' : $company->password_for_traces }}</h5>
            </div>
        </div>--}}
        <div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Username For Pf Esi And Other Labour Law</h4>
                <h5>{{ isset($company->username_for_pf_esi_and_other_labour_law) ? $company->username_for_pf_esi_and_other_labour_law : '' }}</h5>
            </div>
        </div>
        {{--<div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Password For Pf Esi And Other Labour Law</h4>
                <h5>{{ $company->password_for_pf_esi_and_other_labour_law == null ? '' : $company->password_for_pf_esi_and_other_labour_law }}</h5>
            </div>
        </div>--}}
        <div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Username For Reporting Portal</h4>
                <h5>{{ isset($company->username_for_reporting_portal) ? $company->username_for_reporting_portal : '' }}</h5>
            </div>
        </div>
        {{--<div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Password For Reporting Portal</h4>
                <h5>{{ $company->password_for_reporting_portal == null ? '' : $company->password_for_reporting_portal }}</h5>
            </div>
        </div>--}}
        <div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Msme Registration Certificate</h4>
                <h5>24AAACC4175D1Z4</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Shop Establishment Certificate</h4>
                <h5>24AAACC4175D1Z4</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="company-details-box-info">
                <h4>Address Proof</h4>
                <h5>24AAACC4175D1Z4</h5>
            </div>
        </div>
    </div>
    <!-- <div class="">
        <a class="company-lis-edit-btn" href="">Delete Company</a>
    </div> -->
</div>
<br>
<div class="company-details-bg">
    <h6 class="mb-4">Bank Details</h6>
    <div class="row justify-content-between border-bottom pb-4 align-items-center">
        @if($banks == '')
        <div class="col-md-4">
            <p style="color: red;"><b>***No Bank Add! Please Add New Bank***</b></p>
        </div>
        @else
        <div class="d-flex col-md-5">
            <label class="required" for="set_default_bank">Set Default Bank:</label>
            @if($company->bank == '')
                <input class="form-control" type="text" id="set_default_bank" style="color: #211b73" value="Please! Set Default Bank by Edit the Bank-Details" readonly>
            @else
                <input class="form-control" type="text" id="set_default_bank" style="color: #211b73" value="{{$company->bank->bank_name}}" readonly>
            @endif
        </div>
        @endif
        <div class="col-4 text-right">
            <a id="add_bank" class="font-weight-bolder text-theme" href="#"><i class="fa fa-plus"></i>Add Bank</a>
        </div>
    </div>
    <div id="listing_of_banks">
        <input type="hidden" id="comp_id" value="{{isset($company->id) ? $company->id : ''}}">
    </div>
</div>

<!-- Add Bank Details Modal -->
<div class="modal fade" id="addBankDetailsModel" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Add Bank Details</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="" action="" enctype="multipart/form-data">
                    <input type="hidden" id="comp_id" value="{{isset($company->id) ? $company->id : ''}}">
                    <div class="form-group">
                        <label for="bank_name" label="Name">Bank Name</label>
                        <input class="form-control" type="text" id="bank_name" placeholder="Enter your Bank Name" width="100%">
                    </div>
                    <div class="form-group">
                        <label for="account_holder_name" label="Name">Account Holder Name</label>
                        <input class="form-control" type="text" id="account_holder_name" placeholder="Enter your Account Holder Name" width="100%">
                    </div>
                    <div class="form-group">
                        <label for="account_no" label="Name">Account Number</label>
                        <input class="form-control" type="number" id="account_no" placeholder="Enter your Account Number" width="100%">
                    </div> <div class="form-group">
                        <label for="ifsc_code" label="Name">IFSC Code</label>
                        <input class="form-control" type="text" id="ifsc_code" placeholder="Enter your IFSC Code" width="100%">
                    </div> <div class="form-group">
                        <label for="branch_name" label="Name">Branch Name/Address</label>
                        <input class="form-control" type="text" id="branch_name" placeholder="Enter your Branch Name/Address" width="100%">
                    </div>
                </form>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="submit" id="bank_save" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Bank Details Modal -->
<div class="modal fade" id="editBankDetailsModel" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Edit Bank Details</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="" action="" enctype="multipart/form-data">
                    <input type="hidden" id="comp_id" value="{{isset($company->id) ? $company->id : ''}}">
                    <input type="hidden" id="edit_bank_id">
                    <div class="form-group">
                        <label for="edit_bank_name" label="Name">Bank Name</label>
                        <input class="form-control" type="text" id="edit_bank_name" placeholder="Enter your Bank Name" width="100%">
                    </div>
                    <div class="form-group">
                        <label for="edit_account_holder_name" label="Name">Account Holder Name</label>
                        <input class="form-control" type="text" id="edit_account_holder_name" placeholder="Enter your Account Holder Name" width="100%">
                    </div>
                    <div class="form-group">
                        <label for="edit_account_no" label="Name">Account Number</label>
                        <input class="form-control" type="number" id="edit_account_no" placeholder="Enter your Account Number" width="100%">
                    </div> <div class="form-group">
                        <label for="edit_ifsc_code" label="Name">IFSC Code</label>
                        <input class="form-control" type="text" id="edit_ifsc_code" placeholder="Enter your IFSC Code" width="100%">
                    </div> <div class="form-group">
                        <label for="edit_branch_name" label="Name">Branch Name/Address</label>
                        <input class="form-control" type="text" id="edit_branch_name" placeholder="Enter your Branch Name/Address" width="100%">
                    </div>
                    <div class="form-group" style="margin-left: 20px;">
                        <input class="form-check-input" type="checkbox" name="default_bank" id="default_bank" value="1" {{ old('default_bank', 1) == 0 ? 'checked' : '' }}>
                        <label class="form-check-label"  for="default_bank">
                            Set as Default Bank
                        </label>
                    </div>
                </div> 
                </form>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="submit" id="edit_bank_save" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
   $(document).ready(function() {
        $.ajax({
            url: "{{ route('customer.bank-details.index') }}",
            type: 'get',
            data: {
                'company_id': $('#comp_id').val(),
            },
            success: function(data) {
               if(data.length != 0){
                  $('#listing_of_banks').html(data);
               } 
            },
            error: function(error) {
                console.log(error, 'err');
                alert("Error occured");
            }

        });
   });

   $(document).on('click', '#add_bank', function(){
        $("#addBankDetailsModel").modal('show');
   });

   $(document).on('click', '#bank_save', function(){
        $("#addBankDetailsModel").modal('hide');
        var company_id = $("#comp_id").val();
        var bank_name = $("#bank_name").val();
        var account_holder_name = $("#account_holder_name").val();
        var account_no = $("#account_no").val();
        var ifsc_code = $("#ifsc_code").val();
        var branch_name = $("#branch_name").val();
        $.ajax({
            url: "{{ route('customer.bank-details.store') }}",
            type: 'post',
            data: {
                'company_id': company_id,
                'bank_name': bank_name,
                'account_holder_name': account_holder_name,
                'account_no': account_no,
                'ifsc_code': ifsc_code,
                'branch_name': branch_name,
                '_token': $('input[name="_token"]').val(),
            },
            success: function(data) {
               if(data.length != 0){
                  console.log(data);
                  window.location.reload();
                  sweetAlert('Thanks!','Bank-Details Added Successfully..','success');
               } 
            },
            error: function(error) {
                console.log(error, 'err');
                alert("Error occured");
            }  
        });
   });
   
   $(document).on('click', '.edit_bank', function(){
        var edit_bank_id = $(this).attr('bank_id');
        var edit_bank_url = "{{ env('APP_URL') }}" + "/customer/bank-details/" + edit_bank_id + "/edit";
        $.ajax({
            url: edit_bank_url,
            type: 'get',
            data: {},
            success: function(data) {
               if(data.length != 0){
                console.log(data);
                $("#edit_bank_id").val(data.id);
                $("#edit_bank_name").val(data.bank_name);
                $("#edit_account_holder_name").val(data.account_holder_name);
                $("#edit_account_no").val(data.account_no);
                $("#edit_ifsc_code").val(data.ifsc_code);
                $("#edit_branch_name").val(data.branch_name);
                if(data.set_as_default == 1){
                    $('#default_bank').attr('checked',true);
                }else{
                    $('#default_bank').attr('checked',false);
                }
                $("#editBankDetailsModel").modal('show');
               } 
            },
            error: function(error) {
                console.log(error, 'err');
                alert("Error occured");
            }

        });
   });

   $(document).on('click', '#edit_bank_save', function(){
        var company_id = $("#comp_id").val();
        var edit_bank_id = $("#edit_bank_id").val();
        var edit_bank_name = $("#edit_bank_name").val();
        var edit_account_holder_name = $("#edit_account_holder_name").val();
        var edit_account_no = $("#edit_account_no").val();
        var edit_ifsc_code = $("#edit_ifsc_code").val();
        var edit_branch_name = $("#edit_branch_name").val();
        if($('#default_bank').is(':checked')){
            var default_bank = 1; 
        }else{
            var default_bank = 0; 
        }
        var update_bank_url = "{{ env('APP_URL') }}" + "/customer/bank-details/" + edit_bank_id;
        $.ajax({
            url: update_bank_url,
            type: 'put',
            data: {
                'company_id': company_id,
                'bank_name': edit_bank_name,
                'account_holder_name': edit_account_holder_name,
                'account_no': edit_account_no,
                'ifsc_code': edit_ifsc_code,
                'branch_name': edit_branch_name,
                'set_as_default': default_bank,
                '_token': $('input[name="_token"]').val(),
            },
            success: function(data) {
               if(data.length != 0){
                  console.log(data);
                  window.location.reload();
                  sweetAlert('Thanks..','Bank Details Successfully Updated!','success');
               } 
            },
            error: function(error) {
                console.log(error, 'err');
                alert("Error occured");
            }
        });
   });
   
   $(document).on('click', '.delete_bank', function(){
        var remove_bank_id = $(this).attr('bank_id');
        var remove_bank_url = "{{ env('APP_URL') }}" + "/customer/bank-details/" + remove_bank_id;
        swal({
            title: "Are you sure?",
            text: "You want to remove this Bank Details!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Remove it!",
            cancelButtonText: "No, Cancel plz!",
            closeOnConfirm: false,
            closeOnCancel: true
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url: remove_bank_url,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {},
                    success: function(data) {
                        console.log(data);
                        window.location.reload();
                        swal("Deleted!", "Your Selected Bank-Details has been deleted.", "success");
                    },
                    error: function(error) {
                        console.log(error, 'err');
                        alert("Error occured");
                    }
                });   
            } else {
                swal("Cancelled", "Your Bank-Details is safe :)", "error");
            }
        });
   });
</script>
@endsection
