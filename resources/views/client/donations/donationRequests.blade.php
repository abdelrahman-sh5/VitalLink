@extends('client.master')
@section('content')


<body class="donation-requests">


<div class="all-requests">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
                </ol>
            </nav>
        </div>

        <!--nav-->
        <div class="nav-bar">
            <a href="{{route('donation-requests.create')}}" class="donate">
                <img src="{{asset('client/imgs/transfusion.svg')}}">
                <p>طلب تبرع</p>
            </a>
        </div>

        <!--requests-->
        <div class="requests">
            <div class="head-text">
                <h2>طلبات التبرع</h2>
            </div>
            <div class="content">
                <form action="{{route('donation-requests.index')}}" method="get" class="row filter">

                    @inject('bloodTypes','App\Models\BloodType')
                    <div class="col-md-5 blood">
                        <div class="form-group">
                            <div class="inside-select">
                                <select name="blood_type_id" class="form-control" id="exampleFormControlSelect1">
                                    <option selected disabled>اختر فصيلة الدم</option>
                                    @forelse($bloodTypes::getAll() as $bloodType)
                                        <option value="{{$bloodType->id}}" {{ (Request::get('blood_type_id') == $bloodType->id) ? 'selected' : '' }}> {{$bloodType->name}} </option>
                                    @empty
                                    @endforelse
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    @inject('cities','App\Models\City')
                    <div class="col-md-5 city">
                        <div class="form-group">
                            <div class="inside-select">
                                <select name="city_id" class="form-control" id="exampleFormControlSelect1">
                                    <option selected disabled>اختر المدينة</option>
                                    @forelse($cities::getAll() as $city)
                                        <option value="{{$city->id}}" {{ (Request::get('city_id') == $city->id) ? 'selected' : '' }}> {{$city->name}} </option>
                                    @empty
                                    @endforelse
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-1 search">
                        <button type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <div class="patients">
                    @forelse($donations as $donation)
                        <div class="details">
                            <div class="blood-type">
                                <h2 dir="ltr">{{$donation->bloodType->name}}</h2>
                            </div>
                            <ul>
                                <li><span>اسم الحالة:</span> &nbsp; &nbsp; {{$donation->patient_name}}</li>
                                <li><span>مستشفى:</span> &nbsp; &nbsp; {{$donation->hospital}}</li>
                                <li><span>المدينة:</span> &nbsp; &nbsp; {{$donation->city->name}}</li>
                            </ul>
                            <a href="{{route('donation-requests.show', $donation->id)}}">التفاصيل</a>
                        </div>
                    @empty
                    @endforelse



                </div>

                <div style="display: flex; justify-content: center">
                    {{ $donations->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

</body>

@endsection
