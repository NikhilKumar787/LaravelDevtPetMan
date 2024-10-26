@extends('layouts.frontend')
@section('styles')
    <style>
        .main-sidebar{
            display: none
        }
        .content-wrapper, .content-wrapper, .main-footer, .main-header{
            margin: 0
        }
        label{
            font-size: 14px
        }
        .form-control:active, .form-control:focus{
        box-shadow: 0 0 0 2px rgb(161 161 161 / 25%);
        border-color: #2CA01C;
        }
        .main-header{
            display: none
        }
        .content{
            padding-top: -20px
        }

    </style>
@endsection
@section('content')



<nav id="navbar-example2" class="navbar navbar-light bg-white">
    <a class="navbar-brand" href="#"><img width="140" src="{{asset('img/logo.png')}}" alt=""></a>
    <ul class="nav nav-pills">
      <li class="nav-item dropdown">
        <a class="dropdown-toggle bg-transparent p-0 text-dark" data-toggle="dropdown" href="#" role="button" aria-expanded="false">My Account</a>
        <div class="dropdown-menu">
          {{-- <a class="dropdown-item" href="#one">My Profile</a>
          <a class="dropdown-item" href="#two">Setting</a> --}}
          {{-- <div role="separator" class="dropdown-divider"></div> --}}
          <a class="dropdown-item" href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Logout</a>
        </div>
      </li>
    </ul>
  </nav>
  <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
 </form>

<div class="px-4 py-4" style="background: #ebfff0;" id="steps">
    <div class="bg-white p-4 mx-auto shadow-sm" style="max-width: 1000px" id="step1">
        <div class="">
            <h4 class="text-center">USER DETAILS</h4>
        </div>
        <div class="container slider-one-active">
            <div class="steps">
            <div class="step step-one">
                <div class="liner"></div>
                <span>Step 1</span>
            </div>
            <div class="step step-two">
                <div class="liner"></div>
                <span>Step 1</span>
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
            <div class="progress-width"></div>
            </div>
        </div>
        <form method="POST" action="{{route('frontend.profile.edit')}}" enctype="multipart/form-data" id="step1-form">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required" for="name">Name</label>
                    <input class="form-control " type="text" name="name" id="name" value="{{ isset($user->name)? $user->name:''}}" required="">
                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="email">Email</label>
                    <input class="form-control " type="email" name="email" id="email" value="{{ isset($user->email)? $user->email:''}}" required="">
                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="phone_no">Contact No.</label>
                    <input class="form-control " type="text" name="phone_no" id="phone_no" value="{{ isset($user->phone_no)? $user->phone_no:''}}" required="">
                    <span class="help-block"> </span>
                </div>
                <div class="form-group col-md-12">
                    <label for="identity_proof">Identity Proof</label>
                    <div class="needsclick dropzone dz-clickable" id="identity_proof-dropzone">
                    {{-- <div class="dz-default dz-message"><span>Drop files here to upload</span></div> --}}
                </div>
                    <span class="help-block">Aadhaar Card / Passport / Driving License / Voter Identity Card</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="address_proof">Address Proof</label>
                    <div class="needsclick dropzone dz-clickable" id="address_proof-dropzone">
                    {{-- <div class="dz-default dz-message"><span>Drop files here to upload</span></div> --}}
                </div>
                    <span class="help-block">Any one of the Document not older than 2 months</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="passport_size_photo">Passport Size Photo</label>
                    <div class="needsclick dropzone dz-clickable" id="passport_size_photo-dropzone">
                    {{-- <div class="dz-default dz-message"><span>Drop files here to upload</span></div> --}}
                    </div>
                    <span class="help-block"> </span>
                </div>

            </div>


            <div class="text-center bg-white mt-2">
                <button class="btn btn-success" id="user_save" type="submit">
                    Save & Continue to step 2
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
@section('scripts')
<script>
        $(document).on('submit', "#step1-form", function (e) {
            e.preventDefault();
            var name= $("#name").val();
            var email= $("#email").val();
            var phone_no= $("#phone_no").val();
            var identity_proof_arr = [];
            var address_proof_arr = [];
            var passport_size_photo = $("input[name='passport_size_photo']").val();
            $("input[name='identity_proof[]']").each(function(){
                identity_proof_arr.push($(this).val())
            });
            $("input[name='address_proof[]']").each(function(){
                address_proof_arr.push($(this).val())
            });

            $.ajax({
                url: "{{ route('frontend.profile.storeStep1')}}",
                type: "post",
                data: {'name':name,'email':email,'phone_no':phone_no,'passport_size_photo':passport_size_photo,'identity_proof':identity_proof_arr,'address_proof':address_proof_arr,'_token':$('input[name="_token"]').val()},
                success: function(data) {
                    $("#steps").html(data)
                    changeCity()
                    stampSign()
                    $('#stamp_and_sign-dropzone').dropzone()
                    $('#msme_registration_certificate-dropzone').dropzone()
                    $('#shop_establishment_certificate-dropzone').dropzone()
                    $('#address_proof-dropzone').dropzone()
                    $('#copy_of_pan_tan-dropzone').dropzone()
                    $('#gst_certificate-dropzone').dropzone()
                    $('#vat_certficate-dropzone').dropzone()
                },
                error: function(error) {
                    console.log(error, 'err');
                    alert("Error occured");
                }
            })

        });

        $(document).ready(function(){
            Dropzone.autoDiscover = false;
            $(document).on('change',"#gstin", function(){
                var gst_no = $(this).val();
                var test_gst = /^([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([0-9]){1}([a-zA-Z]){1}([0-9]){1}?$/;
                if(test_gst.test(gst_no)) {
                    $("#gst_error").text('');
                    $.ajax({
                        url: "{{ route('frontend.customers.gst')}}",
                        type: "get",
                        data: {'gst_no':gst_no,'_token':$('input[name="_token"]').val()},
                        success: function(data) {
                            console.log(data)
                            $("#address_line_1").val(data.taxpayerInfo.pradr.addr.bno)
                            $("#address_line_2").val(data.taxpayerInfo.pradr.addr.loc + ', '+data.taxpayerInfo.pradr.addr.dst + ', '+data.taxpayerInfo.pradr.addr.stcd +', '+ data.taxpayerInfo.pradr.addr.pncd)
                            // $("#pin_code").val(data.taxpayerInfo.pradr.addr.pncd)
                            // $("#gst_customer_name").val(data.taxpayerInfo.lgnm)
                            // $("#pan_no").val(data.taxpayerInfo.panNo)
                            // $("#city_id").val(data.taxpayerInfo.pradr.addr.dst)
                            // $("#state_id").val(data.taxpayerInfo.pradr.addr.stcd)
                            $("#company_name").val(data.taxpayerInfo.tradeNam)


                        },
                        error: function(error) {
                            console.log(error, 'err');
                            alert("Error occured");
                        }
                    })

                }else{
                    flag = "Invalid GST number ";
                    $("#gst_error").text(flag).css('color','red');
                    //alert(flag);
                }



            })

            $(document).on('change',"#state_id", function(){
                    var state = $("#state_id").val();
                    $.ajax({
                        url: "{{ route('frontend.get-city')}}",
                        type: "get",
                        data: {'state':state,'_token':$('input[name="_token"]').val()},
                        success: function(data) {
                            if(data.length != 0){
                                    console.log(data)
                                    $.each(data,function(index,city){
                                    $('#city_id').append("<option value='"+city.id+"'>"+city.name+"</option> ");
                                    })
                            }
                        },
                        error: function(error) {
                            console.log(error, 'err');
                            alert("Error occured");
                        }
                    })
            });

            $(document).on('submit', "#step2-form", function (e) {

                e.preventDefault();

                    var username_for_pan_tan = $('#username_for_pan_tan').val();
                    var password_for_pan_tan = $('#password_for_pan_tan').val();
                    var username_for_gst_vat_icegate_dgft = $('#username_for_gst_vat_icegate_dgft').val();
                    var password_for_gst_vat_icegate_dgft = $('#password_for_gst_vat_icegate_dgft').val();
                    var username_for_e_way_e_invoicing = $('#username_for_e_way_e_invoicing').val();
                    var password_for_e_way_e_invoicing = $('#password_for_e_way_e_invoicing').val();
                    var username_for_traces = $('#username_for_traces').val();
                    var password_for_traces = $('#password_for_traces').val();
                    var username_for_pf_esi_and_other_labour_law = $('#username_for_pf_esi_and_other_labour_law').val();
                    var password_for_pf_esi_and_other_labour_law = $('#password_for_pf_esi_and_other_labour_law').val();
                    var username_for_reporting_portal = $('#username_for_reporting_portal').val();
                    var password_for_reporting_portal = $('#password_for_reporting_portal').val();
                    var company_name = $('#company_name').val();
                    var gstin = $('#gstin').val();
                    var address_line_1 = $('#address_line_1').val();
                    var address_line_2 = $('#address_line_2').val();
                    var state_id = $('#state_id').val();
                    var city_id = $('#city_id').val();
                    var cin = $('#cin').val();
                    var stamp_and_sign = $("input[name='stamp_and_sign']").val();
                    var msme_registration_certificate = $("input[name='msme_registration_certificate']").val();
                    var shop_establishment_certificate = $("input[name='shop_establishment_certificate']").val();
                    var address_proof = $("input[name='address_proof']").val();
                    var copy_of_pan_tan = $("input[name='copy_of_pan_tan']").val();
                    var gst_certificate = $("input[name='gst_certificate']").val();
                    var vat_certficate = $("input[name='vat_certficate']").val();


                    $.ajax({
                            url: "{{ route('frontend.profile.storeStep2')}}",
                            type: "post",
                            data: {
                                'username_for_pan_tan':username_for_pan_tan,
                                'password_for_pan_tan':password_for_pan_tan,
                                'username_for_gst_vat_icegate_dgft':username_for_gst_vat_icegate_dgft,
                                'password_for_gst_vat_icegate_dgft':password_for_gst_vat_icegate_dgft,
                                'username_for_e_way_e_invoicing':username_for_e_way_e_invoicing,
                                'password_for_e_way_e_invoicing':password_for_e_way_e_invoicing,
                                'username_for_traces':username_for_traces,
                                'password_for_traces':password_for_traces,
                                'username_for_pf_esi_and_other_labour_law':username_for_pf_esi_and_other_labour_law,
                                'password_for_pf_esi_and_other_labour_law':password_for_pf_esi_and_other_labour_law,
                                'username_for_reporting_portal':username_for_reporting_portal,
                                'password_for_reporting_portal':password_for_reporting_portal,
                                'company_name':company_name,
                                'gstin':gstin,
                                'address_line_1':address_line_1,
                                'address_line_2':address_line_2,
                                'state_id':state_id,
                                'city_id':city_id,
                                'cin':cin,
                                'stamp_and_sign':stamp_and_sign,
                                'msme_registration_certificate':msme_registration_certificate,
                                'shop_establishment_certificate':shop_establishment_certificate,
                                'address_proof':address_proof,
                                'copy_of_pan_tan':copy_of_pan_tan,
                                'gst_certificate':gst_certificate,
                                'vat_certficate':vat_certficate,
                                '_token':$('input[name="_token"]').val()
                            },
                            success: function(data) {
                                window.location.href = "{{ route('frontend.home')}}"

                            },
                            error: function(error) {
                                console.log(error, 'err'),
                                alert("Error occured");
                            }
                    })

            });
        });

        function changeCity()
        {
            $(document).ready(function(){
                var state = $("#state_value").val();
                var city_value = $("#city_value").val();

                if(state != '' && city_value != '')
                {
                    $.ajax({
                        type: 'GET',
                        url: "{{ route("frontend.part-city") }}",
                        data: {"state":state, "_token" : $('input[name="_token"]').val()},
                        success: function (result) {
                            if (result != '') {

                                if(result.length != 0){
                                    $.each(result,function(index,city){
                                        $('#city_id').append("<option value='"+city.id+"'>"+city.name+"</option> ");
                                    })

                                }
                                $("#city_id option[value='"+city_value+"']").prop("selected", true)

                            } else {
                                console.log(error, 'err');
                                alert("Error occured");
                            }
                        },
                        error: function (error) { // error callback
                            console.log(error, 'err');
                            alert("Error");
                        }
                    });
                }
            })
        }


</script>
<script>
    var uploadedIdentityProofMap = {}
    Dropzone.options.identityProofDropzone = {
        url: '{{ route('frontend.users.storeMedia') }}',
        maxFilesize: 2, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        addRemoveLinks: true,
        headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
        size: 2,
        width: 4096,
        height: 4096
        },
        success: function (file, response) {
        $('form').append('<input type="hidden" name="identity_proof[]" value="' + response.name + '">')
        uploadedIdentityProofMap[file.name] = response.name
        },
        removedfile: function (file) {
        console.log(file)
        file.previewElement.remove()
        var name = ''
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name
        } else {
            name = uploadedIdentityProofMap[file.name]
        }
        $('form').find('input[name="identity_proof[]"][value="' + name + '"]').remove()
        },
        init: function () {
        @if(isset($user) && $user->identity_proof)
            var files = {!! json_encode($user->identity_proof) !!}
                for (var i in files) {
                var file = files[i]
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="identity_proof[]" value="' + file.file_name + '">')
                }
        @endif
        },
        error: function (file, response) {
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
<script>
    var uploadedAddressProofMap = {}
    Dropzone.options.addressProofDropzone = {
        url: '{{ route('frontend.users.storeMedia') }}',
        maxFilesize: 2, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        addRemoveLinks: true,
        headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
        size: 2,
        width: 4096,
        height: 4096
        },
        success: function (file, response) {
        $('form').append('<input type="hidden" name="address_proof[]" value="' + response.name + '">')
        uploadedAddressProofMap[file.name] = response.name
        },
        removedfile: function (file) {
        console.log(file)
        file.previewElement.remove()
        var name = ''
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name
        } else {
            name = uploadedAddressProofMap[file.name]
        }
        $('form').find('input[name="address_proof[]"][value="' + name + '"]').remove()
        },
        init: function () {
        @if(isset($user) && $user->address_proof)
            var files = {!! json_encode($user->address_proof) !!}
                for (var i in files) {
                var file = files[i]
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="address_proof[]" value="' + file.file_name + '">')
                }
        @endif
        },
        error: function (file, response) {
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
<script>
    Dropzone.options.passportSizePhotoDropzone = {
        url: '{{ route('frontend.users.storeMedia') }}',
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
        success: function (file, response) {
        $('form').find('input[name="passport_size_photo"]').remove()
        $('form').append('<input type="hidden" name="passport_size_photo" value="' + response.name + '">')
        },
        removedfile: function (file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="passport_size_photo"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
        },
        init: function () {
        @if(isset($user) && $user->passport_size_photo)
            var file = {!! json_encode($user->passport_size_photo) !!}
                this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="passport_size_photo" value="' + file.file_name + '">')
            this.options.maxFiles = this.options.maxFiles - 1
        @endif
        },
        error: function (file, response) {
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
<script>
function stampSign()
{


    Dropzone.options.copyOfPanTanDropzone = {
        url: '{{ route('frontend.companies.storeMedia') }}',
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
        success: function (file, response) {
        $('form').find('input[name="copy_of_pan_tan"]').remove()
        $('form').append('<input type="hidden" name="copy_of_pan_tan" value="' + response.name + '">')
        },
        removedfile: function (file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="copy_of_pan_tan"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
        },
        init: function () {
            @if(isset($company) && $company->copy_of_pan_tan)
                var file = {!! json_encode($company->copy_of_pan_tan) !!}
                    this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="copy_of_pan_tan" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
            @else
                var pan_tan = $("#pan-tan").val();
                if(pan_tan != '')
                {
                    var file = $.parseJSON(pan_tan)
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('#step2-form').append('<input type="hidden" name="copy_of_pan_tan" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                }
            @endif
        },
        error: function (file, response) {
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

    Dropzone.options.stampAndSignDropzone = {
        url: '{{ route('frontend.companies.storeMedia') }}',
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
        success: function (file, response) {
          $('form').find('input[name="stamp_and_sign"]').remove()
          $('form').append('<input type="hidden" name="stamp_and_sign" value="' + response.name + '">')
        },
        removedfile: function (file) {
          file.previewElement.remove()
          if (file.status !== 'error') {
            $('form').find('input[name="stamp_and_sign"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
          }
        },
        init: function () {
            @if(isset($company) && $company->stamp_and_sign)
                var file = {!! json_encode($company->stamp_and_sign) !!}
                    this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="stamp_and_sign" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
            @else
                var stamp_sign = $("#stamp-and-sign").val();
                if(stamp_sign != '')
                {
                    var file = $.parseJSON(stamp_sign)
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('#step2-form').append('<input type="hidden" name="stamp_and_sign" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                }
            @endif
        },
        error: function (file, response) {
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

    Dropzone.options.gstCertificateDropzone = {
        url: '{{ route('frontend.companies.storeMedia') }}',
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
        success: function (file, response) {
        $('form').find('input[name="gst_certificate"]').remove()
        $('form').append('<input type="hidden" name="gst_certificate" value="' + response.name + '">')
        },
        removedfile: function (file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="gst_certificate"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
        },
        init: function () {
        @if(isset($company) && $company->gst_certificate)
            var file = {!! json_encode($company->gst_certificate) !!}
                this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="gst_certificate" value="' + file.file_name + '">')
            this.options.maxFiles = this.options.maxFiles - 1

        @else
                var gst_certifi = $("#gst-certificate").val();
                if(gst_certifi != '')
                {
                    var file = $.parseJSON(gst_certifi)
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('#step2-form').append('<input type="hidden" name="gst_certificate" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                }
        @endif
        },
        error: function (file, response) {
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

    Dropzone.options.vatCertficateDropzone = {
        url: '{{ route('frontend.companies.storeMedia') }}',
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
        success: function (file, response) {
        $('form').find('input[name="vat_certficate"]').remove()
        $('form').append('<input type="hidden" name="vat_certficate" value="' + response.name + '">')
        },
        removedfile: function (file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="vat_certficate"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
        },
        init: function () {
        @if(isset($company) && $company->vat_certficate)
            var file = {!! json_encode($company->vat_certficate) !!}
                this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="vat_certficate" value="' + file.file_name + '">')
            this.options.maxFiles = this.options.maxFiles - 1
        @else
                var vat_certfi = $("#vat-certficate").val();
                if(vat_certfi != '')
                {
                    var file = $.parseJSON(vat_certfi)
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('#step2-form').append('<input type="hidden" name="vat_certficate" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                }
        @endif
        },
        error: function (file, response) {
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

    Dropzone.options.msmeRegistrationCertificateDropzone = {
        url: '{{ route('frontend.companies.storeMedia') }}',
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
        success: function (file, response) {
        $('form').find('input[name="msme_registration_certificate"]').remove()
        $('form').append('<input type="hidden" name="msme_registration_certificate" value="' + response.name + '">')
        },
        removedfile: function (file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="msme_registration_certificate"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
        },
        init: function () {
        @if(isset($company) && $company->msme_registration_certificate)
            var file = {!! json_encode($company->msme_registration_certificate) !!}
                this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="msme_registration_certificate" value="' + file.file_name + '">')
            this.options.maxFiles = this.options.maxFiles - 1
        @else
                var msme_registration = $("#msme_registration-certificate").val();
                if(msme_registration != '')
                {
                    var file = $.parseJSON(msme_registration)
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('#step2-form').append('<input type="hidden" name="msme_registration_certificate" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                }
        @endif
        },
        error: function (file, response) {
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

    Dropzone.options.shopEstablishmentCertificateDropzone = {
        url: '{{ route('frontend.companies.storeMedia') }}',
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
        success: function (file, response) {
        $('form').find('input[name="shop_establishment_certificate"]').remove()
        $('form').append('<input type="hidden" name="shop_establishment_certificate" value="' + response.name + '">')
        },
        removedfile: function (file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="shop_establishment_certificate"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
        },
        init: function () {
        @if(isset($company) && $company->shop_establishment_certificate)
            var file = {!! json_encode($company->shop_establishment_certificate) !!}
                this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="shop_establishment_certificate" value="' + file.file_name + '">')
            this.options.maxFiles = this.options.maxFiles - 1
        @else
            var shop_establishment = $("#shop_establishment-certificate").val();
            if(shop_establishment != '')
            {
                var file = $.parseJSON(shop_establishment)
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview)
                file.previewElement.classList.add('dz-complete')
                $('#step2-form').append('<input type="hidden" name="shop_establishment_certificate" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
            }
        @endif
        },
        error: function (file, response) {
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

    Dropzone.options.addressProofDropzone = {
        url: '{{ route('frontend.companies.storeMedia') }}',
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
        success: function (file, response) {
        $('form').find('input[name="address_proof"]').remove()
        $('form').append('<input type="hidden" name="address_proof" value="' + response.name + '">')
        },
        removedfile: function (file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="address_proof"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
        },
        init: function () {
        @if(isset($company) && $company->address_proof)
            var file = {!! json_encode($company->address_proof) !!}
                this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="address_proof" value="' + file.file_name + '">')
            this.options.maxFiles = this.options.maxFiles - 1
        @else
            var address = $("#address-proof").val();
            if(address != '')
            {
                var file = $.parseJSON(address)
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview)
                file.previewElement.classList.add('dz-complete')
                $('#step2-form').append('<input type="hidden" name="address_proof" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
            }
        @endif
        },
        error: function (file, response) {
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
}
</script>
@endsection
