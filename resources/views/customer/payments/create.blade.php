@extends('layouts.customer')
@section('content')

<form method="POST" action="{{ route("customer.payments.store") }}" enctype="multipart/form-data">
    @csrf
    <div class="invoice-add">
        <h2 class="font-weight-bold mb-3">Recieve Payment</h2>
        <div class="invoice-upper">
            
        <div class="row">

            <div class="col-md-3">

                <input type="hidden" name="company_id" id="company_id" value="{{$invoices->company_id}}">
                <input class="form-check-input" type="hidden" id="invoice_id" name="invoice_id" value="{{$invoices->id}}">
                <input class="form-check-input" type="hidden" id="customer_id" name="customer_id" value="{{$customer_details->id}}">
                <div class="form-group">
                    <label for="customer_name">Customer Name</label>
                    <input type="text" class="form-control" name="customer_name" id="customer_name" value="{{$customer_name}}"readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                <label for="email">Customer email</label>
                <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{$customer_details->email}}"readonly>
                </div>
            </div>
            <div class="col-md-2">
               <div class="form-group ">
                <label class="">Total Amount</label>
                <h3 class="text-success" id="total_amount" name="total_amount">&#x20B9;{{ $invoices->total_payable_amount}}</h3>
                </div>
            </div>
             <div class="col-md-4">
                <div class="dropdown position-relative">
                    @if(isset($recieve_amount_date->created_at))
                    <button class="btn btn-success">{{$recieve_amount_details}} Payments made on {{$recieve_amount_date->created_at}}</button>
                    <div class="dropdown-content">
                        <label class="label_space" for="customer_name">Date</label><label class="label_space" for="customer_name"> Recieved Amount</label><br>
                        @foreach ($collection as $item)
                     <span class="d-flex justify-content-between">
                        <a href="{{route('customer.payments.edit',$item->id)}}"> {{$item->created_at}}</label> &nbsp; &nbsp; &nbsp; &nbsp;₹{{$item->received_amount}}</a>
                        <i class="cancel_recieved bi bi-x-circle-fill" style="margin-right:10px " payment_id="{{$item->id}}"></i>
                    </span>   
                    
                    @endforeach
                    </div>
                    @else
                    <button class="btn btn-success">Not Payments made yet</button>
                    
                    @endif
                </div>
             </div>
        </div>
           
    
        <div class="row mt-2">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="invoice_date">Payment Date</label>
                        <input  class="form-control" type="date" name="payment_date" id="payment_date" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
        </div>
        </div>
        <div class="row">

            <div class="col-md-3">

                <div class="form-group">
                    <label for="payment_method">Payment method</label>
                    <select id="payment_method" name="payment_method" class="form-control py-0 payment_method" required>                   
                        <option>Please Select Method</option>
                        <option>Online</option>
                        <option>Credit card</option>
                        <option>Net-banking</option>
                    </select>
                </div>
             </div>
             <div class="col-md-3">
                <div class="form-group">
                <label for="number">Reference no.</label>
                <input type="number" class="form-control" id="reference_no" name="reference_no" required>
                </div>
              </div>

              <div class="col-md-3">

                <div class="form-group">
                    <label for="deposit_to">Deposit To</label>
                    <select id="deposit_to" name="deposit_to" class="form-control py-0 deposit_to" required>
                        <option>Please Select</option>
                        <option>Online</option>
                        <option>Credit card</option>
                        <option>Net-banking</option>
                    </select>
                    
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                <label for="">Unpaid Amount</label>
                <h3 class="text-warning">&#x20B9;<span id="amount_received" name="amount_received">{{$invoices->remaining_payable_amount}}</span></h3>
                </div>
            </div>
            
        </div>
    </div>
        <table class="table" id="product_table">
            <h2 class="font-weight-bold mb-3">Outstanding Transactions</h2>
        <thead>
            <tr>
            {{-- <th scope="col">#</th> --}}
            
            <th scope="col">DESCRIPTION</th>
            <th scope="col">DUE DATE</th>
            <th scope="col">INVOICE AMOUNT</th>
            <th scope="col">OPEN BALANCE</th>
            <th scope="col">PAYMENT RECEIVING</th>
            </tr>
        </thead>
        <tbody>
            <tr data-index="1">
            {{-- <th scope="row">1</th> --}}
            
            <td><input type="text" class="form-control" id="description" name="description" value="Invoive #{{$invoices->invoice_no}} ({{$invoices->invoice_date}})" readonly></td>
            <td> <input type="date" class="form-control" id="due_date" name="due_date" value="{{$invoices->due_date}}"></td>
            <td><input type="text" class="form-control" id="original_amount" name="original_amount" value="{{$invoices->total_payable_amount}}" readonly></td>
            <td><input type="text" class="form-control" id="open_balance" name="open_balance"  value="{{$invoices->remaining_payable_amount}}" readonly></td>
            <td><input type="text" class="form-control rate" id="payment" name="payment" placeholder="0.00"  value="{{$invoices->remaining_payable_amount}}"></td>

            </tr>
        </tbody>
        </table>

        <div class="row justify-content-between">
        <div class="col-6">
          
        </div>

        <div class="col-3">
            <table class="table table-borderless" id="total_table">
            <thead>
                <tr>
                <th scope="col">Amount to apply</th>
                <th scope="col" class="text-right subtotal">&#x20B9;<span id="amount_to_apply"></span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">Amount to credit</th>
                <th scope="col" class="text-right subtotal">&#x20B9;<span id="amount_to_credit"></span></th>
                </tr>
            </tbody>
            </table>
            
        </div>
        </div>
        <div class="text-right pb-3 mt-5">
            <button type="submit" class="btn btn-success">Save/Pay</button>
            <button type="submit" class="btn btn-danger">Cancel</button>
        </div>

    </div>
</form>

@endsection
@section('scripts')
<script>
    $('document').ready(function(){
        var receiving_amount = document.getElementById('payment').value;
        document.getElementById('amount_to_apply').innerHTML = receiving_amount;
        document.getElementById('amount_to_credit').innerHTML = receiving_amount;  
    });
    $('#payment').change(function(){
        var receiving_amount = document.getElementById('payment').value;
        document.getElementById('amount_to_apply').innerHTML = receiving_amount;
        document.getElementById('amount_to_credit').innerHTML = receiving_amount;
    });
    $('.cancel_recieved').click( function(){
        var payment_id =  $(this).attr("payment_id"); 
            swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: true
            },
            function(isConfirm){
            if (isConfirm) {
                swal("Deleted!", "Your invoice payment has been deleted.", "success");
            } else {
                swal("Cancelled", "Your invoice payment is safe :)", "error");
            }
            });

            $(document).on('click','.confirm',function(){
               $.ajax({
                        url: "{{ route('customer.payment.delete-payment') }}",
                        type: "get",
                        data: {
                            'payment_id': payment_id
                        },
                        success: function(data) {
                            window.location.reload();
                        },
                        error: function(error) {
                            console.log(error, 'err');
                            // alert("Error occured");
                        }
                    })
            })


    })

    
</script>
@endsection