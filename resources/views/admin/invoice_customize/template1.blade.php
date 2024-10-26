{{-- template 1 STARTS --}}
<div class="template2">
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
                                        <h4 class="company_name" id="company_name">{{$company->company_name}}</h4>
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
                        <td style="width:33%"><b>Bill To</b></td>
                        <td class="ship_to" style="width:33%"><b>Ship To</b></td>
                        <td style="width:33%;text-align: right;"><b>Invoice</b>12345</td>                     
                    </tr>   
                    <tr>
                        <td style="width:33%;vertical-align: baseline;" rowspan="3">Smith Co.</td> 
                        <td class="ship_to" style="width:33%;vertical-align: baseline;" rowspan="3">Smith Co.</td>   
                        <td style="width:33%;text-align: right"><b>Date</b>12/04/23</td>
                    </tr> 
                    <tr>                       
                        <td class="due_org_date" style="text-align: right"><b>Due Date</b>12/04/23</td>
                    </tr> 
                    <tr>                       
                        <td class="terms_org" style="text-align: right"><b>Terms</b>Net 3d</td>
                    </tr>
                </table>

                <table style="width: 100%;margin-top:30px">
                    <tr>
                        <td style="width:25%"><b>Ship Date</b></td>
                        <td style="width:25%"><b>Ship Via</b></td>
                        <td style="width:25%"><b>Tracking Number</b></td>
                        <td style="width:25%"><b>PO No.</b></td>                                           
                    </tr>   

                    <tr>
                        <td style="width:25%">01/01/2023</td>
                        <td style="width:25%">Fed Ex</td>
                        <td style="width:25%">2121321321</td>
                        <td style="width:25%">CUSTOM 1.</td>                                           
                    </tr>  
                  
                </table>

                <table style="width: 100%;margin-top:25px;">
                    <thead id="thead" style="background-color: #e3f1ff;padding:20px">
                        <tr>
                            <th class="product_org_date d-none">Date</th>
                            <th class="product_org_service">Product/Service</th>
                            <th class="product_service1 d-none">Product/Service</th>
                            <th class="product_org_description">Description</th>
                            <th class="product_description1 d-none">Description</th>
                            <th class="product_org_quantity">QTY</th>
                            <th class="product_org_rate">RATE</th>
                            <th class="product_org_amount" style="text-align: right">AMOUNT</th>
                            <th class="product_org_sku d-none" style="text-align: right">SKU</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="product_org_date d-none">12/04/23</td>
                            <td class="product_org_service">Item name</td>
                            <td class="product_service1 d-none" style="font-size: 11px">Item name<br>
                                Description of the item</td>
                            <td class="product_org_description" style="font-size: 11px">Description of the item</td>
                            <td class="product_org_quantity">21</td>
                            <td class="product_org_rate">545$</td>
                            <td class="product_description1 d-none" style="font-size: 11px">Description of the<br> item, 2 @225.00</td>
                            <td  class="product_org_amount" style="text-align: right">8545$</td>
                            <td class="product_org_sku d-none" style="text-align: right">PRD123</td>
                        </tr>
                        <tr>
                            <td class="product_org_date d-none">12/04/23</td>
                            <td class="product_org_service">Item name</td>
                            <td class="product_service1 d-none" style="font-size: 11px">Item name<br>
                                Description of the item</td>
                            <td class="product_org_description" style="font-size: 11px">Description of the item</td>
                            <td class="product_org_quantity">21</td>
                            <td class="product_org_rate">545$</td>
                            <td class="product_description1 d-none" style="font-size: 11px">Description of the<br> item, 2 @225.00</td>
                            <td  class="product_org_amount" style="text-align: right">8545$</td>
                            <td class="product_org_sku d-none" style="text-align: right">RKC123</td>
                        </tr>
                        <tr style="border-bottom:2px dotted #dedede;">
                            <td class="product_org_date d-none">12/04/23</td>
                            <td class="product_org_service">Item name</td>
                            <td class="product_service1 d-none" style="font-size: 11px">Item name<br>Description of the item</td>
                            <td class="product_org_description" style="font-size: 11px">Description of the item</td>
                            <td class="product_org_quantity">21</td>
                            <td class="product_description1 d-none" style="font-size: 11px">Description of the<br> item, 2 @225.00</td>
                            <td class="product_org_rate">545$</td>
                            <td class="product_org_amount" style="text-align: right">8545$</td>
                            <td class="product_org_sku d-none" style="text-align: right">SVC123</td>
                        </tr>
                    </tbody>
                </table>
                <div class="temp-edit-icon m-0 d-none">
                    <i class="fas fa-pencil" id="edit_content_center"></i>
                </div>
            </div>  
            
                
            <div class="position-relative" id="footer_div"> 
                <div>
                    <p id="paragraph_message" style="margin-top: 15px;"></p>
                </div> 
                    <table style="width: 50%;margin-left:auto;margin-top:25px;margin-bottom:25px">
                        <thead>
                            <tr>                          
                                <th>SUB TOTAL</th>                      
                                <th style="text-align: right">$4545</th>
                            </tr>
                            
                            <tr class="product_org_discount d-none">                           
                                <td>DISCOUNT 2%</td>
                                <td style="text-align: right">-13.50</td>
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
                            <tr class="product_org_deposit d-none">                          
                                <td>DEPOSIT</td>
                                <td style="text-align: right">10.00</td>
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
                        <p class="m-0" style="font-size: 12px">Account Name:<span> 546546545646546</span></p>
                        <p class="m-0" style="font-size: 12px">Account No:<span> 24100200001234</span></p>
                        <p class="m-0" style="font-size: 12px">IFSC:<span> PUNB012345</span></p>
                        <p class="m-0" style="font-size: 12px">Bank Name:<span> Punjab National Bank</span></p>
                        <p class="m-0" style="font-size: 12px">Branch Name:<span> Noida</span></p>                     
                    </div>
                    <div class="temp-edit-icon m-0 d-none">
                        <i class="fas fa-pencil" id="edit_content_footer"></i>
                    </div>
            </div>  
                
        </div>
    </div>
    </div>
</div>
{{-- template 1 ENDS --}}





































