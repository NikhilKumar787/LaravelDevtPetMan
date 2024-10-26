@extends('layouts.admin')
@section('styles')
<style>
       .modal-backdrop {
    z-index: -1;
    }
</style>
@endsection
@section('content')
<div class="container-fluid bg-white px-3 py-2">
    <h5>Customize Invoice</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="custom-invoice-left-bg">
                <ul class="nav nav-pills mb-3 custom-invoice-ul" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Design</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Content</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-toggle="pill" data-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Email</button>
                    </li>
                </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="form-group">
                        <input type="hidden" id="template_logo_alignment" value="{{$template->template_logo_alignment}}">
                        <input type="hidden" id="selected_temp_id" value="{{$template->id}}">
                        <input type="hidden" id="selected_template_no" value="{{$template->template_no}}">
                        <input type="hidden" id="selected_template_color_code" value="{{$template->template_color_code}}">
                        <input type="hidden" id="selected_template_font" value="{{$template->template_font}}">
                        <input type="hidden" id="selected_company_id" value="{{$template->company_id}}">
                    </div>
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <label for="exampleInputEmail1">Template name</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="template_name" aria-describedby="emailHelp" value="{{$template->template_name}}" readonly>
                        </div>
                        
                        <label for="exampleFormControlFile1">Choose Template</label>
                        <div class="select-invoice-bg">
                            <div class="select-invoice-box temp_no_1" id="first_active" template_no="1" template_name="Template 01">
                                <img src="{{asset('img/invoices/01.png')}}" width="" alt="">
                                <h6 class="template_set">Template 01</h6>
                            </div>
                            <div class="select-invoice-box temp_no_2" template_no="2" template_name="Template 02">
                                <img src="{{asset('img/invoices/02.png')}}" width="" alt="">
                                <h6 class="template_set">Template 02</h6>
                            </div>
                            <div class="select-invoice-box temp_no_3" template_no="3" template_name="Template 03">
                                <img src="{{asset('img/invoices/03.png')}}" width="" alt="">
                                <h6 class="template_set">Template 03</h6>
                            </div>
                            <div class="select-invoice-box temp_no_4" template_no="4" template_name="Template 04">
                                <img src="{{asset('img/invoices/04.png')}}" width="" alt="">
                                <h6 class="template_set">Template 04</h6>
                            </div>
                            <div class="select-invoice-box temp_no_5" template_no="5" template_name="Template 05">
                                <img src="{{asset('img/invoices/03.png')}}" width="" alt="">
                                <h6 class="template_set">Template 05</h6>
                            </div>
                            <div class="select-invoice-box temp_no_6" template_no="6" template_name="Template 06">
                                <img src="{{asset('img/invoices/01.png')}}" width="" alt="">
                                <h6 class="template_set">Template 06</h6>
                            </div>
                        </div>
                        <label class="my-3" for="exampleFormControlFile1">Choose Logo</label>
                        <div class="form-group">
                            <div class="form-group">
                                <div class="needsclick dropzone {{ $errors->has('company_logo') ? 'is-invalid' : '' }}"
                                    id="company_logo-dropzone">
                                </div>
                                @if ($errors->has('company_logo'))
                                    <span class="text-danger">{{ $errors->first('company_logo') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.company.fields.company_logo_helper') }}</span>
                            </div>
                           <button type="button" class="btn btn-success"><i class="bi bi-box-arrow-in-left" id="image_left" onClick=move_img('left') value='Left'></i></button> 
                           <button type="button" class="btn btn-warning"><i class="bi bi-box-arrow-in-right" id="image_right" onClick=move_img('right') value='Right'></i></button>
                        </div>
                        <div class="my-3">
                            <label for="exampleInputEmail1">Select Color</label>
                            <div class="insider">
                                <div class="color" color_code="#9b5de5" style="background-color: #9b5de5"></div>
                                <div class="color" color_code="#f15bb5" style="background-color: #f15bb5"></div>
                                <div class="color" color_code="#fee440" style="background-color: #fee440"></div>
                                <div class="color" color_code="#00bbf9" style="background-color: #00bbf9"></div>
                                <div class="color" color_code="#00f5d4" style="background-color: #00f5d4"></div>
                                <div class="color" color_code="#9a031e" style="background-color: #9a031e"></div>
                                <div class="color" color_code="#1a936f" style="background-color: #1a936f"></div>
                                <div class="color" color_code="#e36414" style="background-color: #e36414"></div>
                                <div class="color" color_code="#4cc9f0" style="background-color: #4cc9f0"></div>
                                <div class="color" color_code="#84dcc6" style="background-color: #84dcc6"></div>
                                <div class="color" color_code="#5465ff" style="background-color: #5465ff"></div>
                              </div>
                        </div>
                        <div class="form-group">
                            <label for="inputState">Choose Font</label>
                            <select id="inputState" onchange="myFunction(this);"class="form-control">
                                <option>Georgia</option>
                                <option>Palatino Linotype</option>
                                <option>Book Antiqua</option>
                                <option>Times New Roman</option>
                                <option>Arial</option>
                                <option>Helvetica</option>
                                <option>Arial Black</option>
                                <option>Impact</option>
                                <option>Lucida Sans Unicode</option>
                                <option>Tahoma</option>
                                <option>Verdana</option>
                                <option>Courier New</option>
                                <option>Lucida Console</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" id="update_change" type="submit">Update Change</button>
                    </div>
                
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="header_content d-none">
                                <div class="" style="margin-bottom: 10px">
                                    <span class="form-group" id="header_unhide" style="margin-bottom: 100px">Header</span>
                                </div><hr>
                                
                                <div class="form-group" id="unhide_business_name">
                                    {{-- @if($template_properties->Header->business_name == 'true')
                                    <input class="form-check-input" style="margin-left: 0.5px" type="checkbox" name="check_business_name" id="check_business_name" value="1" {{ old('check_business_name', 1) == 0 ? 'checked' : '' }} checked>
                                    @else
                                    <input class="form-check-input" style="margin-left: 0.5px" type="checkbox" name="check_business_name" id="check_business_name" value="1" {{ old('check_business_name', 1) == 0 ? 'checked' : '' }}>
                                    @endif --}}
                                    <input class="form-check-input business_name" style="margin-left: 0.5px" type="checkbox" name="check_business_name" id="check_business_name" value="1" {{ old('check_business_name', 1) == 0 ? 'checked' : '' }} checked>
                                    <label for="business_name" style="margin-left: 20px">Business Name</label>
                                    <input type="text" class="form-control" id="business_name" name="business_name">
                                </div>
                                <div class="form-group" id="unhide_phone_no">
                                    {{-- @if($template_properties->Header->phone == 'true')
                                    <input class="form-check-input" style="margin-left: 0.5px" type="checkbox" name="check_phone" id="check_phone" value="1" {{ old('check_phone', 1) == 0 ? 'checked' : '' }} checked>
                                    @else
                                    <input class="form-check-input" style="margin-left: 0.5px" type="checkbox" name="check_phone" id="check_phone" value="1" {{ old('check_phone', 1) == 0 ? 'checked' : '' }} >
                                    @endif --}}
                                    <input class="form-check-input phone" style="margin-left: 0.5px" type="checkbox" name="check_phone" id="check_phone" value="1" {{ old('check_phone', 1) == 0 ? 'checked' : '' }} checked>
                                    <label for="phone" style="margin-left: 20px">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                                <div class="form-group" id="unhide_email">
                                    {{-- @if($template_properties->Header->owner_email == 'true')
                                    <input class="form-check-input" style="margin-left: 0.5px" type="checkbox" name="check_email" id="check_email" value="1" {{ old('check_email', 1) == 0 ? 'checked' : '' }} checked>
                                    @else
                                    <input class="form-check-input" style="margin-left: 0.5px" type="checkbox" name="check_email" id="check_email" value="1" {{ old('check_email', 1) == 0 ? 'checked' : '' }} >
                                    @endif --}}
                                    <input class="form-check-input owner_email" style="margin-left: 0.5px" type="checkbox" name="check_email" id="check_email" value="1" {{ old('check_email', 1) == 0 ? 'checked' : '' }} checked >

                                    <label for="email" style="margin-left: 20px">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div> 

                                <div class="form-group d-none" id="unhide_street_address">
                                    {{-- @if($template_properties->Header->street_address == 'true')
                                    <input class="form-check-input" style="margin-left: 0.5px" type="checkbox" name="check_street_address" id="check_street_address" value="1" {{ old('check_email', 1) == 0 ? 'checked' : '' }} checked>
                                    @else
                                    <input class="form-check-input" style="margin-left: 0.5px" type="checkbox" name="check_street_address" id="check_street_address" value="1" {{ old('check_email', 1) == 0 ? 'checked' : '' }} >
                                    @endif --}}
                                    <input class="form-check-input street_address" style="margin-left: 0.5px" type="checkbox" name="check_street_address" id="check_street_address" value="1" {{ old('check_email', 1) == 0 ? 'checked' : '' }} checked>
                                    <label for="email" style="margin-left: 20px">Street Address</label>
                                    <input type="text" class="form-control" id="street_address" name="street_address">
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="business_city" id="business_city">
                                                @foreach ($cities as $id => $entry)
                                                    <option value="{{ $id }}" {{ old('business_city') == $id ? 'selected' : '' }}>
                                                        {{ $entry }}</option>
                                                @endforeach
                                                </select>  
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="business_state" id="business_state">
                                                @foreach ($states as $id => $entry)
                                                    <option value="{{ $id }}" {{ old('state_id') == $id ? 'selected' : '' }}>
                                                        {{ $entry }}</option>
                                                @endforeach
                                                </select>  
                                            </div>
                                        </div>
                            
                                    
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <label for="pin_code">Pin code</label>
                                            <input type="text" class="form-control" id="business_pin_code" name="pin_code">
                                            </div>
                                        </div>
                                    </div> 
                                </div> 
                                
                                <div class="d-flex flex-column">
                                    <a href="#" id="unhide_address" class="">+Address</a>
                                    <a href="#" id="unhide_website" class="">+Website</a>
                                </div>
                                
                                <div class="form-group d-none" id="unhide_website1">
                                    {{-- @if($template_properties->Header->website == 'true')
                                    <input class="form-check-input" style="margin-left: 0.5px" type="checkbox" id="check_website" value="1" {{ old('check_webiste', 1) == 0 ? 'checked' : '' }} checked>
                                    @else
                                    <input class="form-check-input" style="margin-left: 0.5px" type="checkbox" id="check_website" value="1" {{ old('check_webiste', 1) == 0 ? 'checked' : '' }} >

                                    @endif --}}
                                    <input class="form-check-input website" style="margin-left: 0.5px" type="checkbox" id="check_website" value="1" {{ old('check_webiste', 1) == 0 ? 'checked' : '' }} >

                                    <label for="business_name" style="margin-left: 20px">Website</label>
                                    <input type="email" class="form-control" id="website" name="website">
                                </div>

                                <div class="" style="margin-top: 10px; margin-bottom: 10px">
                                    <span class="form-group" id="unhide_display">Display</span>
                                </div><hr>
                            
                                <div class="d-flex flex-column">
                                    <div class="" id="unhide_billing_address">
                                        <input class="form-check-input" style="margin-left: 0.5px" type="checkbox" name="check_billing_address" id="check_billing_address" value="1" {{ old('check_billing_address', 1) == 0 ? 'checked' : '' }} checked disabled>
                                        <label for="billing_address" style="margin-left: 20px" disabled>Billing Address</label>
                                    </div>
                                    <div class="" id="unhide_shipping_address">
                                        <input class="form-check-input shipping_address" style="margin-left: 0.5px" type="checkbox" name="check_shipping_address" id="check_shipping_address" value="1" {{ old('check_shipping_address', 1) == 0 ? 'checked' : '' }} checked>
                                        <label for="shipping_address" style="margin-left: 20px">Shipping Address</label>
                                    </div>
                                    <div class="" id="unhide_terms">
                                        <input class="form-check-input terms" style="margin-left: 0.5px" type="checkbox" name="check_terms" id="check_terms" value="1" {{ old('check_due_date', 1) == 0 ? 'checked' : '' }} checked>
                                        <label for="terms" style="margin-left: 20px">Terms</label>
                                    </div>
                                    <div class="" id="unhide_due_date">
                                        <input class="form-check-input due_date" style="margin-left: 0.5px" type="checkbox" name="check_due_date" id="check_due_date" value="1" {{ old('check_due_date', 1) == 0 ? 'checked' : '' }} checked>
                                        <label for="due_date" style="margin-left: 20px">Due date or expiration date</label>
                                    </div>
                                     
                                </div>     
                        </div> 
                        <span class="hidden_header_click">Click the pencils on the right to edit each section.</span>
                        <div class="center_content">
                            <div class="hidden_center_click d-none" style="margin-top: 15px;">
                                <span>Activity table</span>
                            </div>
                            <div class="hidden_center_click d-none" style="margin-top: 20px;">
                                <span class="">COLUMNS</span>
                                <hr>
                                <div class="" id="">
                                    <input class="form-check-input product_date" style="margin-left: 0.5px" type="checkbox" name="date" id="check_product_date" value="1" {{ old('check_product_date', 1) == 0 ? 'checked' : '' }} >
                                    <label for="product_date" style="margin-left: 20px; font-size:15px;">Date</label>
                                </div><hr>
                                <div class="" id="">
                                    <input class="form-check-input product_service" style="margin-left: 0.5px" type="checkbox" id="check_product_service" value="1" {{ old('check_product_service', 1) == 0 ? 'checked' : '' }} checked>
                                    <label for="product_service" style="margin-left: 20px; font-size:15px;">Product/Service</label>
                                    <div class="" id="">
                                        <input class="form-check-input product_incl_des_here" style="margin-left: 22px" type="checkbox" id="check_incl_des_here" value="1" {{ old('check_incl_des_here', 1) == 0 ? 'checked' : '' }}>
                                        <label for="incl_des_here" style="margin-left: 40px; font-size:11px;">Include description here</label>
                                    </div>
                                </div><hr>
                                <div class="" id="">
                                    <input class="form-check-input product_description" style="margin-left: 0.5px" type="checkbox"  id="check_product_description" value="1" {{ old('check_product_description', 1) == 0 ? 'checked' : '' }} checked>
                                    <label for="description" style="margin-left: 20px; font-size:15px;">Description</label>
                                    <div class="" id="">
                                        <input class="form-check-input product_incl_qua_rate" style="margin-left: 22px" type="checkbox" id="check_incl_qua_rate" value="1" {{ old('check_incl_qua_rate', 1) == 0 ? 'checked' : '' }}>
                                        <label for="incl_des_here" style="margin-left: 40px; font-size:11px;">Include Quantity and Rate</label>
                                    </div>
                                </div><hr>
                                <div class="" id="">
                                    <input class="form-check-input product_quantity" style="margin-left: 0.5px" type="checkbox" id="check_product_quantity" value="1" {{ old('check_product_quantity', 1) == 0 ? 'checked' : '' }} checked>
                                    <label for="quantity" style="margin-left: 20px; font-size:15px;">Quantity</label>
                                </div><hr>
                                <div class="" id="">
                                    <input class="form-check-input product_rate" style="margin-left: 0.5px" type="checkbox" id="check_product_rate" value="1" {{ old('check_product_rate', 1) == 0 ? 'checked' : '' }} checked>
                                    <label for="rate" style="margin-left: 20px; font-size:15px;">Rate</label>
                                </div><hr>
                                <div class="" id="">
                                    <input class="form-check-input product_amount" style="margin-left: 0.5px" type="checkbox" id="check_product_amount" value="1" {{ old('check_product_amount', 1) == 0 ? 'checked' : '' }} checked>
                                    <label for="amount" style="margin-left: 20px; font-size:15px;">Amount</label>
                                </div><hr>
                                <div class="" id="">
                                    <input class="form-check-input product_sku" style="margin-left: 0.5px" type="checkbox" id="check_product_sku" value="1" {{ old('check_product_sku', 1) == 0 ? 'checked' : '' }}>
                                    <label for="sku" style="margin-left: 20px; font-size:15px;">SKU</label>
                                </div>

                            </div>
                            
                        </div>
                        <div class="footer_content">
                            <div class="hidden_footer_click d-none" style="margin-top: 10px;">
                                <span>Footer</span>
                            </div><hr>
                            <div class="hidden_footer_click d-none" style="margin-top: 15px;">
                                <span>Display</span>
                                <div class="" id="">
                                    <input class="form-check-input product_discount" style="margin-left: 0.5px" type="checkbox" id="check_product_discount" value="1" {{ old('check_product_discount', 1) == 0 ? 'checked' : '' }}>
                                    <label for="discount" style="margin-left: 20px; font-size:12px;">Discount</label>
                                </div>
                                <div class="" id="">
                                    <input class="form-check-input product_deposit" style="margin-left: 0.5px" type="checkbox" id="check_product_deposit" value="1" {{ old('check_product_deposit', 1) == 0 ? 'checked' : '' }}>
                                    <label for="deposit" style="margin-left: 20px; font-size:12px;">Deposit</label>
                                </div>
                            </div>
                            <div class="hidden_footer_click d-none" style="margin-top: 15px;">
                                <span>Message to customer on</span>
                                <div class="form-group">
                                    <select class="form-control select {{ $errors->has('state') ? 'is-invalid' : '' }}" name="message" id="message">
                                     <option value="">Invoices and other sales forms</option>  
                                     <option value="">Estimates</option> 
                                    </select>  
                                </div>
                                <div class="form-group" id="">
                                    <textarea class="form-control" style="width: 100%" id="message_customer_invoices" cols="30" rows="10" placeholder="We appreciate your business and look forward to helping you again soon.">{{ isset($template_properties->Footer->message_invoice) ? $template_properties->Footer->message_invoice: '' }}</textarea>
                                </div>
                                <div class="" style="margin-left: 500px;margin-top: 100px;" id="unhide_save_btn">
                                    <button class="btn btn-success update_header_content_btn" id="update_header_content_btn">Done</button>
                                </div> 
                               
 
                            </div>
                            


                        </div>    
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="email_content">
                             <div class="hidden_footer_click" style="margin-top: 10px;">
                                 <span style="font-weight: bolder">Sales form type</span>
                                 <div class="row">
                                     <div class="form-group col-md-4" style="margin-top: 10px" >
                                         <select class="form-control select {{ $errors->has('state') ? 'is-invalid' : '' }}" name="sale_form_type" id="sale_form_type">
                                         <option value="1">Invoices</option>  
                                         <option value="2">Estimates</option> 
                                         <option value="3">Sales Receipt</option>
                                         </select>  
                                     </div>
                                 </div>
                                 <div style="margin-left:25px">
                                     <span class="email_cursor" id="appearence_email"><i class="bi bi-caret-down-fill right_arrow_appearence"></i><i class="bi bi-caret-right-fill down_arrow_appearence d-none"></i> How your invoice appears in emails</span><br>
                                     <div class="hide_email_appearence">
                                         <input type="radio" name="" id="full_details_email"><label style="margin-left: 5px">Full details</label><br>
                                         <input type="radio" name="" id="summarized_details_email"><label style="margin-left: 5px">Summarized details</label><br>
                                         <input class="form-check-input" style="margin-left: 0.5px" type="checkbox" id="check_attachment_invo_pdf" value="1" {{ old('check_product_discount', 1) == 0 ? 'checked' : '' }}>
                                         <label for="check_attachment_invo_pdf" style="margin-left: 20px; font-size:12px;">Attach PDF version of invoice</label>
                                     </div>
                                 </div>
 
                             </div><hr>
 
                             <div style="margin-left:25px">
                                 <span class="email_cursor" id="standard_email"><i class="bi bi-caret-down-fill right_arrow_standard"></i><i class="bi bi-caret-right-fill down_arrow_standard d-none"></i> Standard email</span><br>
                                     <div class="hide_email_standard">
                                         <small>Edit the email your customers get with every sent form</small>
                                         <div class="form-group">
                                             <label for="">Subject</label>
                                             <input class="form-control" type="text" name="email_subject" id="email_subject" value="{{ isset($email_content_properties->StandardEmail->standard_email_subject) ? $email_content_properties->StandardEmail->standard_email_subject: '' }}">
                                         </div>
                                         <div class="row">
                                             <div class="form-group col-md-3" id="" style="margin-top: 10px">
                                                 <input class="form-check-input" style="margin-left: 0.5px" type="checkbox" id="check_standard_greeting" value="1" {{ old('check_product_discount', 1) == 0 ? 'checked' : '' }} checked>
                                                 <label for="discount" style="margin-left: 20px; font-size:12px;">Use greeting</label>
                                             </div>
                                         
                                             <div class="form-group col-md-3" style="margin-top: 10px" >
                                                 <select class="form-control select {{ $errors->has('state') ? 'is-invalid' : '' }}" name="" id="choose_standard_greeting">
                                                 <option value="1">Blank</option>  
                                                 <option value="2">To</option> 
                                                 <option value="3">Dear</option>
                                                 </select>  
                                             </div>
                                             <div class="form-group col-md-6" style="margin-top: 10px" >
                                                 <select class="form-control select {{ $errors->has('state') ? 'is-invalid' : '' }}" name="message" id="choose_standard_greeting_name">
                                                 <option value="1">[First][Last]</option>  
                                                 <option value="2">[Title][Last]</option> 
                                                 <option value="3">[First]</option>
                                                 <option value="4">[Full Name]</option>
                                                 <option value="5">[Company Name]</option>
                                                 <option value="6">[Display Name]</option> 
                                                 </select>  
                                             </div>
                                         </div>
                                
                                         <span style="font-weight: bolder">Message to customer</span>
                                         <div class="form-group" id="" style="margin-top:10px">
                                             <textarea class="form-control" style="width: 100%" id="message_standard_email" cols="61" rows="8" placeholder="We appreciate your business. Please find your invoice details here. Feel free to contact us if you have any questions.">{{ isset($email_content_properties->StandardEmail->message_standard_email) ? $email_content_properties->StandardEmail->message_standard_email: '' }}</textarea>
                                         </div>
                                         </div><hr>
 
                                     <div class="">
                                         <span class="email_cursor" id="reminder_email"><i class="bi bi-caret-down-fill right_arrow_reminder d-none"></i><i class="bi bi-caret-right-fill down_arrow_reminder"></i> Reminder email</span><br>
                                         <div class="hide_email_reminder d-none">
                                         <small>Edit the reminder email your customers receive for invoices</small>
                                
                                         <div class="form-group">
                                             <label for="">Subject</label>
                                             <input class="form-control" type="text" name="email_subject" id="email_reminder_subject" value="{{ isset($email_content_properties->ReminderEmail->email_reminder_subject) ? $email_content_properties->ReminderEmail->email_reminder_subject: '' }}">
                                         </div>
                                         <div class="row">
                                             <div class="form-group col-md-3" id="" style="margin-top: 10px">
                                                 <input class="form-check-input" style="margin-left: 0.5px" type="checkbox" id="check_reminder_greeting" value="1" {{ old('check_product_discount', 1) == 0 ? 'checked' : '' }} checked>
                                                 <label for="discount" style="margin-left: 20px; font-size:12px;">Use greeting</label>
                                             </div>
                                             
                                                 <div class="form-group col-md-3" style="margin-top: 10px" >
                                                     <select class="form-control select {{ $errors->has('state') ? 'is-invalid' : '' }}" name="message" id="choose_reminder_greeting">
                                                      <option value="1">Blank</option>  
                                                      <option value="2">To</option> 
                                                      <option value="3">Dear</option>
                                                     </select>  
                                                 </div>
                                                 <div class="form-group col-md-6" style="margin-top: 10px" >
                                                     <select class="form-control select {{ $errors->has('state') ? 'is-invalid' : '' }}" name="message" id="choose_reminder_greeting_name">
                                                      <option value="1">[First][Last]</option>  
                                                      <option value="2">[Title][Last]</option> 
                                                      <option value="3">[First]</option>
                                                      <option value="4">[Full Name]</option>
                                                      <option value="5">[Company Name]</option>
                                                      <option value="6">[Display Name]</option> 
                                                     </select>  
                                                 </div>
                                         </div>
                                            <span style="font-weight: bolder">Message to customer</span>
                                             <div class="form-group" id="" style="margin-top:10px">
                                                 <textarea class="form-control" style="width: 100%" id="message_reminder_email" cols="61" rows="8">{{ isset($email_content_properties->ReminderEmail->message_reminder_email) ? $email_content_properties->ReminderEmail->message_reminder_email: '' }}</textarea>
                                         </div>
                                    </div>     
                                 </div>
                             </div>
                                     
                                    
                                     <div class="" style="margin-left: 445px;margin-top: 50px;" id="unhide_save_btn">
                                         <button class="btn btn-success save_email_content_btn" id="save_email_content_btn">Done</button>
                                     </div> 
                                 
                             </div>
                            
                         </div>
                     </div>  
                 
            </div>
        </div>

        <div class="col-md-6 d-none" id="email_content" style="border-style: ridge;">
            <div class="" >
                <div style="margin-top:10px">
                <span >Subject: <span class="subject_email">{{ isset($email_content_properties->StandardEmail->standard_email_subject) ? $email_content_properties->StandardEmail->standard_email_subject: '' }}</span><span class="subject_reminder_email d-none">{{ isset($email_content_properties->ReminderEmail->email_reminder_subject) ? $email_content_properties->ReminderEmail->email_reminder_subject: '' }} </span></span><br>
                <span>From: quickbooks@notification.intuit.com</span>
                </div>
                <hr>
                <div class="emailer" style="padding: 40px;">
                    <h6 style="text-align: center">Invoice 123456</h6>
                    {{-- <div class="" style="text-align: center">
                        <img src="" alt="">
                    </div> --}}
                    <h5 style="text-align: center;color:#631859">{{$company->company_name}}</h5>
                    <div class="" style="text-align: center;background-color: rgb(221, 212, 220);padding:40px;">
                        <h6>Due:12/12/2023</h6>
                        <h2>$5454</h2>
                        <a href="" style="padding: 8px 22px;background:#631859;border-radius:5px;">Review to pay</a><br>
                        <small>Powered By Taxtube</small>
                    </div>
                    <div class="" style="margin-top: 10px">
                        <div class="standard_email_body">
                        <p class="standard_hide_greeting"><span class="standard_dear_greeting">Dear</span><span class="standard_to_greeting d-none">To</span> [customer <span class="standard_first_last_name d-none">first name last name</span> <span class="standard_title_last_name d-none"> title last name</span> <span class="standard_first_name d-none">first name</span> <span class="standard_company d-none">company name</span> <span class="standard_display_name d-none">display name</span> <span class="standard_full_name">full name</span>]</p>
                        <p class="standard_email_message">{{ isset($email_content_properties->StandardEmail->message_standard_email) ? $email_content_properties->StandardEmail->message_standard_email: '' }}</p>
                        </div>
                        <div class="reminder_email_body d-none">
                        <p class="reminder_hide_greeting"><span class="reminder_dear_greeting">Dear</span><span class="reminder_to_greeting d-none">To</span> [customer <span class="reminder_first_last_name d-none">first name last name</span> <span class="reminder_title_last_name d-none"> title last name</span> <span class="reminder_first_name d-none">first name</span> <span class="reminder_company d-none">company name</span> <span class="reminder_display_name d-none">display name</span> <span class="reminder_full_name">full name</span>]</p>
                        <p class="reminder_email_message">{{ isset($email_content_properties->ReminderEmail->message_reminder_email) ? $email_content_properties->ReminderEmail->message_reminder_email: '' }}</p>
                        </div>
                        <p>Have a great day!<br>BARGAIN TECHNOLOGIES INC</p>
                    </div>
                    <div class="full_details_email d-none">
                        <table style="width: 60%;margin:0 auto;border:1px solid #dedede;padding: 2px 6px;">
                            <tr>
                                <td style="width:49%; background:#fad3f5;padding: 2px 6px;"><b>Bill To</b></td>
                                <td style="width:49%; background:#fad3f5;padding: 2px 6px;"><b>Ship To</b></td>  
                                <td style="width:49%; background:#fad3f5;padding: 2px 6px;"><b>Ship date</b></td>                                         
                                <td style="width:49%; background:#fad3f5;padding: 2px 6px;"><b>Tracking no.</b></td>  
                                <td style="width:49%; background:#fad3f5;padding: 2px 6px;"><b>Terms</b></td>  
                                <td style="width:49%; background:#fad3f5;padding: 2px 6px;"><b>Item name</b></td>  
                                <td style="width:49%; background:#fad3f5;padding: 2px 6px;"><b>Item name</b></td>                                         
                            </tr> 
                            <tr>
                                <td style="width:49%;vertical-align: baseline;">
                                    Smith Co.
                                    Noida 201301
                                </td> 
                                <td style="width:49%;vertical-align: baseline;">
                                    Smith Co.
                                    Noida 201301
                                </td> 
                                <td style="width:49%;vertical-align: baseline;">
                                    01/03/2015
                                </td> 
                                <td style="width:49%;vertical-align: baseline;">
                                    12345678
                                </td> 
                                <td style="width:49%;vertical-align: baseline;">
                                    Net 30
                                </td>
                                <td style="width:49%;vertical-align: baseline;">
                                    ₹11450.00
                                </td> 
                                <td style="width:49%;vertical-align: baseline;">
                                    ₹15000.00
                                </td> 
                            </tr>                         
                        </table>
                    </div><hr>
                    <div style="text-align: center">
                        <p>{{$company->company_name}}</p>
                        <p>{{$company->address_line_1}} {{$company->address_line_2}}  {{$company->city->name}} {{$company->state->state}} {{$company->pin_code}}</p>
                        <p>{{$company_user->phone_no}} {{$company_user->email}}</p><hr>
                    </div>
                    <div>
                        <p>If you receive an email that seems fraudulent, please check with the business owner before paying.</p>    
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6" id="template_load">
           
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent
<script>
    // $(document).on('click', '#pills-profile-tab', function() {
       
    // });   
      $(document).on('click', '.select-invoice-box', function() {
        var temp_no = $(this).attr('template_no');
        var template_name_by_comp = $('#selected_company_id').val(); 
        $('#selected_template_no').val(temp_no);
        $('.select-invoice-box').removeClass('active');  
        $('.temp_no_'+temp_no).addClass('active'); 

       $.ajax({
        url:"{{ route('admin.invoiceCustomize.templateSet') }}",
        type:'get',
        data:{'temp_no':temp_no,
              'comp_id':template_name_by_comp,},
        success: function(data) {
                   if(data.length != 0){
                    $("#template_load").html(data);
                    var logo_align = $('#template_logo_alignment').val();
                    if(logo_align == 'left'){
                        $('#flex_left').removeAttr('hidden');
                        $('#flex_right').attr('hidden',true); 
                    }else{
                        $('#flex_right').removeAttr('hidden');
                        $('#flex_left').attr('hidden',true);
                    }
                    var target =  document.querySelector('.dz-image');
                    var cloned = target.cloneNode(true);
                    $('.output').append(cloned);
                }
            },
            error: function(error) {
                console.log(error, 'err');
                // alert("Error occured");
            }



       });

      });
      $(document).on('click', '.color', function() {
        var color_code = $(this).attr('color_code'); 
        $('#selected_template_color_code').val(color_code);
        document.getElementById('table_color_change').style.backgroundColor = color_code;
        document.getElementById('thead').style.backgroundColor = color_code;

      });
      function myFunction(selectTag) {
        var listValue = selectTag.options[selectTag.selectedIndex].text;
        $('#selected_template_font').val(listValue);
        document.getElementById("font_change").style.fontFamily = listValue;
      }
       
        $(document).ready( function(){
        var temp_no = $('#selected_template_no').val();
        $('.temp_no_'+temp_no).addClass('active'); 
        var template_name_by_comp = $('#selected_company_id').val();
        var temp_id = $('#selected_temp_id').val();
        
        $.ajax({
        url:"{{ route('admin.invoiceCustomize.email-content-properties') }}",
        type:'get',
        data:{'temp_id':temp_id,},
        success: function(data) {
        $('#sale_form_type').val(data.Header.sale_form_type).trigger('change');  
        $('#choose_standard_greeting').val(data.StandardEmail.standard_greeting).trigger('change');  
        $('#choose_standard_greeting_name').val(data.StandardEmail.standard_greeting_name).trigger('change');
        $('#choose_reminder_greeting').val(data.ReminderEmail.reminder_greeting).trigger('change');  
        $('#choose_reminder_greeting_name').val(data.ReminderEmail.reminder_greeting_name).trigger('change');  
        
        $.each(data.Header,function(index,value){
            
            // $('#country_id').val(data.Header.id).trigger('change');  
           if(value == 'false'){
            $("#"+index).removeAttr('checked',false);
           
           }else{
            $("#"+index).attr('checked',true);
           }

        });

        $.each(data.StandardEmail,function(index,value){
            if(value == 'false'){
                $('#'+index).removeAttr('checked',false);
            }else{
                $('#'+index).attr('checked',true);
            }
        });

        $.each(data.ReminderEmail,function(index,value){
            if(value == 'false'){
                $('#'+index).removeAttr('checked',false);
            }else{
                $('#'+index).attr('checked',true);
            }
        });

        },
            error: function(error) {
                console.log(error, 'err');
                // alert("Error occured");
            }
       });

       $.ajax({
        url:"{{ route('admin.invoiceCustomize.template-properties') }}",
        type:'get',
        data:{'temp_id':temp_id,},
        success: function(data) {
        $.each(data.Header,function(index,value){
           if(value == 'false'){
            $("."+index).removeAttr('checked',false);
           
           }else{
            $("."+index).attr('checked',true);
           }

        });

        $.each(data.Center,function(index,value){
            if(value == 'false'){
                $('.'+index).removeAttr('checked',false);
            }else{
                $('.'+index).attr('checked',true);
            }
        });

        $.each(data.Footer,function(index,value){
            if(value == 'false'){
                $('.'+index).removeAttr('checked',false);
            }else{
                $('.'+index).attr('checked',true);
            }
        });

        },
            error: function(error) {
                console.log(error, 'err');
                // alert("Error occured");
            }
       });
        $.ajax({
        url:"{{ route('admin.invoiceCustomize.templateSet') }}",
        type:'get',
        data:{'temp_no':temp_no,
              'comp_id':template_name_by_comp,},
        success: function(data) {
                   if(data.length != 0){
                    $("#template_load").html(data);
                    if($("#check_business_name").is(':checked')){
                        $(".company_name").removeClass('d-none');
                    }else{
                          $(".company_name").addClass('d-none');
                    }

                    if($("#check_phone").is(':checked')){
                        $(".phone_no").removeClass('d-none');
                    }else{
                        $(".phone_no").addClass('d-none');
                    }

                    if($("#check_email").is(':checked')){
                         $(".owner_org_email").removeClass('d-none');
                    }else{
                         $(".owner_org_email").addClass('d-none');
                    }

                    if($("#check_street_address").is(':checked')){
                        $(".hide_address").removeClass('d-none');
                    }else{
                        $(".hide_address").addClass('d-none');
                    }

                    if($("#check_website").is(':checked')){
                        $(".owner_website").removeClass('d-none');
                    }else{
                        $(".owner_website").addClass('d-none');
                    }

                    if($("#check_shipping_address").is(':checked')){
                        $(".ship_to").removeClass('d-none');
                    }else{
                        $(".ship_to").addClass('d-none');
                    }

                    if($("#check_terms").is(':checked')){
                        $(".terms_org").removeClass('d-none');
                    }else{
                        $(".terms_org").addClass('d-none');
                    }

                    if($("#check_due_date").is(':checked')){
                        $(".due_org_date").removeClass('d-none');
                    }else{
                        $(".due_org_date").addClass('d-none');
                    }

                    if($("#check_product_date").is(':checked')){
                        $(".product_org_date").removeClass('d-none');
                    }else{
                        $(".product_org_date").addClass('d-none');
                    }
                    if($("#check_product_service").is(':checked')){
                        $(".product_org_service").removeClass('d-none');
                    }else{
                        $(".product_org_service").addClass('d-none');
                    }

                    if($("#check_incl_des_here").is(':checked')){
                        $(".product_service1").removeClass('d-none');
                        $(".product_org_service").addClass('d-none');
                        $(".product_org_description").addClass('d-none');
                        $("#check_product_description").removeAttr('checked');

                    }else{
                        $(".product_service1").addClass('d-none');
                        $(".product_org_service").removeClass('d-none');
                        $(".product_org_description").removeClass('d-none');
                        $("#check_product_description").attr('checked',true);

                    }
                    if($("#check_incl_qua_rate").is(':checked')){
                        $(".product_description1").removeClass('d-none');
                        $(".product_org_quantity").addClass('d-none');
                        $(".product_org_description").addClass('d-none');
                        $(".product_org_rate").addClass('d-none');
                        $("#check_product_quantity").removeAttr('checked');
                        $("#check_product_rate").removeAttr('checked');

                    }else{
                        $(".product_description1").addClass('d-none');
                        $(".product_org_quantity").removeClass('d-none');
                        $(".product_org_rate").removeClass('d-none');
                        $(".product_org_description").removeClass('d-none');
                        $("#check_product_quantity").attr('checked',true);
                        $("#check_product_rate").attr('checked',true);

                    }

                    if($("#check_product_description").is(':checked')){
                        $(".product_org_description").addClass('d-none');

                        
                    }else{
                        $(".product_org_description").removeClass('d-none');
                    }

                    if($("#check_product_quantity").is(':checked')){
                        $(".product_org_quantity").removeClass('d-none');
                    }else{
                        $(".product_org_quantity").addClass('d-none');
                    }

                    if($("#check_product_rate").is(':checked')){
                        $(".product_org_rate").removeClass('d-none');
                    }else{
                        $(".product_org_rate").addClass('d-none');
                    }

                    if($("#check_product_amount").is(':checked')){
                        $(".product_org_amount").removeClass('d-none');
                    }else{
                        $(".product_org_amount").addClass('d-none');
                    }

                    if($("#check_product_sku").is(':checked')){
                        $(".product_org_sku").removeClass('d-none');
                    }else{
                        $(".product_org_sku").addClass('d-none');
                    }

                    if($("#check_product_discount").is(':checked')){
                        $(".product_org_discount").removeClass('d-none');
                    }else{
                        $(".product_org_discount").addClass('d-none');
                    }

                    if($("#check_product_deposit").is(':checked')){
                        $(".product_org_deposit").removeClass('d-none');
                    }else{
                        $(".product_org_deposit").addClass('d-none');
                    }
                    
                    var greeting_name = $("#choose_reminder_greeting_name").val();
                    if(greeting_name == 1){
                        $('.reminder_full_name').addClass('d-none');
                        $('.reminder_title_last_name').addClass('d-none');
                        $('.reminder_first_name').addClass('d-none');
                        $('.reminder_first_last_name').addClass('d-none');
                        $('.reminder_company').addClass('d-none'); 
                        $('.reminder_display_name').addClass('d-none');
                        $('.reminder_first_last_name').removeClass('d-none'); 
                    }else if(greeting_name == 2){
                        $('.reminder_full_name').addClass('d-none');
                        $('.reminder_title_last_name').addClass('d-none');
                        $('.reminder_first_last_name').addClass('d-none');
                        $('.reminder_first_name').addClass('d-none');
                        $('.reminder_company').addClass('d-none'); 
                        $('.reminder_display_name').addClass('d-none');
                        $('.reminder_title_last_name').removeClass('d-none'); 
                    }else if(greeting_name == 3){
                        $('.reminder_full_name').addClass('d-none');
                        $('.reminder_first_last_name').addClass('d-none');
                        $('.reminder_title_last_name').addClass('d-none');
                        $('.reminder_first_name').addClass('d-none');
                        $('.reminder_company').addClass('d-none'); 
                        $('.reminder_display_name').addClass('d-none');
                        $('.reminder_first_name').removeClass('d-none');
                        
                    }else if(greeting_name == 4){
                        $('.reminder_full_name').removeClass('d-none');
                        $('.reminder_first_name').addClass('d-none');
                        $('.reminder_first_last_name').addClass('d-none');
                        $('.reminder_title_last_name').addClass('d-none');
                        $('.reminder_first_name').addClass('d-none');
                        $('.reminder_company').addClass('d-none'); 
                        $('.reminder_display_name').addClass('d-none');

                    }else if(greeting_name == 5){
                        $('.reminder_full_name').addClass('d-none');
                        $('.reminder_title_last_name').addClass('d-none');
                        $('.reminder_first_last_name').addClass('d-none');
                        $('.reminder_first_name').addClass('d-none');
                        $('.reminder_company').addClass('d-none'); 
                        $('.reminder_display_name').addClass('d-none'); 
                        $('.reminder_company').removeClass('d-none');
                    }else if(greeting_name == 6){
                        $('.reminder_full_name').addClass('d-none');
                        $('.reminder_title_last_name').addClass('d-none');
                        $('.reminder_first_name').addClass('d-none');
                        $('.reminder_first_last_name').addClass('d-none');
                        $('.reminder_company').addClass('d-none'); 
                        $('.reminder_display_name').removeClass('d-none');
                    }

                    var greeting_name = $("#choose_standard_greeting_name").val();
                    if(greeting_name == 1){
                        $('.standard_full_name').addClass('d-none');
                        $('.standard_title_last_name').addClass('d-none');
                        $('.standard_first_name').addClass('d-none');
                        $('.standard_company').addClass('d-none'); 
                        $('.standard_display_name').addClass('d-none');
                        $('.standard_first_last_name').addClass('d-none');
                        $('.standard_first_last_name').removeClass('d-none'); 
                    }else if(greeting_name == 2){
                        $('.standard_full_name').addClass('d-none');
                        $('.standard_title_last_name').addClass('d-none');
                        $('.standard_first_name').addClass('d-none');
                        $('.standard_first_last_name').addClass('d-none');
                        $('.standard_company').addClass('d-none'); 
                        $('.standard_display_name').addClass('d-none');
                        $('.standard_title_last_name').removeClass('d-none'); 
                    }else if(greeting_name == 3){
                        $('.standard_full_name').addClass('d-none');
                        $('.standard_title_last_name').addClass('d-none');
                        $('.standard_first_name').addClass('d-none');
                        $('.standard_company').addClass('d-none'); 
                        $('.standard_display_name').addClass('d-none');
                        $('.standard_first_last_name').addClass('d-none');
                        $('.standard_first_name').removeClass('d-none');
                        
                    }else if(greeting_name == 4){
                        $('.standard_full_name').removeClass('d-none');
                        $('.standard_first_name').addClass('d-none');
                        $('.standard_title_last_name').addClass('d-none');
                        $('.standard_first_name').addClass('d-none');
                        $('.standard_company').addClass('d-none');
                        $('.standard_first_last_name').addClass('d-none'); 
                        $('.standard_display_name').addClass('d-none');

                    }else if(greeting_name == 5){
                        $('.standard_full_name').addClass('d-none');
                        $('.standard_title_last_name').addClass('d-none');
                        $('.standard_first_name').addClass('d-none');
                        $('.standard_company').addClass('d-none'); 
                        $('.standard_first_last_name').addClass('d-none');
                        $('.standard_display_name').addClass('d-none'); 
                        $('.standard_company').removeClass('d-none');
                    }else if(greeting_name == 6){
                        $('.standard_full_name').addClass('d-none');
                        $('.standard_title_last_name').addClass('d-none');
                        $('.standard_first_name').addClass('d-none');
                        $('.standard_first_last_name').addClass('d-none');
                        $('.standard_company').addClass('d-none'); 
                        $('.standard_display_name').removeClass('d-none');
                    }

                    var choose_reminder_greeting = $("#choose_reminder_greeting").val();
                    if(choose_reminder_greeting == 1){
                        $('.reminder_dear_greeting').addClass('d-none');
                        $('.reminder_to_greeting').addClass('d-none'); 
                    }else if(choose_reminder_greeting == 2){
                        $('.reminder_to_greeting').removeClass('d-none');
                        $('.reminder_dear_greeting').addClass('d-none'); 
                    }else if(choose_reminder_greeting == 3){
                        $('.reminder_dear_greeting').removeClass('d-none'); 
                        $('.reminder_to_greeting').addClass('d-none');
                    }

                    var choose_standard_greeting = $("#choose_standard_greeting").val();
                    if(choose_standard_greeting == 1){
                        $('.standard_dear_greeting').addClass('d-none');
                        $('.standard_to_greeting').addClass('d-none'); 
                    }else if(choose_standard_greeting == 2){
                        $('.standard_to_greeting').removeClass('d-none');
                        $('.standard_dear_greeting').addClass('d-none'); 
                    }else if(choose_standard_greeting == 3){
                        $('.standard_dear_greeting').removeClass('d-none'); 
                        $('.standard_to_greeting').addClass('d-none');
                    }

                    if($("#check_standard_greeting").is(':checked')){
                        $('.standard_hide_greeting').removeClass('d-none');
                    }else{
                        $('.standard_hide_greeting').addClass('d-none');
                    }

                     if($("#check_reminder_greeting").is(':checked')){
                        $('.reminder_hide_greeting').removeClass('d-none');
                    }else{
                        $('.reminder_hide_greeting').addClass('d-none');
                    }

                    $(document).on('click', '#pills-profile-tab', function() {
                        $('#header_div').css('opacity', '0.3');
                        $('#center_div').css('opacity', '0.3');
                        $('#footer_div').css('opacity','0.3');
                        $('.temp-edit-icon').removeClass('d-none')
                        $('#email_content').addClass('d-none');
                        $('#template_load').removeClass('d-none');
                    }); 

                    $(document).on('click', '#pills-home-tab', function() {
                        $('#header_div').css('opacity', '1');
                        $('#center_div').css('opacity', '1');
                        $('#footer_div').css('opacity','1');
                        $('.temp-edit-icon').addClass('d-none');
                        $('#email_content').addClass('d-none');
                        $('#template_load').removeClass('d-none');
                    }); 




                    var color_code = $('#selected_template_color_code').val();
                    document.getElementById('table_color_change').style.backgroundColor = color_code;
                    document.getElementById('thead').style.backgroundColor = color_code;

                    var listValue =  $('#selected_template_font').val();
                    document.getElementById("font_change").style.fontFamily = listValue;
                    var logo_align = $('#template_logo_alignment').val();
                    if(logo_align == 'left'){
                        $('#flex_left').removeAttr('hidden');
                        $('#flex_right').attr('hidden',true); 
                    }else{
                        $('#flex_right').removeAttr('hidden');
                        $('#flex_left').attr('hidden',true);
                    }
                    var target =  document.querySelector('.dz-image');
                    var cloned = target.cloneNode(true);
                    $('.output').append(cloned);
                    
                }
            },
            error: function(error) {
                console.log(error, 'err');
                // alert("Error occured");
            }



       });
        
        });

        $("#update_change").click(function(){
            // var imageElements = document.getElementsByTagName('img');
            // var clonedImage = originalImage.cloneNode(true);
            // clonedImage.id = 'cloned-image';
            // document.body.appendChild(clonedImage);
            
            var temp_id =  $('#selected_id').val();
            var template_name = $('#template_name').val();
            var temp_no = $('#selected_template_no').val();
            var color_code = $('#selected_template_color_code').val();
            var font = $('#selected_template_font').val();
            var comp_id = $('#selected_company_id').val();
            var img = $('#hidden_file').val();
            var logo_alignment = $('#template_logo_alignment').val();

            $.ajax({
                url: "{{ route('admin.invoiceCustomizeTemplate.update')}}",
                type: "post",
                data: {
                    '_token':$('input[name="_token"]').val(),
                    'template_name':template_name,
                    'temp_no':temp_no,
                    'logo_alignment':logo_alignment,
                    'temp_id':temp_id,
                    'color_code':color_code,
                    'font':font,
                    'company_id': comp_id,
                    'company_logo':img,
                },

                success: function(data) {
                   sweetAlert("Thanks", "Template Successfully Updated!", "success"); 
                },
                error: function(error) {
                    console.log(error, 'err');
                    alert("Error occured");
                }
            })
        });
        function move_img(str) {
            $('#template_logo_alignment').val(str);
            if(str == 'left'){
                $('#flex_left').removeAttr('hidden');
                $('#flex_right').attr('hidden',true);
            }else{
                $('#flex_right').removeAttr('hidden');
                $('#flex_left').attr('hidden',true);
                
            }
        }

        $(document).on('click', '#edit_content_header', function() {
           var business_name =  document.getElementById('company_name').innerText;
           var address_line1 =  document.getElementById('address_line1').innerText;
           var address_line2 =  document.getElementById('address_line2').innerText;
           var merged_address = address_line1+address_line2;
           var phone_no = document.getElementById('phone_no').innerText;
           var owner_email = document.getElementById('owner_email').innerText;
           var city = document.getElementById('city_id').innerText;
           var state = document.getElementById('state_id').innerText;
           var pin_code = document.getElementById('pin_code').innerText;
           $('#business_name').val(business_name);
           $('#phone').val(phone_no);
           $('#email').val(owner_email);
           $('#street_address').val(merged_address);
           $('#business_city').val(city).trigger('change');
           $('#business_state').val(state).trigger('change');  
           $('#business_pin_code').val(pin_code);

           $('.hidden_header_click').addClass('d-none');
           $('.center_content').addClass('d-none');
           $('.footer_content').addClass('d-none');
           $('.header_content').removeClass('d-none');
           $('#center_div').css('opacity', '0.3');
           $('#footer_div').css('opacity','0.3');
           $('#header_div').css('opacity','1');

        })
        $(document).on('click', '#unhide_address', function() {
          $('#unhide_street_address').removeClass('d-none');
          $('#unhide_address').addClass('d-none');
        });
        $(document).on('click', '#unhide_website', function() {
          $('#unhide_website1').removeClass('d-none');
          $('#unhide_website').addClass('d-none');
        });
 
        $("#check_business_name").change( function (){
            if($("#check_business_name").is(':checked')){
                $(".company_name").removeClass('d-none');
            }else{
                $(".company_name").addClass('d-none');
            }
        }); 
        
        $("#check_phone").change( function (){
            if($("#check_phone").is(':checked')){
                $(".phone_no").removeClass('d-none');
            }else{
                $(".phone_no").addClass('d-none');
            }
        }); 
        
        $("#check_email").change( function (){
            if($("#check_email").is(':checked')){
                $(".owner_org_email").removeClass('d-none');
            }else{
                $(".owner_org_email").addClass('d-none');
            }
        }); 
        $("#check_street_address").change( function (){
            if($("#check_street_address").is(':checked')){
                $(".hide_address").removeClass('d-none');
            }else{
                $(".hide_address").addClass('d-none');
            }
        }); 
        $("#check_website").change( function (){
            if($("#check_website").is(':checked')){
                $(".owner_website").removeClass('d-none');
            }else{
                $(".owner_website").addClass('d-none');
            }
        }); 
        $("#check_shipping_address").change( function (){
            if($("#check_shipping_address").is(':checked')){
                $(".ship_to").removeClass('d-none');
            }else{
                $(".ship_to").addClass('d-none');
            }
        }); 
        $("#check_terms").change( function (){
            if($("#check_terms").is(':checked')){
                $(".terms_org").removeClass('d-none');
            }else{
                $(".terms_org").addClass('d-none');
            }
        }); 
        $("#check_due_date").change( function (){
            if($("#check_due_date").is(':checked')){
                $(".due_org_date").removeClass('d-none');
            }else{
                $(".due_org_date").addClass('d-none');
            }
        });

        $("#business_name").change( function (){
           var message = $('#business_name').val();
           $('.company_name').text(message);
        }); 

        $("#phone").change( function (){
           var message = $('#phone').val();
           $('.phone_no').text(message);
        }); 
        $("#email").change( function (){
           var message = $('#email').val();
           $('.owner_org_email').text(message);
        });
        
        $("#street_address").change( function (){
           var message = $('#street_address').val();
           $('.address_line2').text(message);
        });

        // $("#business_city").change( function (){
        //    var message = $('#business_city').val();
        //    $('.city').text(message);
        // });

        // $("#business_state").change( function (){
        //    var message = $('#business_state').val();
        //    $('.state').val(state).trigger('change');  
        // });

        $("#business_pin_code").change( function (){
           var message = $('#business_pin_code').val();
           $('.pin_code').text(message);
        });

        $("#website").change( function (){
           var message = $('#website').val();
           $('.owner_website').text(message);
        }); 
        
        $(document).on('click', '#update_header_content_btn', function() {
            if($("#check_business_name").is(':checked')){
                var owner_business_name = 'true';
            }else{
                var owner_business_name = 'false';
            }
            if($("#check_phone").is(':checked')){
                var phone_org_no = 'true';
            }else{
                var phone_org_no = 'false';
            }
            if($("#check_email").is(':checked')){
                var owner_org_email = 'true';
            }else{
                var owner_org_email = 'false';
            }
            if($("#check_street_address").is(':checked')){
                var street_address = 'true';
            }else{
                var street_address = 'false';
            }
            if($("#check_website").is(':checked')){
                var website = 'true';
            }else{
                var website = 'false';
            }
            if($("#check_shipping_address").is(':checked')){
                var shipping_address = 'true';
            }else{
                var shipping_address = 'false';
            }
            if($("#check_terms").is(':checked')){
                var terms = 'true';
            }else{
                var terms = 'false';
            }
            if($("#check_due_date").is(':checked')){
                var due_date = 'true';
            }else{
                var due_date = 'false';
            }
            if($("#check_product_date").is(':checked')){
                var product_date = 'true';
            }else{
                var product_date = 'false';
            }
            if($("#check_product_service").is(':checked')){
                var product_service = 'true';
            }else{
                var product_service = 'false';
            }
            if($("#check_incl_des_here").is(':checked')){
                var product_incl_des_here = 'true';
            }else{
                var product_incl_des_here = 'false';
            }
            if($("#check_product_description").is(':checked')){
                var product_description = 'true';
            }else{
                var product_description = 'false';
            }
            if($("#check_incl_qua_rate").is(':checked')){
                var product_incl_qua_rate = 'true';
            }else{
                var product_incl_qua_rate = 'false';
            }
            if($("#check_product_quantity").is(':checked')){
                var product_quantity = 'true';
            }else{
                var product_quantity = 'false';
            }
            if($("#check_product_rate").is(':checked')){
                var product_rate = 'true';
            }else{
                var product_rate = 'false';
            }
            if($("#check_product_amount").is(':checked')){
                var product_amount = 'true';
            }else{
                var product_amount = 'false';
            }
            if($("#check_product_sku").is(':checked')){
                var product_sku = 'true';
            }else{
                var product_sku = 'false';
            }
            if($("#check_product_discount").is(':checked')){
                var product_discount = 'true';
            }else{
                var product_discount = 'false';
            }
            if($("#check_product_deposit").is(':checked')){
                var product_deposit = 'true';
            }else{
                var product_deposit = 'false';
            }

         var message = $('#message_customer_invoices').val();   
         var temp_id = $('#selected_temp_id').val();
         var template_aligned_content = document.getElementById('header_unhide').innerText;
         var comp_id =  document.getElementById('comp_id').innerText;
         var cust_id = document.getElementById('cust_id').innerText;
         var business_name = $("#business_name").val();
         var phone_no = $("#phone").val();
         var email = $("#email").val();
         var pin = $("#business_pin_code").val()
         var address_line1 = document.getElementById('address_line1').innerText;
         var address_line2 = document.getElementById('address_line2').innerText;
         var city = $("#business_city").val();
         var state = $("#business_state").val();
         $.ajax({
            url: "{{ route('admin.invoiceCustomize.update-template-content') }}",
            type: "post",
            data: {
            '_token': $('input[name="_token"]').val(),
            'company_id':comp_id,
            'temp_id':temp_id,
            'owner_id': cust_id,
            'comp_name':business_name,
            'email' : email,
            'phone' : phone_no,
            'address1':address_line1,
            'address2':address_line2,
            'pin_code':pin,
            'city_id':city,
            'state_id':state,
            'business_name':owner_business_name,
            'phone_org_no':phone_org_no,
            'owner_email':owner_org_email,
            'street_address':street_address,
            'website':website,
            'shipping_address':shipping_address,
            'terms':terms,
            'due_date':due_date,
            'content_template':template_aligned_content,
            'product_date':product_date,
            'product_service':product_service,
            'product_incl_des_here':product_incl_des_here,
            'product_description':product_description,
            'product_incl_qua_rate':product_incl_qua_rate,
            'product_quantity':product_quantity,
            'product_rate':product_rate,
            'product_amount':product_amount,
            'product_sku':product_sku,
            'product_discount':product_discount,
            'product_deposit':product_deposit,
            'message_invoice':message,
            },

            success: function(data) {
                console.log(data);
                sweetAlert('Success','Template Content Successfully Updated!','success');
            },
            error: function(error) {
                console.log(error, 'err');
                alert(error);
            }
        })
        })

        $(document).on('click', '#edit_content_center', function() {
          $('.hidden_center_click').removeClass('d-none');
          $('.hidden_header_click').addClass('d-none');
          $('.center_content').removeClass('d-none');
          $('.header_content').addClass('d-none');
          $('.footer_content').addClass('d-none');
          $('#header_div').css('opacity', '0.3');
          $('#center_div').css('opacity', '1');
          $('#footer_div').css('opacity','0.3');
          
        })

        $("#check_product_date").change( function (){
            if($("#check_product_date").is(':checked')){
                $(".product_org_date").removeClass('d-none');
            }else{
                $(".product_org_date").addClass('d-none');
            }
        }); 

        $("#check_product_service").change( function (){
            if($("#check_product_service").is(':checked')){
                $(".product_org_service").removeClass('d-none');
            }else{
                $(".product_org_service").addClass('d-none');
            }
        }); 

        $("#check_incl_des_here").change( function (){
            if($("#check_incl_des_here").is(':checked')){
                $(".product_service1").removeClass('d-none');
                $(".product_org_service").addClass('d-none');
                $(".product_org_description").addClass('d-none');
                $("#check_product_description").removeAttr('checked');

            }else{
                $(".product_service1").addClass('d-none');
                $(".product_org_service").removeClass('d-none');
                $(".product_org_description").removeClass('d-none');
                $("#check_product_description").attr('checked',true);

            }
        });

        $("#check_incl_qua_rate").change( function (){
            if($("#check_incl_qua_rate").is(':checked')){
                $(".product_description1").removeClass('d-none');
                $(".product_org_quantity").addClass('d-none');
                $(".product_org_description").addClass('d-none');
                $(".product_org_rate").addClass('d-none');
                $("#check_product_quantity").removeAttr('checked');
                $("#check_product_rate").removeAttr('checked');

            }else{
                $(".product_description1").addClass('d-none');
                $(".product_org_quantity").removeClass('d-none');
                $(".product_org_rate").removeClass('d-none');
                $(".product_org_description").removeClass('d-none');
                $("#check_product_quantity").attr('checked',true);
                $("#check_product_rate").attr('checked',true);

            }
        });


        $("#check_product_description").change( function (){
            if($("#check_product_description").is(':checked')){
                $(".product_org_description").removeClass('d-none');
            }else{
                $(".product_org_description").addClass('d-none');
            }
        }); 

        $("#check_product_quantity").change( function (){
            if($("#check_product_quantity").is(':checked')){
                $(".product_org_quantity").removeClass('d-none');
            }else{
                $(".product_org_quantity").addClass('d-none');
            }
        }); 

        $("#check_product_rate").change( function (){
            if($("#check_product_rate").is(':checked')){
                $(".product_org_rate").removeClass('d-none');
                
            }else{
                $(".product_org_rate").addClass('d-none');
               
            }
        }); 

        $("#check_product_amount").change( function (){
            if($("#check_product_amount").is(':checked')){
                $(".product_org_amount").removeClass('d-none');
            }else{
                $(".product_org_amount").addClass('d-none');
            }
        });

        $("#check_product_sku").change( function (){
            if($("#check_product_sku").is(':checked')){
                $(".product_org_sku").removeClass('d-none');
            }else{
                $(".product_org_sku").addClass('d-none');
            }
        });
        


        
        
        $(document).on('click', '#edit_content_footer', function() {
            $('.hidden_footer_click').removeClass('d-none');
            $('.footer_content').removeClass('d-none');
            $('.center_content').addClass('d-none');
            $('.header_content').addClass('d-none'); 
            $('#header_div').css('opacity', '0.3');
            $('#center_div').css('opacity', '0.3');
            $('#footer_div').css('opacity','1');
        })

        
        $("#check_product_discount").change( function (){
            if($("#check_product_discount").is(':checked')){
                $(".product_org_discount").removeClass('d-none');
            }else{
                $(".product_org_discount").addClass('d-none');
            }
        }); 

        $("#check_product_deposit").change( function (){
            if($("#check_product_deposit").is(':checked')){
                $(".product_org_deposit").removeClass('d-none');
            }else{
                $(".product_org_deposit").addClass('d-none');
            }
        }); 

        $("#message_customer_invoices").change( function (){
           var message = $('#message_customer_invoices').val();
           document.getElementById("paragraph_message").innerText = message;
        }); 

        $(document).on('click', '#pills-contact-tab', function() {
          
        
          $('#template_load').addClass('d-none');
          $('#email_content').removeClass('d-none');

      });

        var count = 0;
        $('#appearence_email').click( function(){
            count += 1;
  
            if(count%2 == 0){
                $('.hide_email_appearence').removeClass('d-none');
                $('.right_arrow_appearence').removeClass('d-none');
                $('.down_arrow_appearence').addClass('d-none');
            }else{
                $('.hide_email_appearence').addClass('d-none');
                $('.right_arrow_appearence').addClass('d-none');
                $('.down_arrow_appearence').removeClass('d-none');

            }
           

        })

        $('#standard_email').click( function(){
           $('.hide_email_standard').removeClass('d-none');
           $('.right_arrow_standard').removeClass('d-none');
           $('.down_arrow_standard').addClass('d-none'); 
           $('.hide_email_reminder').addClass('d-none');
           $('.right_arrow_reminder').addClass('d-none');
           $('.down_arrow_reminder').removeClass('d-none');
           $('.reminder_email_message').addClass('d-none'); 
           $('.standard_email_message').removeClass('d-none');
           $('.subject_reminder_email').addClass('d-none');
           $('.subject_email').removeClass('d-none');
           $('.standard_email_body').removeClass('d-none');
           $('.reminder_email_body').addClass('d-none');

        })

        $('#reminder_email').click( function(){
           $('.hide_email_reminder').removeClass('d-none');
           $('.right_arrow_reminder').removeClass('d-none');
           $('.down_arrow_reminder').addClass('d-none');
           $('.hide_email_standard').addClass('d-none');
           $('.right_arrow_standard').addClass('d-none');
           $('.down_arrow_standard').removeClass('d-none'); 
           $('.reminder_email_message').removeClass('d-none'); 
           $('.standard_email_message').addClass('d-none'); 
           $('.subject_email').addClass('d-none');
           $('.subject_reminder_email').removeClass('d-none');
           $('.standard_email_body').addClass('d-none');
           $('.reminder_email_body').removeClass('d-none');
        });

        $('#full_details_email').click( function(){
            document.getElementById("summarized_details_email").checked = false;
            $('.full_details_email').removeClass('d-none');
        });

        $('#summarized_details_email').click( function(){
            document.getElementById("full_details_email").checked = false;
            $('.full_details_email').addClass('d-none');
        });

        $("#check_standard_greeting").change( function (){
            if($("#check_standard_greeting").is(':checked')){
                $('.standard_hide_greeting').removeClass('d-none');
            }else{
                $('.standard_hide_greeting').addClass('d-none');
            }
        }); 

        $("#check_reminder_greeting").change( function (){
            if($("#check_reminder_greeting").is(':checked')){
                $('.reminder_hide_greeting').removeClass('d-none');
            }else{
                $('.reminder_hide_greeting').addClass('d-none');
            }
        }); 

        $('#choose_standard_greeting').change( function(){
            var choose_standard_greeting = $("#choose_standard_greeting").val();
            if(choose_standard_greeting == 1){
                $('.standard_dear_greeting').addClass('d-none');
                $('.standard_to_greeting').addClass('d-none'); 
            }else if(choose_standard_greeting == 2){
                $('.standard_to_greeting').removeClass('d-none');
                $('.standard_dear_greeting').addClass('d-none'); 
            }else if(choose_standard_greeting == 3){
                $('.standard_dear_greeting').removeClass('d-none'); 
                $('.standard_to_greeting').addClass('d-none');
            }
        });

        $('#choose_reminder_greeting').change( function(){
            var choose_reminder_greeting = $("#choose_reminder_greeting").val();
            if(choose_reminder_greeting == 1){
                $('.reminder_dear_greeting').addClass('d-none');
                $('.reminder_to_greeting').addClass('d-none'); 
            }else if(choose_reminder_greeting == 2){
                $('.reminder_to_greeting').removeClass('d-none');
                $('.reminder_dear_greeting').addClass('d-none'); 
            }else if(choose_reminder_greeting == 3){
                $('.reminder_dear_greeting').removeClass('d-none'); 
                $('.reminder_to_greeting').addClass('d-none');
            }
        });

        $('#choose_standard_greeting_name').change( function(){
            var greeting_name = $("#choose_standard_greeting_name").val();
            if(greeting_name == 1){
                $('.standard_full_name').addClass('d-none');
                $('.standard_title_last_name').addClass('d-none');
                $('.standard_first_name').addClass('d-none');
                $('.standard_company').addClass('d-none'); 
                $('.standard_display_name').addClass('d-none');
                $('.standard_first_last_name').addClass('d-none');
                $('.standard_first_last_name').removeClass('d-none'); 
            }else if(greeting_name == 2){
                $('.standard_full_name').addClass('d-none');
                $('.standard_title_last_name').addClass('d-none');
                $('.standard_first_name').addClass('d-none');
                $('.standard_first_last_name').addClass('d-none');
                $('.standard_company').addClass('d-none'); 
                $('.standard_display_name').addClass('d-none');
                $('.standard_title_last_name').removeClass('d-none'); 
            }else if(greeting_name == 3){
                $('.standard_full_name').addClass('d-none');
                $('.standard_title_last_name').addClass('d-none');
                $('.standard_first_name').addClass('d-none');
                $('.standard_company').addClass('d-none'); 
                $('.standard_display_name').addClass('d-none');
                $('.standard_first_last_name').addClass('d-none');
                $('.standard_first_name').removeClass('d-none');
                
            }else if(greeting_name == 4){
                $('.standard_full_name').removeClass('d-none');
                $('.standard_first_name').addClass('d-none');
                $('.standard_title_last_name').addClass('d-none');
                $('.standard_first_name').addClass('d-none');
                $('.standard_company').addClass('d-none');
                $('.standard_first_last_name').addClass('d-none'); 
                $('.standard_display_name').addClass('d-none');

            }else if(greeting_name == 5){
                $('.standard_full_name').addClass('d-none');
                $('.standard_title_last_name').addClass('d-none');
                $('.standard_first_name').addClass('d-none');
                $('.standard_company').addClass('d-none'); 
                $('.standard_first_last_name').addClass('d-none');
                $('.standard_display_name').addClass('d-none'); 
                $('.standard_company').removeClass('d-none');
            }else if(greeting_name == 6){
                $('.standard_full_name').addClass('d-none');
                $('.standard_title_last_name').addClass('d-none');
                $('.standard_first_name').addClass('d-none');
                $('.standard_first_last_name').addClass('d-none');
                $('.standard_company').addClass('d-none'); 
                $('.standard_display_name').removeClass('d-none');
            }
        });

        $('#choose_reminder_greeting_name').change( function(){
            var greeting_name = $("#choose_reminder_greeting_name").val();
            if(greeting_name == 1){
                $('.reminder_full_name').addClass('d-none');
                $('.reminder_title_last_name').addClass('d-none');
                $('.reminder_first_name').addClass('d-none');
                $('.reminder_first_last_name').addClass('d-none');
                $('.reminder_company').addClass('d-none'); 
                $('.reminder_display_name').addClass('d-none');
                $('.reminder_first_last_name').removeClass('d-none'); 
            }else if(greeting_name == 2){
                $('.reminder_full_name').addClass('d-none');
                $('.reminder_title_last_name').addClass('d-none');
                $('.reminder_first_last_name').addClass('d-none');
                $('.reminder_first_name').addClass('d-none');
                $('.reminder_company').addClass('d-none'); 
                $('.reminder_display_name').addClass('d-none');
                $('.reminder_title_last_name').removeClass('d-none'); 
            }else if(greeting_name == 3){
                $('.reminder_full_name').addClass('d-none');
                $('.reminder_first_last_name').addClass('d-none');
                $('.reminder_title_last_name').addClass('d-none');
                $('.reminder_first_name').addClass('d-none');
                $('.reminder_company').addClass('d-none'); 
                $('.reminder_display_name').addClass('d-none');
                $('.reminder_first_name').removeClass('d-none');
                
            }else if(greeting_name == 4){
                $('.reminder_full_name').removeClass('d-none');
                $('.reminder_first_name').addClass('d-none');
                $('.reminder_first_last_name').addClass('d-none');
                $('.reminder_title_last_name').addClass('d-none');
                $('.reminder_first_name').addClass('d-none');
                $('.reminder_company').addClass('d-none'); 
                $('.reminder_display_name').addClass('d-none');

            }else if(greeting_name == 5){
                $('.reminder_full_name').addClass('d-none');
                $('.reminder_title_last_name').addClass('d-none');
                $('.reminder_first_last_name').addClass('d-none');
                $('.reminder_first_name').addClass('d-none');
                $('.reminder_company').addClass('d-none'); 
                $('.reminder_display_name').addClass('d-none'); 
                $('.reminder_company').removeClass('d-none');
            }else if(greeting_name == 6){
                $('.reminder_full_name').addClass('d-none');
                $('.reminder_title_last_name').addClass('d-none');
                $('.reminder_first_name').addClass('d-none');
                $('.reminder_first_last_name').addClass('d-none');
                $('.reminder_company').addClass('d-none'); 
                $('.reminder_display_name').removeClass('d-none');
            }
        });

        $("#email_subject").change( function (){
           var message = $('#email_subject').val();
           $('.subject_email').text(message);
           
        }); 

        $("#email_reminder_subject").change( function (){
           var message = $('#email_reminder_subject').val();
           $('.subject_reminder_email').text(message);
          
        }); 


        $("#message_standard_email").change( function (){
           var message = $('#message_standard_email').val();
           $('.standard_email_message').text(message);
        });
        
        $("#message_reminder_email").change( function (){
           var message = $('#message_reminder_email').val();
           $('.reminder_email_message').text(message);
        });

        $(document).on('click', '#save_email_content_btn', function() {
            if($("#full_details_email").is(':checked')){
                var full_details_email = 'true';
            }else{
                var full_details_email = 'false';
            }
            if($("#summarized_details_email").is(':checked')){
                var summarized_details_email = 'true';
            }else{
                var summarized_details_email = 'false';
            }
            if($("#check_attachment_invo_pdf").is(':checked')){
                var check_attachment_invo_pdf = 'true';
            }else{
                var check_attachment_invo_pdf = 'false';
            }
            if($("#check_standard_greeting").is(':checked')){
                var check_standard_greeting = 'true';
            }else{
                var check_standard_greeting = 'false';
            }
            if($("#check_reminder_greeting").is(':checked')){
                var check_reminder_greeting = 'true';
            }else{
                var check_reminder_greeting = 'false';
            }
            var comp_id =  document.getElementById('comp_id').innerText;
            var sale_form_type = $('#sale_form_type').val();   
            var standard_email_subject = $('#email_subject').val(); 
            var standard_greeting = $('#choose_standard_greeting').val();
            var standard_greeting_name = $('#choose_standard_greeting_name').val();
            var message_standard_email = $('#message_standard_email').val();

            var email_reminder_subject = $('#email_reminder_subject').val(); 
            var reminder_greeting = $('#choose_reminder_greeting').val();
            var reminder_greeting_name = $('#choose_reminder_greeting_name').val();
            var message_reminder_email = $('#message_reminder_email').val();
         $.ajax({
            url: "{{ route('admin.invoiceCustomize.save-email-content') }}",
            type: "post",
            data: {
            '_token': $('input[name="_token"]').val(),
            'company_id':comp_id,
            'sale_form_type':sale_form_type,
            'full_details_email':full_details_email,
            'summarized_details_email':summarized_details_email,
            'check_attachment_invo_pdf':check_attachment_invo_pdf,

            'standard_email_subject':standard_email_subject,
            'check_standard_greeting':check_standard_greeting,
            'standard_greeting':standard_greeting,
            'standard_greeting_name':standard_greeting_name,
            'message_standard_email':message_standard_email,

            'email_reminder_subject':email_reminder_subject,
            'check_reminder_greeting':check_reminder_greeting,
            'reminder_greeting':reminder_greeting,
            'reminder_greeting_name':reminder_greeting_name,
            'message_reminder_email':message_reminder_email,

            },

            success: function(data) {
                sweetAlert('Success','Template Content Successfully Updated!','success');
            },
            error: function(error) {
                console.log(error, 'err');
                alert(error);
            }
        })
        })



        Dropzone.options.companyLogoDropzone = {
            url: '{{ route('admin.companies.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="company_logo"]').remove()
                $('form').append('<input type="hidden" id="hidden_file" name="company_logo" value="' + response.name + '">')
                var target =  document.querySelector('.dz-image');
                var cloned = target.cloneNode(true);
                $('.output').append(cloned);
 

            },
            removedfile: function(file) {
                file.previewElement.remove()
                $('.dz-image').remove();
                if (file.status !== 'error') {
                    $('form').find('input[name="company_logo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($template) && $template->company_logo)
                    var file = {!! json_encode($template->company_logo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="company_logo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
       

</script>
@endsection