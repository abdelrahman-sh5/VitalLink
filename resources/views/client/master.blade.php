<!doctype html>
<html lang="en" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
          integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">

    <!--google fonts css-->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!--font awesome css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

    <!--favicon-->
    <link rel="icon" href="{{asset('client/imgs/Icon.png')}}">

    <!--owl-carousel css-->
    <link rel="stylesheet" href="{{asset('client/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('client/assets/css/owl.theme.default.min.css')}}">

    <!--style css-->
    <link rel="stylesheet" href="{{asset('client/assets/css/style.css')}}">

    <title>Blood Bank</title>
</head>
<body>
<!--upper-bar-->
<div class="upper-bar">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="language">
                    <a href="index.html" class="ar active">عربى</a>
                    <a href="index-ltr.html" class="en inactive">EN</a>
                </div>
            </div>

            <!-- not a member-->
            <div class="col-lg-4">
            </div>
        </div>
    </div>
</div>


<!--nav-->
<div class="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{asset('client/imgs/logo.png')}}" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{url('/')}}">الرئيسية <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('donation-requests.index')}}">طلبات التبرع</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('who-are-us')}}">من نحن</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('contact-us')}}">اتصل بنا</a>
                    </li>
                </ul>

                @if(Request::session()->has('client'))

                <div class="member">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            القائمة
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route('profile')}}">
                                <i class="far fa-user"></i>
                                معلوماتى
                            </a>
                            <a class="dropdown-item" href="{{route('favorites')}}">
                                <i class="far fa-heart"></i>
                                المفضلة
                            </a>
                            <a class="dropdown-item" href="{{url('/contact-us')}}">
                                <i class="fas fa-phone-alt"></i>
                                تواصل معنا
                            </a>
                            <a class="dropdown-item" href="{{route('clientLogOut')}}">
                                <i class="fas fa-sign-out-alt"></i>
                                تسجيل الخروج
                            </a>
                        </div>
                    </div>
                </div>
                &nbsp; &nbsp;
                <h3> {{session()->get('client')->name}} </h3>
                @else
                <!--not a member-->
                    <div class="accounts">
                        <a href="{{route('show-register')}}" class="create">إنشاء حساب جديد</a>
                        <a href="{{route('show-login')}}" class="signin">الدخول</a>
                    </div>
                @endif
            </div>
        </div>
    </nav>
</div>

@yield('content')

<!--footer-->
<div class="footer">
    <div class="inside-footer">
        <div class="container">
            <div class="row">
                <div class="details col-md-4">
                    <img src="{{asset('client/imgs/logo.png')}}">
                    <h4>بنك الدم</h4>
                    <p> {{$data->about_text}} </p>
                </div>
                <div class="pages col-md-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" href="index.html"
                           role="tab" aria-controls="home">الرئيسية</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list"
                           href="{{url('donation-requests')}}" role="tab" aria-controls="settings">طلبات التبرع</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" href="{{url('who-are-us')}}"
                           role="tab" aria-controls="settings">من نحن</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" href="{{url('/contact-us')}}"
                           role="tab" aria-controls="settings">اتصل بنا</a>
                    </div>
                </div>
                <div class="stores col-md-4">
                    <div class="availabe">
                        <p>متوفر على</p>
                        <a href="#">
                            <img src="{{asset('client/imgs/google1.png')}}">
                        </a>
                        <a href="#">
                            <img src="{{asset('client/imgs/ios1.png')}}">
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
                        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="rights col-md-8">
                    <p>جميع الحقوق محفوظة لـ <span>بنك الدم</span> &copy; 2019</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
@stack('scripts')
@stack('JSscripts')
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
    crossorigin="anonymous"></script>

<script src="{{asset('client/assets/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('client/assets/js/bootstrap.bundle.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"
        integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k"
        crossorigin="anonymous"></script>

<script src="{{asset('client/assets/js/owl.carousel.min.js')}}"></script>

<script src="{{asset('client/assets/js/main.js')}}"></script>
</body>
</html>
