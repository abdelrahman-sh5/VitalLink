@extends('client.master')
@section('content')
    <body class="contact-us">

    <!--contact-us-->
    <div class="contact-now">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تواصل معنا</li>
                    </ol>
                </nav>
            </div>
            <div class="row methods">
                <div class="col-md-6">
                    <div class="call">
                        <div class="title">
                            <h4>اتصل بنا</h4>
                        </div>
                        <div class="content">
                            <div class="logo">
                                <img src="{{asset('client/imgs/logo.png')}}">
                            </div>
                            <div class="details">
                                <ul>
                                    <li><span>الجوال:</span> {{$data->phone}} </li>
                                    <li><span>البريد الإلكترونى:</span> {{$data->email}} </li>
                                </ul>
                            </div>
                            <div class="social">
                                <h4>تواصل معنا</h4>
                                <div class="icons" dir="ltr">
                                    <div class="out-icon">
                                        <a href="//{{$data->fb_link}}"><img src="{{asset('client/imgs/001-facebook.svg')}}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="//{{$data->tw_link}}"><img src="{{asset('client/imgs/002-twitter.svg')}}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="//{{$data->wa_link}}"><img src="{{asset('client/imgs/005-whatsapp.svg')}}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="//{{$data->insta_link}}"><img src="{{asset('client/imgs/004-instagram.svg')}}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="//{{$data->yt_link}}"><img src="{{asset('client/imgs/003-youtube.svg')}}"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <div class="title">
                            <h4>تواصل معنا</h4>
                        </div>
                        <div class="fields">
                            {{@ session('message')}}
                            <form action="{{url('send-contact-details')}}" method="POST">
                                @include('admin.helpers.errors')
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="الإسم" name="name">
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="البريد الإلكترونى" name="email">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="الجوال" name="phone">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="عنوان الرسالة" name="title">
                                <textarea placeholder="نص الرسالة" class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
                                <button type="submit">ارسال</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    </body>

@endsection
