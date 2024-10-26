<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Invoice</title>
    <style>
     @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap');
     @page{margin: 0em;padding: 10px;font-family: 'Open Sans', sans-serif;}
     @page{margin: 20px 20px 0 20px; size: letter; font-family: 'Open Sans', sans-serif;}
    .tg{border-collapse:collapse;border-spacing:0;}
    .tg-0lax{
      padding: 5px 5px !important;
      font-size: 12px !important;
    }
    td{
      padding: 5px 5px !important;
      font-size: 12px !important;
    }
    .tg td{border-color:rgb(5, 5, 5);border-style:solid;border-width:1px;font-family: 'Open Sans', sans-serif;font-size:13px;overflow:hidden;padding:1px 5px;word-break:normal;}
    .tg th{border-color:rgb(5, 5, 5);border-style:solid;border-width:1px;font-family: 'Open Sans', sans-serif;font-size:13px;font-weight:bold;overflow:hidden;padding:1px 5px;word-break:normal;}
    .tg .tg-0lax{text-align:left;vertical-align:top}
    th{
      padding: 5px 5px !important;
      font-size: 12px;
    }
    </style>
</head>
  <body>
<div class="bg-white">
  <h2 style="text-align: center; margin-bottom:20px; font-size:18px;font-family: 'Open Sans', sans-serif; font-weight:400">Tax Invoice</h2>
  <table class="table bg-white table-bordered" style="">
      <thead>
        <tr>
          <td class="tg-0lax" rowspan="3" style="width: 50%;" style="font-size: 15px !important">
           <b>{{$company->company_name}}</b>  <br>
              {{$company->address_line_1}}
              {{$company->address_line_2}}<br>
              GSTIN/UIN: {{$company->gstin}}<br>
              State Name : {{$company->state->state}}<br> Code :{{explode(',',$company->address_line_2)[3]}}
              {{-- CIN: U72900DL2019PTC344984 --}}
          </td>
          <td class="tg-0lax" style="width: 25%">
            Invoice No. <br>
           <b>{{$invoice->invoice_no}}</b>
          </td>
          <td class="tg-0lax" style="width: 25%">
            Dated <br>
           <b>{{$invoice->invoice_date}}</b>
          </td>
        </tr>
        <tr>
          <td class="tg-0lax">
            Delivery Note

          </td>
          <td class="tg-0lax" style="width: 25%">
            Mode/Terms of Payment<br>
            <b>{{$invoice->customer->payment_method}}</b>
          </td>
        </tr>
        <tr>
          <td class="tg-0lax">
            Supplier’s Ref. <br>
           <b>2022-23/04</b>
          </td>
          <td class="tg-0lax">
            Other Reference(s)
          </td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="tg-0lax" rowspan="4" style="font-size: 15px !important">
           <b>{{$invoice->customer->company}}</b> <br>
            APPINCUBA TECHNOLOGIES PRIVATE LIMITED
            3/1 BLOCK-A , VILLAGE SHALIMAR
            GSTIN/UIN: 07AARCA8415B1ZQ
            State Name : , Code :
            CIN: U72900DL2019PTC344984
          </td>
          <td class="tg-0lax">
            Buyer’s Order No.
          </td>
          <td class="tg-0lax">
            Dated
          </td>
        </tr>
        <tr>
          <td class="tg-0lax">
            Despatch Document No
          </td>
          <td class="tg-0lax">
            Delivery Note Date
          </td>
        </tr>
        <tr>
          <td class="tg-0lax">
            Despatched through
          </td>
          <td class="tg-0lax">
            Destination
          </td>
        </tr>
        <tr>
          <td class="tg-0lax" colspan="2">
            Terms of Delivery
          </td>
        </tr>
      </tbody>
      </table>

      <table class="table" style="">
        <thead>
          <tr>
            <th scope="col">S.No.</th>
            <th scope="col">Particulars</th>
            <th scope="col" style="text-align: center">HSN/SAC</th>
            <th scope="col" style="text-align: center">Quantity</th>
            <th scope="col" style="text-align: center">Rate</th>
            <th scope="col" style="text-align: center">Per</th>
            <th scope="col" style="text-align: right">Amount</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($invoiceDetail as $products)
            <tr>
                <th scope="row">1</th>
                <td>{{$products->product->name}}</td>
                <td style="text-align: center">{{$products->product->hsn}}</td>
                <td style="text-align: center">{{$products->qty}}</td>
                <td style="text-align: center">{{$products->rate}}</td>
                <td style="text-align: center">1</td>
                <td style="text-align: right">{{$products->amount}}</td>
            </tr>
            @endforeach


          <tr>
            <th scope="row"></th>
            <td style="text-align: right"><b>Total</b> </td>
            <td style="text-align: center">-</td>
            <td style="text-align: center">-</td>
            <td style="text-align: center">-</td>
            <td style="text-align: center">-</td>
            <td style="text-align: right">{{$total_amount}}</td>
          </tr>
        </tbody>
      </table>

      <table class="table table-borderless" style="">
        <thead>
          <tr>
            <th scope="col">Amount Chargeable (in words) </th>
            <th scope="col">E. & O.E</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" rowspan="2" style="font-size: 15px">{{ucwords($amount_in_words).' Only'}}
            </th>
          </tr>
        </tbody>
      </table>
      <table class="tg" border="1" cellpadding="0" style="width:100%">
        <thead>
          <tr>
            <th class="tg-0lax" rowspan="2" style="width: 50%;text-align:center">HSN/SAC</th>
            <th class="tg-0lax" rowspan="2" style="width: 20%;text-align:center;padding:1px 5px !important">Taxable Value</th>
            <th class="tg-0lax" colspan="2" style="width: 10%;text-align:center;padding:1px 5px !important">Integrated Tax</th>
            <th class="tg-0lax" rowspan="2" style="width: 10%;text-align:center;padding:1px 5px !important">Total Tax Amount</th>
          </tr>
          <tr>
            <th class="tg-0lax" style=";text-align:center;padding:1px 5px !important">Rate</th>
            <th class="tg-0lax" style=";text-align:center;padding:1px 5px !important">Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="tg-0lax">98314</td>
            <td class="tg-0lax" style="text-align: center">-</td>
            <td class="tg-0lax" style="text-align: center">-</td>
            <td class="tg-0lax" style="text-align: center">-</td>
            <td class="tg-0lax" style="text-align: center">-</td>
          </tr>
          <tr>
            <td class="tg-0lax" style="text-align: right;"><b>Total</b></td>
            <td class="tg-0lax" style="text-align: center">-</td>
            <td class="tg-0lax" style="text-align: center">--</td>
            <td class="tg-0lax" style="text-align: center">---</td>
            <td class="tg-0lax" style="text-align: center">----</td>
          </tr>
        </tbody>
        </table>
        <div class="" style="">
          <h5 style="margin-bottom: 100px; font-weight:400;margin-top:10px;font-size:16px;">Tax Amount (in words) :</h5>
          <h5 style="font-size: 16px;font-weight:400">Company’s PAN : <b>AARCA8415B</b> </h5>
          <h5 style="text-align: right;font-weight:400;font-size:16px"> <b>For Appincuba Technologies Pvt. Ltd</b> </h5>
          <h5 style="text-align: right;font-weight:400;font-size:16px;margin-top:20px">Authorised Signatory</h5>
          <p style="text-align: center;font-weight:400;font-size:13px;position:fixed;bottom:0px;left:35%">This is a Computer Generated Invoice</p>
        </div>
</div>

</body>
</html>













{{--

 <!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Invoice 1</title>
  <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Lora:wght@600&display=swap');
    @page{margin: 20px 20px 0 20px; size: letter; font-family: 'Open Sans', sans-serif;}
    .tg{border-collapse:collapse;border-spacing:0;}
    .tg td{border-color:rgb(5, 5, 5);border-style:solid;border-width:1px;font-family: 'Open Sans', sans-serif;font-size:11px;overflow:hidden;padding:1px 5px;word-break:normal;}
    .tg th{border-color:rgb(5, 5, 5);border-style:solid;border-width:1px;font-family: 'Open Sans', sans-serif;font-size:11px;font-weight:bold;overflow:hidden;padding:1px 5px;word-break:normal;}
    .tg .tg-0lax{text-align:left;vertical-align:top}
    .bg-green{background: #1e9c48;}
    td{ font-size: 11px;}
  </style>
<body style="margin: 0; padding;0; font-family: 'Open Sans', sans-serif;">
<div class="" style="font-family: 'Open Sans', sans-serif; border:3px solid rgb(231, 231, 231)">
<table style="border-collapse: separate; border-spacing: 5px 15px 0 15px; border-bottom:1px rgb(121, 121, 121); width:100%; padding:0" role="presentation" bgcolor="rgb(235, 235, 235)" border-collapse= "separate" border-spacing= "1px" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" >
  <tr style="padding:0">
      <td style="width:10%; text-align:center">
        <img style="width: 80px; padding-left:10px" src="" alt=""/>
      <td>
      <td style="width:90%; padding:0">
          <h4 style=" text-align:center; line-height:1;font-size:26px; color: #33a245; font-family: 'Open Sans', sans-serif; font-weight:400; margin-top:1px;margin-bottom:5px;margin-left:0px">
            <b style="margin: 0">Sarvabhishta E-Waste Management Private Limited<b>
          </h4>
            <p style=" text-align:center; color:rgb(0, 0, 0);font-family: 'Open Sans', sans-serif; font-size:13px;margin:0;line-height:1;padding:0;margin-right:75px">
            <span style=" text-align:center; color:rgb(0, 0, 0);font-family: 'Open Sans', sans-serif; font-size:13px;margin:0;line-height:1;"><b>CIN :</b>U74990DL2018PTC341979</span><br>
            <span style=" text-align:center; color:rgb(0, 0, 0)0, 0, 0);font-family: 'Open Sans', sans-serif; font-size:13px; margin:0 20px;;line-height:1;"><b>GSTIN :</b>09ABBCS1550L1Z7</span><br>
            <span style=" text-align:center; color:rgb(0, 0, 0);font-family: 'Open Sans', sans-serif; font-size:13px;margin:0;;line-height:1;padding:0;"><b style="padding:0">State Code:</b>09</span>
          </p>
        </td>
  </tr>
</table>

<table style="width:100%; padding:5px 0px 0 0px; border-bottom:2px solid rgb(231, 231, 231)" bgcolor="#fff" border-collapse= "separate" border-spacing= "1px" aria-hidden="true" cellspacing="0" cellpadding="0" >
  <tr>
    <td style="padding-bottom:0px">
        <h4 style="font-size:11px; text-align:center; line-height:1; color: #000000; font-family: 'Open Sans', sans-serif; font-weight: bold; ">
          <b>Warehouse Address : </b>A-27/K, First Floor, Sector-16, Noida, Gautam Buddha Nagar, Uttar Pradesh-20301<br>
          <b> Registered Address : </b>C-2/105, Second Floor, Sector-16, Rohini, North West Delhi, Delhi-110085<br>
          <b>Website : www.mobitrade.in, Email : accounts@mobitrade.in, Phone : 8700172840</b>
        </h4>
    </td>
  </tr>
</table>

<table class="" style="border-bottom:2px solid rgb(231, 231, 231);width: 100%; margin:0 auto 0 auto; font-family: 'Open Sans', sans-serif;padding-bottom:15px; ">
  <tbody>
    <tr style="font-family: 'Open Sans', sans-serif;">
      <td class="tg-0lax" style="border-bottom :0 ;font-family: 'Open Sans', sans-serif;text-align: center;"><b style=" font-family: 'Open Sans', sans-serif; text-align: center; font-size:12px; color: rgb(0, 0, 0); margin: 0;line-height:1"> Invoice</b></td>
    </tr>
    <tr style="font-family: 'Open Sans', sans-serif; padding-bottom:5px;">
     dfhgfhgfhf
    </tr>
  </tbody>
</table>


<div style="border:1px solid rgb(231, 231, 231); padding:0px 10px 1px 10px; width: 95%; margin: 0 auto;height:92px;margin-top:-5px" class="">
  <table style="font-family: 'Open Sans', sans-serif;height:120px;width:100%; ">
    <tr>
      <td class="tg-0lax" style="font-family: 'Open Sans', sans-serif; border:0; font-size:11px"><b style="font-family: 'Open Sans', sans-serif;line-height:20px">Invoice Details</b></td>
    </tr>
    <tr>
      <td class="tg-0lax" style="font-family: 'Open Sans', sans-serif; border:0; font-size:11px; padding:0; font-weight:400; margin:0; line-height:18px"><b>Invoice No:</b></td>
      <td class="tg-0lax" style="font-family: 'Open Sans', sans-serif; border:0; font-size:11px; padding:0; font-weight:400; margin:0; line-height:18px">hjkhjkhjk</td>
      <td class="tg-0lax" style="font-family: 'Open Sans', sans-serif; border:0; font-size:11px; padding:0; font-weight:400; margin:0; line-height:18px"></td>
      <td class="tg-0lax" style="font-family: 'Open Sans', sans-serif; border:0; font-size:11px; padding:0; font-weight:400; margin:0; line-height:18px"></td>
    </tr>
    <tr>
      <td class="tg-0lax" style="font-family: 'Open Sans', sans-serif; border:0; font-size:11px; padding:0; font-weight:400; margin:0; line-height:18px"><b>Date: </td>
      <td class="tg-0lax" style="font-family: 'Open Sans', sans-serif; border:0; font-size:11px; padding:0; font-weight:400; margin:0; line-height:18px">yghhnghnjghjg</td>
    </tr>
    <tr>
      <td class="tg-0lax" style="font-family: 'Open Sans', sans-serif; border:0; font-size:11px; padding:0; font-weight:400; margin:0; line-height:18px"><b>Payment Mode: </b>
      </td>
      <td class="tg-0lax" style="font-family: 'Open Sans', sans-serif; border:0; font-size:11px; padding:0; font-weight:400; margin:0; line-height:18px">jgjgjgj</td>
      <td class="tg-0lax" style="font-family: 'Open Sans', sans-serif; border:0; font-size:11px; padding:0; font-weight:400; margin:0; line-height:18px"><b>Employe Code: </b>
      </td>
      <td class="tg-0lax" style="font-family: 'Open Sans', sans-serif; border:0; font-size:11px; padding:0; font-weight:400; margin:0; line-height:18px">ghjghjgjg</td>
    </tr>
  </table>
</div>



<table class="tg" style="width: 98%; margin: 10px auto;">
  <tr>
    <td class="tg-0lax" style="width: 48%;padding:10px;border:1px solid rgb(231, 231, 231)">
      <table style="border-collapse: collapse; border: 0px; width:100%">
        <tr style="">
          <td style="border: 0px; padding:0"><p style="font-family: 'Open Sans', sans-serif; font-size:11px; font-weight:400; margin:0"><b>Bill To:</b></p></td>
        </tr>
        <tr>
          <td style="border: 0px; padding:0"><p style="font-family: 'Open Sans', sans-serif; font-size:11px; margin:0;text-transform:capitalize"><b>gfhghgfh</b></p></td>
        </tr>
        <tr>
          <td style="border: 0px; padding:0"><p style="font-family: 'Open Sans', sans-serif; font-size:11px; margin:0">useradd->addres</p></td>
        </tr>
        <tr>
          <td style="border: 0px; padding:0"><b>Mobile:</b></td>
          <td style="border: 0px; padding:0">gfhghhgfh}</td>
        </tr>
        <tr>
          <td style="border: 0px; padding:0"><b>GSTIN:</b></td>
          <td style="border: 0px; padding:0">ghjgjghjghj</td>
        </tr>
        <tr>
          <td style="border: 0px; padding:0"><b>PAN:</b></td>
          <td style="border: 0px; padding:0">ghjghjghjg</td>
        </tr>

        <tr>
          <td style="border: 0px; padding:0"><b>Place of supply:</b></td>
          <td style="border: 0px; padding:0">ghjghjghjgj</td>
        </tr>
        <tr>
          <td style="border: 0px; padding:0"><b>State Code:</b></td>
          <td style="border: 0px; padding:0">gfbgfhgfh</td>
        </tr>
      </table>
    </td>

    <td class="tg-0lax" style="width: 48%;padding:10px;border:1px solid rgb(231, 231, 231)">
      <table style="border-collapse: collapse; border: 0px; width:100%">
        <tr style="">
          <td style="border: 0px; padding:0"><p style="font-family: 'Open Sans', sans-serif; font-size:11px; font-weight:400; margin:0"><b>Ship To:</b></p></td>
        </tr>
        <tr>
          <td style="border: 0px; padding:0"><p style="font-family: 'Open Sans', sans-serif; font-size:11px; margin:0;text-transform:capitalize"><b>gfhgfhgfh</b></p></td>
        </tr>
        <tr>
          <td style="border: 0px; padding:0"><p style="font-family: 'Open Sans', sans-serif; font-size:11px; margin:0">gfghgfhgf</p></td>
        </tr>
        <tr>
          <td style="border: 0px; padding:0"><b>Mobile:</b></td>
          <td style="border: 0px; padding:0">hnjghjghjghj</td>
        </tr>
        <tr>
          <td style="border: 0px; padding:0"><b>GSTIN:</b></td>
          <td style="border: 0px; padding:0">ghjghjghj</td>
        </tr>
        <tr>
          <td style="border: 0px; padding:0"><b>PAN:</b></td>
          <td style="border: 0px; padding:0">ghjgjghj</td>
        </tr>
        <tr>
          <td style="border: 0px; padding:0"><b>Place of supply:</b></td>
          <td style="border: 0px; padding:0">ghjghjghj</td>
        </tr>
        <tr>
          <td style="border: 0px; padding:0"><b>State Code:</b></td>
          <td style="border: 0px; padding:0">ghjghjghj</td>

        </tr>
      </table>
    </td>
  </tr>
</table>
<table class="tg" style="width:98%; margin: 0 auto; padding:0">
    <tr>
      <th class="" style="text-align: center; background: #1e9c48; border:1px #1e9c48; color: #fff;">S. NO.</th>
      <th class="" colspan="2" style="text-align: center; background: #1e9c48; border:1px #1e9c48; color: #fff;">Description of Goods</th>
      <th class="" style="text-align: center; background: #1e9c48; border:1px #1e9c48; color: #fff;">IME/Serial Number</th>
      <th class="" style="text-align: center; background: #1e9c48; border:1px #1e9c48; color: #fff;">Barcode </th>
      <th class="" style="text-align: center; background: #1e9c48; border:1px #1e9c48; color: #fff;">Grade</th>
      <th class="" style="text-align: center; background: #1e9c48; border:1px #1e9c48; color: #fff;">HSN/SAC</th>
      <th class="" style="text-align: center; background: #1e9c48; border:1px #1e9c48; color: #fff;">QTY</th>
      <th class="" style="text-align: center; background: #1e9c48; border:1px #1e9c48; color: #fff;">Amount(Rs)</th>
    </tr>

        <tr>
          <td class="" style="text-align: center;">gbhgfhgfh</td>
          <td colspan="2" style="text-align: center;" class="">gfhngfhgfh</td>

          <td class="" style="text-align: center;">ghhjghjyghj</td>
          <td class="" style="text-align: center;">ghjgjgj</td>
          <td class="" style="text-align: center;">gh</td>
          <td class="" style="text-align: center;">8517709</td>
          <td class="" style="text-align: center;">1</td>
          <td class="" style="text-align: center;">
          gfhgfhfgh
          </td>
        </tr>
      <tr>
      <td class="" colspan="5">Short & Excess </td>
      <td class="" colspan="4">0</td>
    </tr>

    <tr>
      <td class="" colspan="5">Discount Applied</td>
      <td class="" colspan="4">
        ghfghfgh
      </td>
    </tr>
</table>







 </div>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>

</body>

 --}}

