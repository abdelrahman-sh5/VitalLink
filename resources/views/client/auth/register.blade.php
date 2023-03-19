@extends('client.master')
@section('content')

    <body class="create">
        <!--form-->
        <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                        </ol>
                    </nav>
                </div>
                <div class="account-form">
                    <form method="POST" action="{{url('auth/client-register')}}">
                        @csrf
                        <input type="name" name="name" class="form-control"
                               aria-describedby="emailHelp" placeholder="الإسم">
                        @include('admin.helpers.errors')
                        <input type="email" name="email" class="form-control"
                               aria-describedby="emailHelp" placeholder="البريد الإلكترونى">

                        <input type="password" name="password" class="form-control"
                               placeholder="كلمة المرور">

                        <input type="password" name="password_confirmation" class="form-control"
                               placeholder="تأكيد كلمة المرور">

                        <input type="text" name="phone" class="form-control"
                               aria-describedby="emailHelp" placeholder="رقم الهاتف">

                        <input placeholder="تاريخ الميلاد" name="birthdate" class="form-control" type="text"
                               onfocus="(this.type='date')" id="date">

                        <input placeholder="آخر تاريخ تبرع" name="last_donation_date" class="form-control" type="text"
                               onfocus="(this.type='date')">

                        @inject('bloodTypes', 'App\Models\BloodType')
                        <select class="form-control" id="bloodTypes" name="blood_type_id">
                            <option selected disabled hidden value="">اختر فصيلة الدم </option>
                            @forelse($bloodTypes::getAll() as $bloodType)
                                <option value="{{$bloodType->id}}">{{$bloodType->name}}</option>
                            @empty
                            @endforelse
                        </select>
                        <p id="now"></p>
                        @inject('governorates', 'App\Models\Governorate')
                        <select class="form-control" id="governorates" name="governorate_id">
                            <option selected disabled hidden value=""> اختر المحافظة</option>
                            @forelse($governorates::getAll() as $governorate)
                                <option id="governorates" value="{{$governorate->id}}">{{$governorate->name}}</option>
                            @empty
                            @endforelse
                        </select>

                        @inject('cities', 'App\Models\City')
                        <select class="form-control" id="cities" name="city_id">
                            <option selected disabled hidden value=""> اختر المدينة</option>
                        </select>

                        <div class="create-btn">
                            <input type="submit" value="تسجيل">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script>
        $("#governorates").change(function () {
            var governorateId = $("#governorates").val();
            console.log("selected gov:" + governorateId);
            $("#cities").empty();
            var option = '<option value=""> المدينة </option>';
            $("#cities").append(option);
            $.ajax({
                url: '{{url("/")}}/api/governorate-cities/' + governorateId,
                type: 'get',
                data: {},
                success: function (result) {
                    $.each(result, function(index, city) {
                        console.log(city);
                        var option = '<option value="' + city.id + '">' + city.name + '</option>';
                        $("#cities").append(option);
                    });
                },

                error: function () {
                    console.log("error");
                }
            });
        });
    </script>
@endpush

@endsection
