<!--upper-bar-->
{{-- @inject('settings', 'App\Models\AppSetting') --}}
<div class="upper-bar">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="language">
                    <a href="index.html" class="ar active">عربى</a>
                    <a href="index-ltr.html" class="en inactive">EN</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="social">
                    <div class="icons">
                        <a href="{{ $settings->facebook }}" class="facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ $settings->instagram }}" class="instagram"><i class="fab fa-instagram"></i></a>
                        <a href="{{ $settings->twitter }}" class="twitter"><i class="fab fa-twitter"></i></a>
                        <a href="{{ $settings->youtube }}" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            <!-- not a member-->
            @if (!Auth::guard('clients')->check() && !Auth::guard('web')->check())
                <div class="col-lg-4">
                    <div class="info" dir="ltr">
                        <div class="phone">
                            <i class="fas fa-phone-alt"></i>
                            <p>+2{{ $settings->phone }}</p>
                        </div>
                        <div class="e-mail">
                            <i class="far fa-envelope"></i>
                            <p>{{ $settings->email }}</p>
                        </div>
                    </div>
                @else
                    <div class="member">
                        <p class="welcome">مرحباً بك</p>&nbsp;
                        <div class="dropdown">

                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{-- @if(Auth::check()) --}}
                                    @if (Auth::guard('clients')->check())
                                        {{ Auth::guard('clients')->user()->name }}
                                        <i class="fas fa-chevron-down"></i>
                                    @elseif(Auth::guard('web')->check())
                                        {{ Auth::guard('web')->user()->name }}
                                        <i class="fas fa-chevron-down"></i>
                                    @endif
                                {{-- @endif --}}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="index-1.html">
                                    <i class="fas fa-home"></i>
                                    الرئيسية
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="far fa-user"></i>
                                    معلوماتى
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="far fa-bell"></i>
                                    اعدادات الاشعارات
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="far fa-heart"></i>
                                    المفضلة
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="far fa-comments"></i>
                                    ابلاغ
                                </a>
                                <a class="dropdown-item" href="contact-us.html">
                                    <i class="fas fa-phone-alt"></i>
                                    تواصل معنا
                                </a>
                                @if (Auth::guard('clients')->check() && Auth::guard('web')->check())
                                    <a class="dropdown-item" href="{{ route('client.logout') }}"
                                        onclick="event.preventDefault();
                                              document.getElementById('client-logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="client-logout-form" action="{{ route('client.logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                @else
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                @endif
                                </a>
                            </div>

                        </div>
                    </div>
            @endif


        </div>
    </div>
</div>
</div>


<!--nav-->
<div class="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('imgs/logo.png') }}" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{url('')}}">الرئيسية <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">عن بنك الدم</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">المقالات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('requests') }}">طلبات التبرع</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('who-are-us') }}">من نحن</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('contact') }}">اتصل بنا</a>
                    </li>
                </ul>
                {{-- {{Auth::check()}} --}}
                <!--not a member-->
                @if (!Auth::guard('clients')->check() && !Auth::guard('web')->check())
                    <div class="accounts">
                        <!-- Authentication Links -->

                        @if (Route::has('client.login-view'))
                            <a href="{{ route('client.login-view') }}" class="signin">الدخول</a>
                        @endif

                        @if (Route::has('client.register-view'))
                            <a href="{{ route('client.register-view') }}" class="create">إنشاء حساب جديد</a>
                        @endif

                        {{-- @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="signin">الدخول</a>
                        @endif

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="create">إنشاء حساب جديد</a>
                        @endif --}}

                    </div>
                @else
                    <!--I'm a member-->

                    <a href="{{ url('create-account') }}" class="donate">
                        <img src="{{asset('imgs/transfusion.svg')}}">
                        <p>طلب تبرع</p>
                    </a>

                @endif
            </div>
        </div>
    </nav>
</div>
