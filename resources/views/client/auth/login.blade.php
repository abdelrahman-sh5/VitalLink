@extends('client.master')
@section('content')

    <body class="signin-account">
    <!--form-->
    <div class="form">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
                    </ol>
                </nav>
            </div>
            <div class="signin-form">
                @include('admin.helpers.errors')
                <form action="{{url('auth/client-login')}}" method="post">
                    <div class="logo">
                        <img src="{{asset('client/imgs/logo.png')}}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" value="{{Cookie::get('phone')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الجوال">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password"  value="{{Cookie::get('password')}}" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور">
                    </div>
                    <div class="row options">
                        <div class="col-md-6 remember">
                            <div class="form-group form-check">
                                <input type="checkbox" name="rememberMe" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">تذكرنى</label>
                            </div>
                        </div>
                        <div class="col-md-6 forgot">
                            <img src="{{asset('client/imgs/complain.png')}}">
                            <a href="{{route('show-reset-password')}}">هل نسيت كلمة المرور</a>
                        </div>
                    </div>
                    <div class="row buttons">
                        <div class="col-md-6 right">
                            <button type="submit" class="btn btn-primary">&nbsp; &nbsp; دخول&nbsp; &nbsp;</button>
                        </div>
                        <div class="col-md-6 left">
                            <a href="{{url('/auth/show-register')}}">انشاء حساب جديد</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </body>
@endsection
