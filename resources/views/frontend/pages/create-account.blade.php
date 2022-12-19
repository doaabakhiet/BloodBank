@extends('layouts.home')
@section('title')
    Blood Bank | Create Account
@endsection
@section('content')
    <!--form-->
    <div class="create">
        <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                        </ol>
                    </nav>
                </div>
                <div class="account-form">
                    @include('flash::message')
                    <form action="{{ Route('create-donation') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{Auth::user()->id}}" name="client_id">
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="الإسم">
                        @error('name')
                            <strong><label class="text-danger">{{ $message }}</label></strong>
                        @enderror

                        <input type="number" name="age" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="العمر">
                        @error('age')
                            <strong><label class="text-danger">{{ $message }}</label></strong>
                        @enderror

                        <select class="form-control" id="bloodtypes" name="bloodtype_id">
                            <option selected disabled hidden value="">فصيلة الدم</option>
                            @foreach ($bloodtypes as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('bloodtype_id')
                            <strong><label class="text-danger">{{ $message }}</label></strong>
                        @enderror

                        <input type="number" name="num_of_bags" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="عدد الاكياس">
                        @error('num_of_bags')
                            <strong><label class="text-danger">{{ $message }}</label></strong>
                        @enderror

                        <select class="form-control governorates" name="governate_id" onchange="(this.value);">
                            <option selected disabled hidden value="">المحافظة</option>
                            @foreach ($governorates as $item)
                                <option class="govOption" value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('governate_id')
                            <strong><label class="text-danger">{{ $message }}</label></strong>
                        @enderror

                        <select class="form-control" id="cities" name="city_id">
                            <option selected disabled hidden value="">المدينة</option>

                        </select>
                        @error('city_id')
                            <strong><label class="text-danger">{{ $message }}</label></strong>
                        @enderror


                        <input type="text" name="longtitude" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="longtitude">
                        @error('longtitude')
                            <strong><label class="text-danger">{{ $message }}</label></strong>
                        @enderror

                        <input type="text" name="latitude" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="latitude">
                        @error('latitude')
                            <strong><label class="text-danger">{{ $message }}</label></strong>
                        @enderror

                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="رقم الهاتف">
                        @error('phone')
                            <strong><label class="text-danger">{{ $message }}</label></strong>
                        @enderror

                        <textarea name="notes" id="exampleInputEmail1" placeholder="ملاحظات" class="form-control" rows="10"></textarea>
                        @error('notes')
                            <strong><label class="text-danger">{{ $message }}</label></strong>
                        @enderror

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
                    }
                });
            });

            setTimeout(function() {
            $('.show-data .alert').fadeOut('fast');
        }, 7000);
        });
    </script>
@endpush
