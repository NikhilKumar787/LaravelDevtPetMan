@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <div class="login-logo">
            <a href="#">
                <!-- {{ trans('panel.site_title') }} -->
                <img src="{{asset('img/logo.png')}}" width="" alt="razorpay">
            </a>
        </div>
    </div>
    <div class="card shadow-lg br-20">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{ trans('global.register') }}</p>
            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                @if(request()->has('team'))
                    <input type="hidden" name="team" id="team" value="{{ request()->query('team') }}">
                @endif
                <div>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone_no" id="phone_no" class="form-control{{ $errors->has('phone_no') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_phone_no') }}" value="{{ old('phone_no', null) }}">
                        @if($errors->has('phone_no'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone_no') }}
                            </div>
                        @endif
                        <span id="phone_no_error"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="{{ trans('global.login_password_confirmation') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            {{ trans('global.register') }}
                        </button>
                    </div>
                    <div class="col-12">
                    <p class="mb-1 mt-3">
                        <a class="text-center btn-outline btn-block" href="{{ route('login') }}">
                            {{ trans('global.login') }}
                        </a>
                    </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $("#phone_no").on('change',function()
    {
        var phone_no = $("#phone_no").val();
        var validateMobNum= /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
        if (validateMobNum.test(phone_no) && phone_no.length == 10) {
            $("#phone_no_error").text('');
        }
        else {
            $("#phone_no_error").text('Invalid Mobile Number').css('color','red');
        }
    })

</script>
@endsection
