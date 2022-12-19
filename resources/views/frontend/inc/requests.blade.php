<!--requests-->
<div class="requests">
    <div class="container">
        <div class="head-text">
            <h2>طلبات التبرع</h2>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <form class="row filter">
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
            </form>
            <div class="patients">
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
            </div>
            <div class="more">
                <a href="{{url('requests')}}">المزيد</a>
            </div>
        </div>
    </div>
</div>
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