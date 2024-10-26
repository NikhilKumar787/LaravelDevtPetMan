<div class="px-4 py-4" style="background:  #ebfff0;">
    <div class="mx-auto bg-white px-4 py-4" style="max-width: 1000px" id="step2">
        <div class="">
            <h4 class="text-center">COMPANY DETAILS</h4>
        </div>
        <div class="container slider-one-active">
            <div class="steps">
            <div class="step step-one">
                <div class="liner"></div>
                <span>Step 1</span>
            </div>
            <div class="step step-two">
                <div class="liner"></div>
                <span>Step 2</span>
            </div>
            <div class="step step-three">
                <div class="liner"></div>
                <span>Finish</span>
            </div>
            </div>
            <div class="line">
            <div class="dot-move"></div>
            <div class="dot zero"></div>
            <div class="dot center"></div>
            <div class="dot full"></div>
            <div class="progress-width w-100"></div>
            </div>
        </div>
        <form method="POST" action="{{route('frontend.companies.store')}}" enctype="multipart/form-data" class="bg-white" id="step2-form">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="username_for_pan_tan">Username For Pan Tan</label>
                    <input class="form-control " type="text" name="username_for_pan_tan" id="username_for_pan_tan" value="{{isset($company->username_for_pan_tan)?$company->username_for_pan_tan:''}}">
                                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="password_for_pan_tan">Password For Pan Tan</label>
                    <input class="form-control " type="text" name="password_for_pan_tan" id="password_for_pan_tan" value="{{isset($company->password_for_pan_tan)?$company->password_for_pan_tan:''}}">
                                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="username_for_gst_vat_icegate_dgft">Username For Gst Vat Icegate Dgft</label>
                    <input class="form-control " type="text" name="username_for_gst_vat_icegate_dgft" id="username_for_gst_vat_icegate_dgft" value="{{isset($company->username_for_gst_vat_icegate_dgft)?$company->username_for_gst_vat_icegate_dgft:''}}">
                                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="password_for_gst_vat_icegate_dgft">Password For Gst Vat Icegate Dgft</label>
                    <input class="form-control " type="text" name="password_for_gst_vat_icegate_dgft" id="password_for_gst_vat_icegate_dgft" value="{{isset($company->password_for_gst_vat_icegate_dgft)?$company->password_for_gst_vat_icegate_dgft:''}}">
                                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="username_for_e_way_e_invoicing">Username For E Way E Invoicing</label>
                    <input class="form-control " type="text" name="username_for_e_way_e_invoicing" id="username_for_e_way_e_invoicing" value="{{isset($company->username_for_e_way_e_invoicing)?$company->username_for_e_way_e_invoicing:''}}">
                                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="password_for_e_way_e_invoicing">Password For E Way E Invoicing</label>
                    <input class="form-control " type="text" name="password_for_e_way_e_invoicing" id="password_for_e_way_e_invoicing" value="{{isset($company->password_for_e_way_e_invoicing)?$company->password_for_e_way_e_invoicing:''}}">
                                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="username_for_traces">Username For Traces</label>
                    <input class="form-control " type="text" name="username_for_traces" id="username_for_traces" value="{{isset($company->username_for_traces)?$company->username_for_traces:''}}">
                                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="password_for_traces">Password For Traces</label>
                    <input class="form-control " type="text" name="password_for_traces" id="password_for_traces" value="{{isset($company->password_for_traces)?$company->password_for_traces:''}}">
                                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="username_for_pf_esi_and_other_labour_law">Username For Pf Esi And Other Labour Law</label>
                    <input class="form-control " type="text" name="username_for_pf_esi_and_other_labour_law" id="username_for_pf_esi_and_other_labour_law" value="{{isset($company->username_for_pf_esi_and_other_labour_law)?$company->username_for_pf_esi_and_other_labour_law:''}}">
                                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="password_for_pf_esi_and_other_labour_law">Password For Pf Esi And Other Labour Law</label>
                    <input class="form-control " type="text" name="password_for_pf_esi_and_other_labour_law" id="password_for_pf_esi_and_other_labour_law" value="{{isset($company->password_for_pf_esi_and_other_labour_law)?$company->password_for_pf_esi_and_other_labour_law:''}}">
                                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="username_for_reporting_portal">Username For Reporting Portal</label>
                    <input class="form-control " type="text" name="username_for_reporting_portal" id="username_for_reporting_portal" value="{{isset($company->username_for_reporting_portal)?$company->username_for_reporting_portal:''}}">
                                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="password_for_reporting_portal">Password For Reporting Portal</label>
                    <input class="form-control " type="text" name="password_for_reporting_portal" id="password_for_reporting_portal" value="{{isset($company->password_for_reporting_portal)?$company->password_for_reporting_portal:''}}">
                                    <span class="help-block"> </span>
                </div>

                <div class="form-group col-md-6">
                    <label for="msme_registration_certificate">Msme Registration Certificate</label>
                    <div class="needsclick dropzone dz-clickable" id="msme_registration_certificate-dropzone">
                    {{-- <div class="dz-default dz-message"><span>Drop files here to upload</span></div> --}}
                    </div>
                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="shop_establishment_certificate">Shop Establishment Certificate</label>
                    <div class="needsclick dropzone dz-clickable" id="shop_establishment_certificate-dropzone">
                    {{-- <div class="dz-default dz-message"><span>Drop files here to upload</span></div> --}}
                    </div>
                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="address_proof">Address Proof</label>
                    <div class="needsclick dropzone dz-clickable" id="address_proof-dropzone">
                    {{-- <div class="dz-default dz-message"><span>Drop files here to upload</span></div> --}}
                    </div>
                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="copy_of_pan_tan">Copy Of Pan Tan</label>
                    <div class="needsclick dropzone dz-clickable" id="copy_of_pan_tan-dropzone">
                        {{-- <div class="dz-default dz-message"><span>Drop files here to upload</span></div> --}}
                    </div>
                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="gst_certificate">Gst Certificate</label>
                    <div class="needsclick dropzone dz-clickable" id="gst_certificate-dropzone">
                    {{-- <div class="dz-default dz-message"><span>Drop files here to upload</span></div> --}}
                    </div>
                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="vat_certficate">Vat Certficate</label>
                    <div class="needsclick dropzone dz-clickable" id="vat_certficate-dropzone">
                    {{-- <div class="dz-default dz-message"><span>Drop files here to upload</span></div> --}}
                    </div>
                    <span class="help-block"> </span>
                </div>
                <input type="hidden" id="stamp-and-sign" value="{{isset($company->stamp_and_sign) ? json_encode($company->stamp_and_sign):''}}">
                <input type="hidden" id="msme_registration-certificate" value="{{isset($company->msme_registration_certificate) ? json_encode($company->msme_registration_certificate):''}}">
                <input type="hidden" id="shop_establishment-certificate" value="{{isset($company->shop_establishment_certificate) ? json_encode($company->shop_establishment_certificate):''}}">
                <input type="hidden" id="address-proof" value="{{isset($company->address_proof) ? json_encode($company->address_proof):''}}">
                <input type="hidden" id="pan-tan" value="{{isset($company->copy_of_pan_tan) ? json_encode($company->copy_of_pan_tan):''}}">
                <input type="hidden" id="gst-certificate" value="{{isset($company->gst_certificate) ? json_encode($company->gst_certificate):''}}">
                <input type="hidden" id="vat-certficate" value="{{isset($company->vat_certficate) ? json_encode($company->vat_certficate):''}}">
                <div class="form-group col-md-6">
                    <label class="required" for="company_name">Company Name</label>
                    <input class="form-control " type="text" name="company_name" id="company_name" value="{{isset($company->company_name)?$company->company_name:''}}" required="">
                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="gstin">Gstin</label>
                    <input class="form-control " type="text" name="gstin" id="gstin" value="{{isset($company->gstin)?$company->gstin:''}}" required="">
                    <span class="help-block" id="gst_error"></span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="address_line_1">Address Line 1</label>
                    <input class="form-control " type="text" name="address_line_1" id="address_line_1" value="{{isset($company->address_line_1)?$company->address_line_1:''}}" required="">
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="address_line_2">Address Line 2</label>
                    <input class="form-control " type="text" name="address_line_2" id="address_line_2" value="{{isset($company->address_line_2)?$company->address_line_2:''}}" required="">
                    <span class="help-block"></span>
                </div>

                <div class="form-group col-md-6">
                    <label class="required" for="state_id">State</label>
                    <select class="form-control select2" name="state_id" id="state_id" required="">
                        @foreach($states as $id => $entry)
                            <option value="{{ $id }}" {{ isset($company->state_id) && $company->state_id == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">{{ trans('cruds.company.fields.state_helper') }}</span>
                </div>
                <input type="hidden" id="state_value" value="{{isset($company->state_id) ? $company->state_id : ''}}">
                <div class="form-group col-md-6">
                    <label for="city_id">City</label>
                    <select class="form-control select2" name="city_id" id="city_id">
                        <option>Please Select</option>
                    </select>
                    <span class="help-block">{{ trans('cruds.company.fields.city_helper') }}</span>
                </div>
                <input type="hidden" id="city_value" value="{{isset($company->city_id) ? $company->city_id : ''}}">
                <div class="form-group col-md-6">
                    <label class="required" for="cin">CIN</label>
                    <input class="form-control " type="text" name="cin" id="cin" value="{{isset($company->cin)?$company->cin:''}}" required="">
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-12">
                    <label for="stamp_and_sign">Stamp and Signature</label>
                    <div class="needsclick dropzone" id="stamp_and_sign-dropzone">
                        {{-- <div class="dz-default dz-message"><span>Drop files here to upload</span></div> --}}
                    </div>
                    <span class="help-block"> </span>
                    </div>
                    @if($errors->has('stamp_and_sign'))
                        <div class="invalid-feedback">
                            {{ $errors->first('stamp_and_sign') }}
                        </div>
                    @endif
                    {{-- <span class="help-block">{{ trans('cruds.company.fields.copy_of_pan_tan_helper') }}</span> --}}
                </div>
                <div class="text-center bg-white mt-3">
                    {{-- <button class="btn btn-light" type="submit">
                    Previous Step
                    </button> --}}
                    <button class="btn btn-success" type="submit">
                        Save & Continue
                    </button>
                </div>


            </div>

        </form>
    </div>
</div>

