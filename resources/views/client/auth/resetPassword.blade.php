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
                        <li class="breadcrumb-item active" aria-current="page">استعادة كلمة المرور</li>
                    </ol>
                </nav>
            </div>
            <div class="signin-form">
                    @include('admin.helpers.errors')
                <form action="{{url('auth/reset-password')}}" method="post">
                    <div class="logo">
                        <img src="{{asset('client/imgs/logo.png')}}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الهاتف">
                    </div>
                    <div class="col-md-6 right">
                        <input type="submit" value="ارسال ايميل بكود التحقق">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </body>
@endsection
