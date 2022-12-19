@extends('layouts.home')

@section('content')
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $title ?? '' }} {{ __('Login') }}</div>

                    <div class="card-body">
                        @isset($route)
                            <form method="POST" action="{{ $route }}">
                            @else
                                <form method="POST" action="{{ route('login') }}">
                                @endisset

                                @csrf

                                <div class="row mb-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

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
                    @isset($route)
                        <form method="POST" action="{{ $route }}">
                        @else
                            <form method="POST" action="{{ route('login') }}">
                            @endisset

                            @csrf
                            <div class="logo">
                                <img src="imgs/logo.png">
                            </div>
                            @isset($route)
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputphone1"
                                        aria-describedby="phoneHelp" placeholder="الجوال" name="phone">
                                    @error('phone')
                                        <strong><label class="text-danger">{{ $message }}</label></strong>
                                    @enderror
                                </div>
                            @endisset

                            @isset($route)
                            @else
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="بريد الكترونى">
                                    @error('email')
                                        <strong><label class="text-danger">{{ $message }}</label></strong>
                                    @enderror
                                </div>
                            @endisset
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="كلمة المرور">
                                @error('password')
                                    <strong><label class="text-danger">{{ $message }}</label></strong>
                                @enderror
                            </div>


                            <div class="row options">
                                <div class="col-md-6 remember">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">تذكرنى</label>
                                    </div>
                                </div>
                                <div class="col-md-6 forgot">
                                    <img src="{{ asset('imgs/complain.png') }}">
                                    @isset($route)
                                            <a class="btn btn-link" href="{{ route('client.send-email') }}">
                                                هل نسيت كلمة المرور
                                            </a>
                                    @else
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                هل نسيت كلمة المرور
                                            </a>
                                        @endif
                                    @endisset
                                    {{-- <a href="#">هل نسيت كلمة المرور</a> --}}
                                </div>
                            </div>
                            <div class="row buttons">
                                <div class="col-md-6 right">
                                    <button type="submit" class="btn btn-success w-100">دخول</bu>
                                </div>
                                <div class="col-md-6 left">
                                    <a href="{{ route('client.login-view') }}">انشاء حساب جديد</a>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
