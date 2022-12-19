@extends('layouts.home')
@section('title')
    Blood Bank | Contact
@endsection
@section('content')
    <!--contact-us-->
    <div class="contact-us">
        <div class="contact-now">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">تواصل معنا</li>
                        </ol>
                    </nav>
                </div>
                <div class="row methods">
                    <div class="col-md-6">
                        <div class="call">
                            <div class="title">
                                <h4>اتصل بنا</h4>
                            </div>
                            <div class="content">
                                <div class="logo">
                                    <img src="imgs/logo.png">
                                </div>
                                <div class="details">
                                    <ul>
                                        <li><span>الجوال:</span> {{ $settings->phone }}</li>
                                        <li><span>فاكس:</span> 234234234</li>
                                        <li><span>البريد الإلكترونى:</span> {{ $settings->email }}</li>
                                    </ul>
                                </div>
                                <div class="social">
                                    <h4>تواصل معنا</h4>
                                    <div class="icons" dir="ltr">
                                        <div class="out-icon">
                                            <a href="{{ $settings->facebook }}"><img src="imgs/001-facebook.svg"></a>
                                        </div>
                                        <div class="out-icon">
                                            <a href="{{ $settings->twitter }}"><img src="imgs/002-twitter.svg"></a>
                                        </div>
                                        <div class="out-icon">
                                            <a href="{{ $settings->youtube }}"><img src="imgs/003-youtube.svg"></a>
                                        </div>
                                        <div class="out-icon">
                                            <a href="{{ $settings->instagram }}"><img src="imgs/004-instagram.svg"></a>
                                        </div>
                                        <div class="out-icon">
                                            <a href="#"><img src="imgs/005-whatsapp.svg"></a>
                                        </div>
                                        <div class="out-icon">
                                            <a href="#"><img src="imgs/006-google-plus.svg"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-form">
                            <div class="title">
                                <h4>تواصل معنا</h4>
                            </div>
                            <div class="fields">
                                @include('flash::message')
                                <form action="{{ url('contact-form') }}" method="post">
                                    @csrf
                                    @if(Auth::check())
                                        <input type="hidden" value="{{ Auth::user()->id }}" name="client_id" />
                                    @endif
                                    
                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                        placeholder="الجوال" name="title">
                                    @error('title')
                                        <strong><label class="text-danger">{{ $message }}</label></strong>
                                    @enderror
                                    {{-- <input type="text" class="form-control" id="exampleFormControlInput1"
                                        placeholder="عنوان الرسالة" name="title"> --}}
                                    <textarea name="content" placeholder="نص الرسالة" class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        name="text"></textarea>
                                    @error('content')
                                        <strong><label class="text-danger">{{ $message }}</label></strong>
                                    @enderror
                                    <button type="submit">ارسال</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
