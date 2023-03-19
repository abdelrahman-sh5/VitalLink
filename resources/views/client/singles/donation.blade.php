@extends('client.master')
@section('content')

    <body class="inside-request">
    <!--ask-donation-->
    <div class="ask-donation">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/donation-requests')}}">طلبات التبرع</a></li>
                        <li class="breadcrumb-item active" aria-current="page">طلب التبرع: {{$donation->patient_name}}</li>
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
                                        <p>{{$donation->patient_name}}</p>
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
                                        <p dir="ltr">{{$donation->bloodType->name}}</p>
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
                                        <p>{{$donation->age}}</p>
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
                                        <p>{{$donation->bags}}</p>
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
                                        <p>المستشفى</p>
                                    </div>
                                    <div class="light">
                                        <p>{{$donation->hospital}}</p>
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
                                        <p>{{$donation->patient_phone}}</p>
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
                                        <p>عنوان المستشفى</p>
                                    </div>

                                    <div class="special-light light">
                                        <p>{{ $preciseAddress->address->Match_addr }}</p>
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
                        {{  $donation->notes  }}
                    </p>
                </div>
                <div class="location">
                        <iframe src="https://maps.google.com/maps?q={{$donation->latitude}},{{$donation->longitude}}&z=15&output=embed" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    </body>

@endsection
