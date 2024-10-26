@extends('layouts.app')
@section('content')
<style>
    .login-page, .register-page {
    background: #fff;    
}
.btn-customer, .btn-customer:hover{    
    background-color: #211b73;
    border-color: #211b73;
}
.customer-card{
    box-shadow: 0px 0px 27px 19px rgb( 83, 72, 227, .12 );
}
a {
    color: #211b73;
}
.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #211b73a3;
    outline: 0;
    box-shadow: inset 0 0 0 transparent, 0 0 0 0.2rem rgb(44 166 27 / 8%);
}
.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
    color: #fff;
    background-color: #211b73;
    border-color: #211b73;
    box-shadow: none
}
.btn-primary{    
    background-color: #211b73;
    border-color: #211b73;
}
.btn-outline, .btn-outline:hover {
    color: #211b73;
    background-color: #211b731c;
}


</style>
<div class="login-box">
    <div class="login-logo">
        <div class="login-logo">
            <a href="{{ route('admin.home') }}">
                <!-- {{ trans('panel.site_title') }} -->
                <img src="{{asset('img/logo.png')}}" width="" alt="razorpay">
            </a>
        </div>
    </div>
    <div class="card customer-card br-20">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                {{-- {{ trans('global.login') }} --}}
                Customer Login
            </p>

            @if(session()->has('message'))
                <p class="alert alert-info">
                    {{ session()->get('message') }}
                </p>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" name="email" value="{{ old('email', null) }}">

                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="form-group my-3">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ trans('global.login_password') }}">

                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>


                <div class="row">
                <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block btn-customer">
                            {{ trans('global.login') }}
                        </button>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">{{ trans('global.remember_me') }}</label>
                        </div>
                    </div>
                    <!-- /.col -->
                   
                    <!-- /.col -->
                </div>
            </form>


            @if(Route::has('password.request'))
                <p class="my-3 text-center">
                    <a href="{{ route('password.request') }}">
                        {{ trans('global.forgot_password') }}
                    </a>
                </p>
            @endif
            <p class="mb-1 mt-3">
                <a class="text-center btn-outline btn-block" href="{{ route('register') }}">
                    {{ trans('global.register') }}
                </a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection