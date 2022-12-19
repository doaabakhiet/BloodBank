@extends('layouts.home')

@section('content')
    <div class="signin-account">
        <!--form-->
        <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
                        </ol>
                    </nav>
                </div>
                <div class="signin-form">
                    @include('flash::message')
                    @isset($route)
                        <form method="POST" action="{{ $route }}">
                        @else
                            <form method="POST" action="{{ route('password.update') }}">
                            @endisset
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                   
                            <div class="row mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                    autofocus placeholder="البريد الالكترونى">
                                @error('email')
                                    <strong><label class="text-danger">{{ $message }}</label></strong>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <input type="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="تأكيد كلمة المرور" name="password" autocomplete="new-password">

                                @error('password')
                                    <strong><label class="text-danger">{{ $message }}</label></strong>
                                @enderror
                            </div>
                            @isset($route)
                                <div class="row mb-3">
                                    <input type="password" class="form-control" id="exampleInputPasswordConfirmation1"
                                        placeholder="تأكيد كلمة المرور" name="password_confirmation"
                                        autocomplete="new-password">
                                </div>
                            @else
                                <div class="row mb-3">
                                    <input type="password" class="form-control" id="exampleInputPasswordConfirmation1"
                                        placeholder="تأكيد كلمة المرور" name="password_confirmation"
                                        autocomplete="new-password">
                                    @error('password_confirmation')
                                        <strong><label class="text-danger">{{ $message }}</label></strong>
                                    @enderror
                                </div>
                            @endisset
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

@endsection
