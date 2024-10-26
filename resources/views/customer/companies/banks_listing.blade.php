<div class="row mt-2">
    @if($bank_details == '')
    @else
    @foreach ($bank_details as $bank_detail)
    <div class="col-md-4 mt-4">
        <div class="card" style="box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2)">
            <div class="card-content">
                <div class="card-body">
                    <div class="d-flex justify-content-between font-weight-bolder ">
                        <p style="color: #211b73"><b>* {{ isset($bank_detail->bank_name) ? $bank_detail->bank_name : '' }}</b></p>
                        <div>
                            <i style="color:#211b73" class="bi bi-pencil-fill edit_bank" bank_id="{{ isset($bank_detail->id) ? $bank_detail->id : '' }}"></i>
                            <i style="color:#211b73; margin-left: 5px;" class="bi bi-trash delete_bank" bank_id="{{ isset($bank_detail->id) ? $bank_detail->id : '' }}"></i>
                        </div>
                    </div>
                    <table class="borderless w-100">
                        <tr>
                            <td>Bank Name -</td>
                            <td class="text-right" style="color:#211b73"><b>{{ isset($bank_detail->bank_name) ? $bank_detail->bank_name : '' }}</b></td>
                        </tr>
                        <tr>
                            <td>Account Holder Name</td>
                            <td class="text-right" style="color:#211b73"><b>{{ isset($bank_detail->account_holder_name) ? $bank_detail->account_holder_name : '' }}</b></td> 
                        </tr>
                        <tr>
                            <td>Account Number</td>
                            <td class="text-right" style="color:#211b73"><b>{{ isset($bank_detail->account_no) ? $bank_detail->account_no : '' }}</b></td>
                            
                        </tr>
                        <tr>
                            <td>IFSC Code</td>
                            <td class="text-right" style="color:#211b73"><b>{{ isset($bank_detail->ifsc_code) ? $bank_detail->ifsc_code : '' }}</b></td> 
                        </tr>
                        <tr>
                            <td>Branch Name</td>
                            <td class="text-right" style="color:#211b73"><b>{{ isset($bank_detail->branch_name) ? $bank_detail->branch_name : '' }}</b></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>