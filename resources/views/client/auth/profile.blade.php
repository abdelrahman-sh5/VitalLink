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
                            <li class="breadcrumb-item active" aria-current="page">عرض وتعديل بيانات الحساب</li>
                        </ol>
                    </nav>
                </div>
                <div class="account-form">
                    @include('admin.helpers.errors')
                    <form method="POST" action="{{route('update-profile')}}">
                        {{method_field('PUT')}}
                        @csrf
                        <input type="name" name="name" class="form-control" value="{{$clientData->name}}"
                               aria-describedby="emailHelp" placeholder="الإسم">

                        <input type="email" name="email" class="form-control" value="{{$clientData->email}}"
                               aria-describedby="emailHelp" placeholder="البريد الإلكترونى">


                        <input type="text" name="phone" class="form-control" value="{{$clientData->phone}}"
                               aria-describedby="emailHelp" placeholder="رقم الهاتف">

                        <input placeholder="تاريخ الميلاد" name="birthdate" class="form-control" type="text"
                               value="{{$clientData->birthdate}}" onfocus="(this.type='date')" id="date">

                        <input placeholder="آخر تاريخ تبرع" name="last_donation_date" value="{{$clientData->last_donation_date}}"
                               class="form-control" type="text" onfocus="(this.type='date')">

                        @inject('bloodTypes', 'App\Models\BloodType')
                        <select class="form-control" id="bloodTypes" name="blood_type_id">
                            @forelse($bloodTypes::getAll() as $bloodType)
                                <option value="{{$bloodType->id}}" {{ ($bloodType->id === $clientData->bloodType->id) ? 'selected': $bloodType->id }}>
                                    {{$bloodType->name}}
                                </option>
                            @empty
                            @endforelse
                        </select>
                        <p id="now"></p>

                        @inject('cities', 'App\Models\City')
                        <select class="form-control" id="cities" name="city_id">
                            @forelse($cities::getAll() as $city)
                                <option value="{{$city->id}}" {{ ($city->id === $clientData->city_id) ? 'selected': $city->id }}>{{$city->name}}</option>
                            @empty
                            @endforelse
                        </select>

                        <div class="create-btn">
                            <input type="submit" value="تعديل">
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
        //
    </script>
@endpush

@endsection
