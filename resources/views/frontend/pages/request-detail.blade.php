@extends('layouts.home')
@section('title')
    Blood Bank | Donation Request Detail
@endsection
@section('content')
    <div class="inside-request">
        <div class="ask-donation">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/requests') }}">طلبات التبرع</a></li>
                            <li class="breadcrumb-item active" aria-current="page">طلب التبرع: {{ $request->clients->name }}
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="details">
                    <div class="person">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>الإسم</p>
                                        </div>
                                        <div class="light">
                                            <p>{{ $request->clients->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>فصيلة الدم</p>
                                        </div>
                                        <div class="light">
                                            <p dir="ltr">{{ $request->bloodtype->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>العمر</p>
                                        </div>
                                        <div class="light">
                                            <p>{{ $request->age }} عام</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>عدد الأكياس المطلوبة</p>
                                        </div>
                                        <div class="light">
                                            <p>{{ $request->num_of_bags }} أكياس</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>المشفى</p>
                                        </div>
                                        <div class="light">
                                            <p>الخير الدولية</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>رقم الجوال</p>
                                        </div>
                                        <div class="light">
                                            <p>{{ $request->phone }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="inside">
                                    <div class="info">
                                        <div class="special-dark dark">
                                            <p>عنوان المشفى</p>
                                        </div>
                                        <div class="special-light light">
                                            <p>{{ $request->cities->governates->name }} :{{ $request->cities->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="details-button">
                            <a href="#">التفاصيل</a>
                        </div>
                    </div>
                    <div class="text">
                        <p>
                            هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى،
                            حيث
                            يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
                            التطبيق. إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما
                            تريد،
                            النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص،
                            حيث
                            يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع. ومن هنا وجب على المصمم أن
                            يضع
                            نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص العربى أن يوفر على المصمم عناء
                            البحث
                            عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق. هذا النص يمكن أن يتم
                            تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ، غير منظم، غير منسق، أو حتى غير مفهوم.
                            لأنه
                            مازال نصاً بديلاً ومؤقتاً.هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا
                            النص
                            من مولد النص العربى، حيث يمكنك أن تولد مثل هذا
                        </p>
                    </div>
                    <div class="location">

                        <iframe width="300" height="170" frameborder="0" scrolling="no" marginheight="0"
                            marginwidth="0"
                            src="https://maps.google.com/maps?q={{ $request->latitude }},{{ $request->longtitude }}&hl=es&z=14&amp;output=embed"
                            height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0">
                        </iframe>
                        <br />
                        <small>
                            <a href="https://maps.google.com/maps?q={{ $request->latitude }},{{ $request->longtitude }}&hl=es;z=14&amp;output=embed"
                                style="color:#0000FF;text-align:left" target="_blank">
                                See map bigger
                            </a>
                        </small>
                   
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--ask-donation-->
@endsection
