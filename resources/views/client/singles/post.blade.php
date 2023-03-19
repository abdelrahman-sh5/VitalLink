@extends('client.master')
@section('content')

    <!--inside-article-->
    <div class="inside-article">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="#">المقالات</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$record->title}}</li>
                    </ol>
                </nav>
            </div>
            <br>
            <div class="article-image">
                <img src="{{asset('storage/images/'.$record->image)}}">
            </div>

            <body class="article-details">
                <div class="article-title col-12">
                    <div class="h-text col-6">
                        <h4>{{$record->title}}</h4>
                    </div>
                    <div class="icon col-6">
                        <button type="button"><i class="far fa-heart"></i></button>
                    </div>
                </div>
            </body>

            <!--text-->
            <div class="text">
                <p>{{$record->content}}</p>
            </div>

            <!--articles-->
            <div class="articles">
                <div class="title">
                    <div class="head-text">
                        <h2>مقالات ذات صلة</h2>
                    </div>
                </div>
                <div class="view">
                    <div class="row">
                        <!-- Set up your HTML -->
                        <div class="owl-carousel articles-carousel">
                            @forelse($relatedPosts as $relatedPost)
                            <div class="card">
                                <div class="photo">
                                    <img src="{{asset('storage/images/'.$relatedPost->image)}}" class="card-img-top" alt="...">
                                    <a href="{{route('post', [$relatedPost->id])}}" class="click">المزيد</a>
                                </div>
                                <a href="#" class="favourite">
                                    <i class="far fa-heart"></i>
                                </a>

                                <div class="card-body">
                                    <h5 class="card-title">{{$relatedPost->title}}</h5>
                                    <p class="card-text">
                                        {{substr($relatedPost->content, 0, 30) . '...Read More'}}
                                    </p>
                                </div>
                            </div>
                        @empty
                        @endforelse
                            <!-- Posts from the same category -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
