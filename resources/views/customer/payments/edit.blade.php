@extends('layouts.customer')
@section('content')

<form  method="POST" action="{{route('customer.payments.destroy',[$payment->id])}}" enctype="multipart/form-data" class="customer_info_form">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="invoice-add">
        <h2 class="font-weight-bold my-3">Clear Payment</h2>
        <div class="invoice-upper">
            
        <div class="row">

            <div class="col-md-3">

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
            <div class="col-md-3">
                <div class="form-group ">
                <label class="">Total Amount</label>
                <h1 class="text-success" id="total_amount" name="total_amount">&#x20B9;{{ $invoices->total_payable_amount}}</h1>
                </div>
             </div>
        </div>
            {{-- <div class="dropdown">
                @if(isset($recieve_amount_date->created_at))
                <button class="btn btn-success">{{$recieve_amount_details}} Payments made on {{$recieve_amount_date->created_at}}</button>
                <div class="dropdown-content">
                    <label for="customer_name">&nbsp; &nbsp; &nbsp;Date</label>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;<label for="customer_name">Amount Applied</label></br>
                    @foreach ($collection as $item)
                 <a href="{{route('customer.payments.destroy',$invoices)}}">&nbsp; &nbsp; &nbsp;{{$item->created_at}}</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<label>₹{{$item->received_amount}}</a></br>
                @endforeach
                </div>
                @else
                <button class="btn btn-danger">Not Payments made yet</button>
                
                @endif
              </div> --}}
    
        <div class="row mt-4">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="invoice_date">Payment Date</label>
                        <input class="form-control" type="date" name="payment_date" id="payment_date" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
        </div>
        </div>
        <div class="row">

            <div class="col-md-3">

                <div class="form-group">
                    <label for="payment_method">Payment method</label>
                    <select id="payment_method" name="payment_method" class="form-control py-0 payment_method" required>                   
                        <option >{{$payment->payment_method}}</option>
                        <option>Credit card</option>
                        <option>Net-banking</option>
                    </select>
                </div>
             </div>
             <div class="col-md-3">
                <div class="form-group">
                <label for="number">Reference no.</label>
                <input type="number" class="form-control" id="reference_no" name="reference_no" value="{{$payment->reference_no}}">
                </div>
              </div>

              <div class="col-md-3">

                <div class="form-group">
                    <label for="deposit_to">Deposit To</label>
                    <select id="deposit_to" name="deposit_to" class="form-control py-0 deposit_to" required>
                        <option>{{$payment->deposit_to}}</option>
                        <option>Credit card</option>
                        <option>Net-banking</option>
                    </select>
                    
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                <label for="">Recieved Amount</label>
                <h3 class="text-warning">&#x20B9;<span id="amount_received" name="input" >{{$payment->received_amount}}</span></h3>
                </div>
            </div>
            
        </div>
    </div>
        <table class="table" id="product_table">
            <h2 class="font-weight-bold my-3">Outstanding Transactions</h2>
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
            <td><input type="text" class="form-control rate" id="payment" name="payment"  placeholder="0.00"  value="{{$payment->received_amount}}"></td>

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
            <input type= "submit" class="btn btn-success" value= "Clear Payment" onclick= "clearInput()">
            {{-- <button class="update_payment btn btn-success" style="background-color: green" payment_id="{{$payment->id}}">Update Payment</button> --}}
            <input type="button" class="update_payment btn btn-success" style="background-color: green" payment_id="{{$payment->id}}" value="Update Payment">
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
   
//  function ClearP(){
//     var inputs = document.getElementsById("payment");
//     for(var i=0;i<inputs.length;i++)
//         inputs[i].value = '';
// } 
function clearInput(){
      var getValue= document.getElementById("payment");
      
        if (getValue.value !="") {
            getValue.value = "";
            document.getElementById('amount_to_apply').innerHTML = '0.00';
            document.getElementById('amount_to_credit').innerHTML = '0.00';  
            document.getElementById('amount_received').innerHTML = '0.00';  


        }
 }

 $('.update_payment').click( function(){
    var payment_id =  $(this).attr("payment_id"); 
    var invoice_id = $('#invoice_id').val();
    var customer_id = $('#customer_id').val();
    var payment_amount = $('#payment').val();
    var data = $('.customer_info_form').serialize();
    $.ajax({
        url: "{{ route('customer.payment.update-payment') }}",
        type: "post",
        data: {
        'payment_id': payment_id,
        'invoice_id': invoice_id,
        'customer_id': customer_id,
        'payment_amount': payment_amount,
        '_token': $('input[name="_token"]').val(),
        'data': data,
        },

        success: function(data) {
            sweetAlert("Thanks", "Invoice Payment Successfully Updated!", "success");
            
        },
        error: function(error) {
            console.log(error, 'err');
        }
    })
              

 })
</script>

@endsection