<!--articles-->
<div class="articles">
    <div class="container title">
        <div class="head-text">
            <h2>المقالات</h2>
        </div>
    </div>
    <div class="view">
        <div class="container">
            <div class="row">
                <!-- Set up your HTML -->
                <div class="owl-carousel articles-carousel">
                    @forelse ($posts as $item)
                        <div class="card" style="height:400px;">
                            <div class="photo">
                                <img src="{{ asset('images/' . $item->photo) }}" height="200px" class="card-img-top"
                                    alt="...">
                                <a href="{{ url('post/' . $item->id) }}" class="click">المزيد</a>
                            </div>
                            <div>
                                <button value="{{ $item->id }}" class="favourite btn-light">
                                    <i class="far fa-heart {{$item->isFavourite?'bg-danger':''}} heart{{ $item->id }}"></i>
                                </button>
                            </div>
                            

                            <div class="card-body">
                                @php if($item->isFavourite){echo "t";}else{echo "false";} @endphp
                                <h5 class="card-title">{{$item->title}}</h5>
                                
                                <p class="card-text">
                                    {!! $item->decription !!}
                                </p>
                            </div>
                        </div>
                    @empty
                        <h3>NO Posts Yet ...! </h3>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
@push('javascript')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('.favourite').on('click', function() {
                var postId = this.value;
                $.ajax({
                    type: "POST",
                    url: "{{url('toggle-favouite')}}",
                    data: {'post_id':postId},
                    success: function(response) {
                        $('.heart' + postId).toggleClass('bg-danger');

                    }
                });
            });
        });
    </script>
@endpush
