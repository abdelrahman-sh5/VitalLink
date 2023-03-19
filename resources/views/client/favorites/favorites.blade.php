@extends('client.master')
@section('content')

    <!--inside-article-->
    <div class="inside-article">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="#">المقالات</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> المفضلة </li>
                    </ol>
                </nav>
            </div>
            <br>

            <body class="article-details">
            <!--articles-->
            <div class="articles">
                <div class="title">
                    <div class="head-text">
                        <h2>مقالات مفضلة </h2>
                    </div>
                </div>
                <div class="view">
                    <div class="row">
                        <!-- Set up your HTML -->
                        <div class="owl-carousel articles-carousel">
                            @forelse($favorites as $favPost)
                            <div class="card">
                                <div class="photo">
                                    <img src="{{asset('storage/images/'.$favPost->image)}}" class="card-img-top" alt="...">
                                    <a href="{{route('post', [$favPost->id])}}" class="click">المزيد</a>
                                </div>
                                <a href="{{route('toggle-favorite', ['post_id' => $favPost->id])}}" class="favourite">
                                    <i class="far fa-heart"></i>
                                </a>

                                <div class="card-body">
                                    <h5 class="card-title">{{$favPost->title}}</h5>
                                    <p class="card-text">
                                        {{substr($favPost->content, 0, 30) . '...Read More'}}
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
            </body>
        </div>
    </div>

@endsection
