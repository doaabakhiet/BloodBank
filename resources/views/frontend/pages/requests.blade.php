@extends('layouts.home')
@section('title')
    Blood Bank | Donation Requests
@endsection
@section('content')
    <!--inside-article-->
    <div class="donation-requests">
        <div class="all-requests">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
                        </ol>
                    </nav>
                </div>

                <!--requests-->
                <div class="requests">
                    <div class="head-text">
                        <h2>طلبات التبرع</h2>
                    </div>
                    <div class="content">
                        <div class="row filter">
                            <div class="col-md-5 blood">
                                <div class="form-group">
                                    <div class="inside-select">
                                        <select class="form-control bloodtype" id="exampleFormControlSelect1">
                                            <option selected disabled>اختر فصيلة الدم</option>
                                            <option value=null></option>
                                            @foreach ($bloodtypes as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 city">
                                <div class="form-group">
                                    <div class="inside-select">
                                        <select class="form-control governorate" id="exampleFormControlSelect1">
                                            <option selected disabled>اختر المحافظة</option>
                                            <option value=null></option>
                                            @foreach ($governorates as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 search">
                                <button type="button" class="searchDonation">
                                    <i class="fas fa-search"></i>
                                </button>
                                
                            </div>
                        </div>
                        <div class="patients">
                            @forelse($donationRequest as $item)
                                <div class="details">
                                    <div class="blood-type">
                                        <h2 dir="ltr">{{ $item->bloodtype->name }}</h2>
                                    </div>
                                    <ul>
                                        <li><span>اسم الحالة:</span>{{ $item->clients->name }} </li>
                                        <li><span>مستشفى:</span> القصر العينى</li>
                                        <li><span>المدينة:</span> {{ $item->cities->name }}</li>
                                    </ul>
                                    <a href="{{ url('donation-detail/' . $item->id) }}">التفاصيل</a>
                                </div>
                            @empty
                                <h2>لا يوجد طلبات تبرعى حتى الان</h2>
                            @endforelse
                        </div>
                        <div class="pages">
                            <nav aria-label="Page navigation example" dir="ltr">
                                {{-- <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul> --}}
                                {{ $donationRequest->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
<script>
        $(document).ready(function () {
            $('.searchDonation').on('click',function(e){
                var governorate=$('.governorate option:selected').val();
                var bloodtype=$('.bloodtype option:selected').val();
                $.ajax({
                    type: "GET",
                    url: "{{url('requests')}}",
                    data: {'bloodtype_id':bloodtype,'governate_id':governorate},
                    success: function (response) {
                        console.log(response.output);
                        // $('.patients').load(document.URL +  ' .patients');
                        $('.patients').html(response.output);
                    }
                });
            });
        });
</script>    
@endpush