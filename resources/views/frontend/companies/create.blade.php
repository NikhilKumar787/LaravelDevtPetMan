@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.company.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.companies.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="copy_of_pan_tan">{{ trans('cruds.company.fields.copy_of_pan_tan') }}</label>
                            <div class="needsclick dropzone" id="copy_of_pan_tan-dropzone">
                            </div>
                            @if($errors->has('copy_of_pan_tan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('copy_of_pan_tan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.copy_of_pan_tan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="gst_certificate">{{ trans('cruds.company.fields.gst_certificate') }}</label>
                            <div class="needsclick dropzone" id="gst_certificate-dropzone">
                            </div>
                            @if($errors->has('gst_certificate'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gst_certificate') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.gst_certificate_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="vat_certficate">{{ trans('cruds.company.fields.vat_certficate') }}</label>
                            <div class="needsclick dropzone" id="vat_certficate-dropzone">
                            </div>
                            @if($errors->has('vat_certficate'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('vat_certficate') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.vat_certficate_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="username_for_pan_tan">{{ trans('cruds.company.fields.username_for_pan_tan') }}</label>
                            <input class="form-control" type="text" name="username_for_pan_tan" id="username_for_pan_tan" value="{{ old('username_for_pan_tan', '') }}">
                            @if($errors->has('username_for_pan_tan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username_for_pan_tan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.username_for_pan_tan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="password_for_pan_tan">{{ trans('cruds.company.fields.password_for_pan_tan') }}</label>
                            <input class="form-control" type="text" name="password_for_pan_tan" id="password_for_pan_tan" value="{{ old('password_for_pan_tan', '') }}">
                            @if($errors->has('password_for_pan_tan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_for_pan_tan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.password_for_pan_tan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="username_for_gst_vat_icegate_dgft">{{ trans('cruds.company.fields.username_for_gst_vat_icegate_dgft') }}</label>
                            <input class="form-control" type="text" name="username_for_gst_vat_icegate_dgft" id="username_for_gst_vat_icegate_dgft" value="{{ old('username_for_gst_vat_icegate_dgft', '') }}">
                            @if($errors->has('username_for_gst_vat_icegate_dgft'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username_for_gst_vat_icegate_dgft') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.username_for_gst_vat_icegate_dgft_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="password_for_gst_vat_icegate_dgft">{{ trans('cruds.company.fields.password_for_gst_vat_icegate_dgft') }}</label>
                            <input class="form-control" type="text" name="password_for_gst_vat_icegate_dgft" id="password_for_gst_vat_icegate_dgft" value="{{ old('password_for_gst_vat_icegate_dgft', '') }}">
                            @if($errors->has('password_for_gst_vat_icegate_dgft'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_for_gst_vat_icegate_dgft') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.password_for_gst_vat_icegate_dgft_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="username_for_e_way_e_invoicing">{{ trans('cruds.company.fields.username_for_e_way_e_invoicing') }}</label>
                            <input class="form-control" type="text" name="username_for_e_way_e_invoicing" id="username_for_e_way_e_invoicing" value="{{ old('username_for_e_way_e_invoicing', '') }}">
                            @if($errors->has('username_for_e_way_e_invoicing'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username_for_e_way_e_invoicing') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.username_for_e_way_e_invoicing_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="password_for_e_way_e_invoicing">{{ trans('cruds.company.fields.password_for_e_way_e_invoicing') }}</label>
                            <input class="form-control" type="text" name="password_for_e_way_e_invoicing" id="password_for_e_way_e_invoicing" value="{{ old('password_for_e_way_e_invoicing', '') }}">
                            @if($errors->has('password_for_e_way_e_invoicing'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_for_e_way_e_invoicing') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.password_for_e_way_e_invoicing_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="username_for_traces">{{ trans('cruds.company.fields.username_for_traces') }}</label>
                            <input class="form-control" type="text" name="username_for_traces" id="username_for_traces" value="{{ old('username_for_traces', '') }}">
                            @if($errors->has('username_for_traces'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username_for_traces') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.username_for_traces_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="password_for_traces">{{ trans('cruds.company.fields.password_for_traces') }}</label>
                            <input class="form-control" type="text" name="password_for_traces" id="password_for_traces" value="{{ old('password_for_traces', '') }}">
                            @if($errors->has('password_for_traces'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_for_traces') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.password_for_traces_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="username_for_pf_esi_and_other_labour_law">{{ trans('cruds.company.fields.username_for_pf_esi_and_other_labour_law') }}</label>
                            <input class="form-control" type="text" name="username_for_pf_esi_and_other_labour_law" id="username_for_pf_esi_and_other_labour_law" value="{{ old('username_for_pf_esi_and_other_labour_law', '') }}">
                            @if($errors->has('username_for_pf_esi_and_other_labour_law'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username_for_pf_esi_and_other_labour_law') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.username_for_pf_esi_and_other_labour_law_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="password_for_pf_esi_and_other_labour_law">{{ trans('cruds.company.fields.password_for_pf_esi_and_other_labour_law') }}</label>
                            <input class="form-control" type="text" name="password_for_pf_esi_and_other_labour_law" id="password_for_pf_esi_and_other_labour_law" value="{{ old('password_for_pf_esi_and_other_labour_law', '') }}">
                            @if($errors->has('password_for_pf_esi_and_other_labour_law'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_for_pf_esi_and_other_labour_law') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.password_for_pf_esi_and_other_labour_law_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="username_for_reporting_portal">{{ trans('cruds.company.fields.username_for_reporting_portal') }}</label>
                            <input class="form-control" type="text" name="username_for_reporting_portal" id="username_for_reporting_portal" value="{{ old('username_for_reporting_portal', '') }}">
                            @if($errors->has('username_for_reporting_portal'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username_for_reporting_portal') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.username_for_reporting_portal_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="password_for_reporting_portal">{{ trans('cruds.company.fields.password_for_reporting_portal') }}</label>
                            <input class="form-control" type="text" name="password_for_reporting_portal" id="password_for_reporting_portal" value="{{ old('password_for_reporting_portal', '') }}">
                            @if($errors->has('password_for_reporting_portal'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_for_reporting_portal') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.password_for_reporting_portal_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="msme_registration_certificate">{{ trans('cruds.company.fields.msme_registration_certificate') }}</label>
                            <div class="needsclick dropzone" id="msme_registration_certificate-dropzone">
                            </div>
                            @if($errors->has('msme_registration_certificate'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('msme_registration_certificate') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.msme_registration_certificate_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="shop_establishment_certificate">{{ trans('cruds.company.fields.shop_establishment_certificate') }}</label>
                            <div class="needsclick dropzone" id="shop_establishment_certificate-dropzone">
                            </div>
                            @if($errors->has('shop_establishment_certificate'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('shop_establishment_certificate') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.shop_establishment_certificate_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address_proof">{{ trans('cruds.company.fields.address_proof') }}</label>
                            <div class="needsclick dropzone" id="address_proof-dropzone">
                            </div>
                            @if($errors->has('address_proof'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address_proof') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.address_proof_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="company_name">{{ trans('cruds.company.fields.company_name') }}</label>
                            <input class="form-control" type="text" name="company_name" id="company_name" value="{{ old('company_name', '') }}" required>
                            @if($errors->has('company_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.company_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="gstin">{{ trans('cruds.company.fields.gstin') }}</label>
                            <input class="form-control" type="text" name="gstin" id="gstin" value="{{ old('gstin', '') }}" required>
                            @if($errors->has('gstin'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gstin') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.gstin_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="address_line_1">{{ trans('cruds.company.fields.address_line_1') }}</label>
                            <input class="form-control" type="text" name="address_line_1" id="address_line_1" value="{{ old('address_line_1', '') }}" required>
                            @if($errors->has('address_line_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address_line_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.address_line_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="address_line_2">{{ trans('cruds.company.fields.address_line_2') }}</label>
                            <input class="form-control" type="text" name="address_line_2" id="address_line_2" value="{{ old('address_line_2', '') }}" required>
                            @if($errors->has('address_line_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address_line_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.address_line_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="city_id">{{ trans('cruds.company.fields.city') }}</label>
                            <select class="form-control select2" name="city_id" id="city_id">
                                @foreach($cities as $id => $entry)
                                    <option value="{{ $id }}" {{ old('city_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('city'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('city') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.city_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="state_id">{{ trans('cruds.company.fields.state') }}</label>
                            <select class="form-control select2" name="state_id" id="state_id">
                                @foreach($states as $id => $entry)
                                    <option value="{{ $id }}" {{ old('state_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('state'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('state') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.company.fields.state_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="cin">CIN</label>
                            <input class="form-control" type="text" name="cin" id="cin" value="{{ old('cin', '') }}" required>
                            @if($errors->has('cin'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cin') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="stamp_and_sign">Stamp and Signature</label>
                            <div class="needsclick dropzone" id="stamp_and_sign-dropzone">
                            </div>
                            @if($errors->has('stamp_and_sign'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('stamp_and_sign') }}
                                </div>
                            @endif
                            {{-- <span class="help-block">{{ trans('cruds.company.fields.copy_of_pan_tan_helper') }}</span> --}}
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
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

    $("#gstin").change(function(){
        var gst_no = $(this).val();
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


    })

</script>
<script>
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
@endsection
