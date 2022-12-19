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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('flash::message')
                    @isset($route)
                        <form method="POST" action="{{ $route }}">
                        @else
                            <form method="POST" action="{{ route('password.email') }}">
                            @endisset
                            @csrf
                            @isset($route)
                                <div class="row mb-3">
                                    <input type="text" class="form-control" id="exampleInputphone1"
                                        aria-describedby="phoneHelp" placeholder="الجوال" name="phone">
                                    @error('phone')
                                        <strong><label class="text-danger">{{ $message }}</label></strong>
                                    @enderror
                                </div>
                            @else
                                <div class="row mb-3">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <strong><label class="text-danger">{{ $message }}</label></strong>
                                    @enderror
                                </div>
                            @endisset


                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
