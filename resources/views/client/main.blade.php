@inject('posts', 'App\Models\Post')
@inject('donations', 'App\Models\DonationRequest')

@extends('client.master')
@section('content')

    @include('admin.helpers.message')
    <!--intro-->
    <div class="intro">
        <div id="slider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#slider" data-slide-to="0" class="active"></li>
                <li data-target="#slider" data-slide-to="1"></li>
                <li data-target="#slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item carousel-1 active">
                    <div class="container info">
                        <div class="col-lg-5">
                            <p> {{$data->intro_text_1}} </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-2">
                    <div class="container info">
                        <div class="col-lg-5">
                            <p> {{$data->intro_text_2}} </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-3">
                    <div class="container info">
                        <div class="col-lg-5">
                            <p> {{$data->intro_text_1}} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                        @forelse($posts::getAll() as $post)
                            <div class="card">
                                <div class="photo">
                                    <img height="250px" src="{{asset('storage/images/' . $post->image)}}" class="card-img-top" alt="...">
                                    <a href="{{route('post', [$post->id])}}" class="click">المزيد</a>
                                </div>
                                <a href="{{route('toggle-favorite', ['post_id' => $post->id])}}" class="favourite">
                                    <i onclick="toggleFavorites(this)" class="far fa-heart"></i>
                                    {{--<i class="fa fa-heart"></i>  solid --}}
                                </a>

                                <div class="card-body">
                                    <h5 class="card-title">{{$post->title}}</h5>
                                    <p class="card-text">{{substr($post->content, 0, 30) . ' ... Read more'}}
                                    </p>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--requests-->
    <div class="requests">
        <div class="container">
            <div class="head-text">
                <h2>طلبات التبرع</h2>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="patients">

                    @forelse($donations::getAll(3) as $donation)
                        <div class="details">
                            <div class="blood-type">
                                <h2 dir="ltr">{{$donation->bloodType->name}}</h2>
                            </div>
                            <ul>
                                <li><span>اسم الحالة:</span>{{$donation->patient_name}}</li>
                                <li><span>مستشفى:</span> {{$donation->hospital}}</li>
                                <li><span>المدينة:</span> {{$donation->city->name}}</li>
                            </ul>
                            <a href="{{route('donation-requests.show', $donation->id)}}">التفاصيل</a>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div class="more">
                    <a href="{{url('donation-requests')}}">المزيد</a>
                </div>
            </div>
        </div>
    </div>

    <!--contact-->
    <div class="contact">
        <div class="container">
            <div class="col-md-7">
                <div class="title">
                    <h3>اتصل بنا</h3>
                </div>
                <p class="text">يمكنك الإتصال بنا للإستفسار عن معلومة وسيتم الرد عليكم</p>
                <div class="row whatsapp">
                    <a href="#">
                        <img src="{{asset('client/imgs/whats.png')}}">
                        <p dir="ltr">{{$data->phone}}</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--app-->
    <div class="app">
        <div class="container">
            <div class="row">
                <div class="info col-md-6">
                    <h3>تطبيق بنك الدم</h3>
                    <p> {{$data->about_text}} </p>
                    <div class="download">
                        <h4>متوفر على</h4>
                        <div class="row stores">
                            <div class="col-sm-6">
                                <a href="#">
                                    <img src="{{asset('client/imgs/google.png')}}">
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="#">
                                    <img src="{{asset('client/imgs/ios.png')}}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="screens col-md-6">
                    <img src="{{asset('client/imgs/App.png')}}">
                </div>
            </div>
        </div>
    </div>

@stop
@push('JSscripts')
    <script>
        function toggleFavorites(heart){
            var currentClass = $(heart).attr('class');
            if (currentClass.includes('first')) {
                $(heart).removeClass('far').addClass('fa');
            }else{
                $(heart).removeClass('fa').addClass('far');
            }
        }
    </script>
@endpush
