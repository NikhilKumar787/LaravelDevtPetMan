{{-- template 2 STARTS --}}
<div class="template1">
    <div class="container">
        <div class="">
            <div class="" id="font_change">
             <div class="position-relative" id="header_div">
                <table class="table table-striped" id="table_color_change" style="width: 100%;background-color: #dfefff">
                    <tr>
                        <td>
                           <div class="row justify-content-between" id="flex_left" hidden>
                            
                                <div class="output" style="margin-left: 15px">
    
                                </div>
                                <div class="left_image col-md-6" id="left_image">
                                        <h4 class="" id="company_name">{{$company->company_name}}</h4>
                                        <P>
                                            <span class="hide_address">
                                                <span id="address_line1">{{$company->address_line_1}}</span><br>
                                                <span class="address_line2" id="address_line2">{{$company->address_line_2}}</span> 
                                                <span class="city" id="city">{{$company->city->name}}</span> 
                                                <span hidden id="city_id">{{$company->city_id}}</span> 
                                                <span hidden id="state_id">{{$company->state_id}}</span>
                                                <span class="state" id="state">{{$company->state->state}}</span>
                                                <span class="pin_code"  id="pin_code">{{$company->pin_code}}</span>
                                                <span hidden id="comp_id">{{$company->id}}</span>
                                                <span hidden id="cust_id">{{$company_user->id}}</span>
                                            </span>
                                            <br>
                                            <span class="phone_no" id="phone_org_no">{{$company_user->phone_no}}</span><br>
                                            <span class="owner_org_email" id="owner_org_email">{{$company_user->email}}</span><br>
                                            <span class="owner_website"></span>
                                        </P>
                                </div>
                                
                            </div>
                            <div class="row justify-content-between" id="flex_right">
                                <div class="col-md-6" id="right_image">
                                   
                                    <h4 class="company_name" id="company_name">{{$company->company_name}}</h4>
                                
                                    <P id="company_details">
                                        <span class="hide_address">
                                            <span id="address_line1">{{$company->address_line_1}}</span><br>
                                            <span class="address_line2" id="address_line2">{{$company->address_line_2}}</span>
                                            <span hidden id="city_id">{{$company->city_id}}</span> 
                                            <span class="city" id="city">{{$company->city->name}}</span> 
                                            <span hidden id="state_id">{{$company->state_id}}</span>
                                            <span class="state_name" id="state_name">{{$company->state->state}}</span>
                                            <span class="pin_code"  id="pin_code">{{$company->pin_code}}</span>
                                            <span hidden id="comp_id">{{$company->id}}</span>
                                            <span hidden id="cust_id">{{$company_user->id}}</span>
                                        </span>
                                        <br>
                                        <span class="phone_no" id="phone_no">{{$company_user->phone_no}}</span><br>
                                        <span class="owner_email" id="owner_email">{{$company_user->email}}</span><br>
                                        <span class="owner_website"></span>
                                    </P>
                                </div>
                                <div class="output" style="margin-right: 15px">
    
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="temp-edit-icon d-none">
                    <i class="fas fa-pencil" id="edit_content_header"></i>
                </div>
              </div>
              <div class="position-relative" id="center_div">

                <h5>Invoice</h5>

                <table style="width: 100%">
                    <tr>
                        <td>Bill To</td>
                        <td class="ship_to">Ship To</td>
                        <td>Ship Date</td>
                        <td>01/02/2023</td>
                        <td>Invoice</td>
                        <td class="due_date">Due date 01/01/2023</td>
                    </tr>
                    <tr>
                        <td class="ship_to" colspan="4">Smith Co. 123 main street City, 201235</td>
                        <td>Ship Via</td>
                    </tr>
                    <tr>
                        <td colspan="4">Smith Co. 123 main street City, 201235</td>
                        <td>Ship Via</td>
                    </tr>
                </table>



                <table style="width: 100%;margin-top:25px;">
                    <thead id="thead" style="background-color: #e3f1ff;padding:20px">
                        <tr>
                            <th></th>
                            <th>QTY</th>
                            <th>RATE</th>
                            <th style="text-align: right">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Item name</td>
                            <td>21</td>
                            <td>545$</td>
                            <td style="text-align: right">8545$</td>
                        </tr>
                        <tr>
                            <td>Item name</td>
                            <td>21</td>
                            <td>545$</td>
                            <td style="text-align: right">8545$</td>
                        </tr>
                        <tr style="border-bottom:2px dotted #dedede;">
                            <td style="">Item name</td>
                            <td>21</td>
                            <td>545$</td>
                            <td style="text-align: right">8545$</td>
                        </tr>
                    </tbody>
                </table>
                <div class="temp-edit-icon m-0 d-none">
                    <i class="fas fa-pencil" id="edit_content_center"></i>
                </div>
            </div>  
            <div class="position-relative" id="footer_div"> 
                <table style="width: 50%;margin-left:auto;margin-top:25px;margin-bottom:25px">
                    <thead>
                        <tr>                          
                            <th>SUB TOTAL</th>                      
                            <th style="text-align: right">$4545</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>                           
                            <td>TAX</td>
                            <td style="text-align: right">8545$</td>
                        </tr>
                        <tr>                          
                            <td>SHIPPING</td>
                            <td style="text-align: right">8545$</td>
                        </tr>
                        <tr>                           
                            <td>Total</td>
                            <td style="text-align: right">8545$</td>
                        </tr>
                        <tr style="border-top:2px dotted #dedede">                           
                            <td>Balance</td>
                            <td style="text-align: right;font-weight:800">8545$</td>
                        </tr>
                    </tbody>
                </table>
                <div class="" style="margin-top: 50px">
                    <p class="m-0" style="font-size: 12px"><b>Bank Details</b></p>
                    <p class="m-0" style="font-size: 12px">Account Name:<span>546546545646546</span></p>
                    <p class="m-0" style="font-size: 12px">Account No:<span>24100200001234</span></p>
                    <p class="m-0" style="font-size: 12px">IFSC:<span>PUNB012345</span></p>
                    <p class="m-0" style="font-size: 12px">Bank Name:<span>Punjab National Bank</span></p>
                    <p class="m-0" style="font-size: 12px">Branch Name:<span>Noida</span></p>                
                </div>
                <div class="temp-edit-icon m-0 d-none">
                    <i class="fas fa-pencil" id="edit_content_footer"></i>
                </div>
        </div>  
            </div>
        </div>
    </div>
</div>


{{-- template 2 ENDS --}}