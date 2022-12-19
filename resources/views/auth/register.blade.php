@extends('layouts.home')

@section('content')
    <div class="create">
        <!--form-->
        <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title ?? '' }} انشاء حساب جديد</li>
                        </ol>
                    </nav>
                </div>
                <div class="account-form">
                    @isset($route)
                        <form method="POST" action="{{ $route }}">
                        @else
                            <form method="POST" action="{{ route('register') }}">
                            @endisset
                            @csrf

                            <div class="row mb-3">
                                <input type="text" class="form-control" id="exampleInputName1"
                                    aria-describedby="NameHelp" placeholder="الإسم" name="name"
                                    value="{{ old('name') }}" autocomplete="name" autofocus>
                                @error('name')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="البريد الإلكترونى" name="email"
                                    value="{{ old('email') }}" autocomplete="email">
                                @error('email')
                                    <strong><label class="text-danger">{{ $message }}</label></strong>
                                @enderror
                            </div>
                            @isset($route)
                                <div class="row mb-3">
                                    <input placeholder="تاريخ الميلاد" class="form-control" type="text"
                                        onfocus="(this.type='date')" id="birthdate" name="birthdate">
                                    @error('birthdate')
                                        <strong><label class="text-danger">{{ $message }}</label></strong>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <select class="form-control" id="bloodtypes" name="bloodtype_id">
                                        <option selected disabled hidden value="">فصيلة الدم</option>
                                        @foreach ($bloodtypes as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('bloodtype_id')
                                        <strong><label class="text-danger">{{ $message }}</label></strong>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <select class="form-control governorates" name="governate_id" onchange="(this.value);">
                                        <option selected disabled hidden value="">المحافظة</option>
                                        @foreach ($governorates as $item)
                                            <option class="govOption" value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('governate_id')
                                        <strong><label class="text-danger">{{ $message }}</label></strong>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <select class="form-control" id="cities" name="city_id">
                                        <option selected disabled hidden value="">المدينة</option>

                                    </select>
                                    @error('city_id')
                                        <strong><label class="text-danger">{{ $message }}</label></strong>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <input type="text" class="form-control" id="exampleInputphone1"
                                        aria-describedby="phoneHelp" placeholder="رقم الهاتف" name="phone"
                                        autocomplete="new-phone">

                                    @error('phone')
                                        <strong><label class="text-danger">{{ $message }}</label></strong>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <input placeholder="آخر تاريخ تبرع" class="form-control" type="text"
                                        onfocus="(this.type='date')" id="date" name="lastdonation_date"
                                        autocomplete="new-phone">
                                    @error('lastdonation_date')
                                        <strong><label class="text-danger">{{ $message }}</label></strong>
                                    @enderror
                                </div>
                            @endisset
                            <div class="row mb-3">
                                <input type="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="كلمة المرور" name="password" autocomplete="new-password">
                                @error('password')
                                    <strong><label class="text-danger">{{ $message }}</label></strong>
                                @enderror
                            </div>
                            @isset($route)
                                <div class="row mb-3">
                                    <input type="password" class="form-control" id="exampleInputPasswordConfirmation1"
                                        placeholder="تأكيد كلمة المرور" name="password_confirmation"
                                        autocomplete="new-password">
                                    @error('password_confirmation')
                                        <strong><label class="text-danger">{{ $message }}</label></strong>
                                    @enderror
                                </div>
                            @else
                                <div class="row mb-3">
                             
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password" placeholder="تأكيد كلمة المرور" >
                                    </div>
                                </div>
                            @endisset
                            <div class="create-btn">
                                <input type="submit" value="إنشاء"></input>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('select').on('change', function() {
                var govId = this.value;
                var select = $('#cities');
                $.ajax({
                    type: "POST",
                    url: "{{ url('get-governorate-cities') }}",
                    data: {
                        'gov_id': govId
                    },
                    success: function(response) {
                        // console.log(response);


                        var htmlOptions = [];
                        html = '<option selected disabled hidden value="">المدينة</option>';
                        if (response.length) {
                            for (item in response) {
                                html += '<option value="' + response[item].id + '">' + response[
                                        item]
                                    .name + '</option>';
                                htmlOptions[htmlOptions.length] = html;
                            }
                            select.empty().append(htmlOptions.join(''));
                        }
                        // else {
                        //     htmlOptions[htmlOptions.length] = html;
                        //     select.empty().append(htmlOptions.join(''));
                        // }
                    }
                });
            });
        });
    </script>
@endpush



{{-- 
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
