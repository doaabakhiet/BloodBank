
        <!--footer-->
        <div class="footer">
            <div class="inside-footer">
                <div class="container">
                    <div class="row">
                        <div class="details col-md-4">
                            <img src="{{asset('imgs/logo.png')}}">
                            <h4>بنك الدم</h4>
                            <p>
                                {{$settings->about_app}}
                            </p>
                        </div>
                        <div class="pages col-md-4">
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" id="list-home-list" href="{{url('/')}}" role="tab" aria-controls="home">الرئيسية</a>
                                <a class="list-group-item list-group-item-action" id="list-profile-list" href="{{url('/')}}" role="tab" aria-controls="profile">عن بنك الدم</a>
                                <a class="list-group-item list-group-item-action" id="list-messages-list" href="{{url('/')}}" role="tab" aria-controls="messages">المقالات</a>
                                <a class="list-group-item list-group-item-action" id="list-settings-list" href="{{url('/requests')}}" role="tab" aria-controls="settings">طلبات التبرع</a>
                                <a class="list-group-item list-group-item-action" id="list-settings-list" href="{{url('/who-are-us')}}" role="tab" aria-controls="settings">من نحن</a>
                                <a class="list-group-item list-group-item-action" id="list-settings-list" href="{{url('/contact')}}" role="tab" aria-controls="settings">اتصل بنا</a>
                            </div>
                        </div>
                        <div class="stores col-md-4">
                            <div class="availabe">
                                <p>متوفر على</p>
                                <a href="#">
                                    <img src="{{asset('imgs/google1.png')}}">
                                </a>
                                <a href="#">
                                    <img src="{{asset('imgs/ios1.png')}}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="other">
                <div class="container">
                    <div class="row">
                        <div class="social col-md-4">
                            <div class="icons">
                                <a href="{{$settings->facebook}}" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{$settings->instagram}}" class="instagram"><i class="fab fa-instagram"></i></a>
                                <a href="{{$settings->twitter}}" class="twitter"><i class="fab fa-twitter"></i></a>
                                <a href="{{$settings->youtube}}" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                        <div class="rights col-md-8">
                            <p>جميع الحقوق محفوظة لـ <span>بنك الدم</span> &copy; 2019</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        