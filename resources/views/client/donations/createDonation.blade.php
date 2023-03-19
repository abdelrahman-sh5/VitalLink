@extends('client.master')
@section('content')

    <body class="inside-request">
    <div class="ask-donation">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/donation-requests')}}">طلبات التبرع</a></li>
                        <li class="breadcrumb-item active" aria-current="page">انشاء طلب التبرع</li>
                    </ol>
                </nav>
            </div>
            <form action="{{route('donation-requests.store')}}" method="post">
                @csrf
            <div class="details">
                @include('admin.helpers.errors')
                <div class="person">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>اسم المريض </p>
                                    </div>
                                    <div class="light">
                                        <input name="patient_name" type="text">
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
                                    @inject('bloodTypes','App\Models\BloodType')
                                    <div class="light">
                                        <select name="blood_type_id" class="form-control" id="exampleFormControlSelect1">
                                            <option selected disabled>اختر فصيلة الدم</option>
                                            @forelse($bloodTypes::getAll() as $bloodType)
                                                <option value="{{$bloodType->id}}" {{ (Request::get('blood_type_id') == $bloodType->id) ? 'selected' : '' }}> {{$bloodType->name}} </option>
                                            @empty
                                            @endforelse
                                        </select>
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
                                        <input name="age" type="text">
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
                                        <input name="bags" type="text">
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
                                        <input name="hospital" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>عنوان المستشفى </p>
                                    </div>
                                    <div class="light">
                                        <input name="patient_phone" type="text">
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
                                        <p>رقم الهاتف </p>
                                    </div>

                                    <div class="light">
                                        <input name="address" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>المدينة </p>
                                    </div>

                                    @inject('cities','App\Models\City')
                                    <div class="light">
                                        <select name="city_id" class="form-control" id="exampleFormControlSelect1">
                                            <option selected disabled>اختر المدينة</option>
                                            @forelse($cities::getAll() as $city)
                                                <option value="{{$city->id}}" {{ (Request::get('city_id') == $city->id) ? 'selected' : '' }}> {{$city->name}} </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="details-button">
                        <p>التفاصيل</p>
                        <textarea name="notes" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div style="display: flex; justify-content: center">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>

@endsection
