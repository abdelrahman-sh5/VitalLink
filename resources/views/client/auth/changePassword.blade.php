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
                            <li class="breadcrumb-item active" aria-current="page">كلمة مرور جديدة</li>
                        </ol>
                    </nav>
                </div>
                <div class="account-form">
                    <form method="POST" action="{{url('auth/change-password')}}">
                        @csrf
                        @include('admin.helpers.errors')

                        <input type="text" name="phone" class="form-control"
                               placeholder="الهاتف">

                        <input type="number" name="pin_code" class="form-control"
                               placeholder="كودالتحقق">

                        <input type="password" name="password" class="form-control"
                               placeholder="كلمة المرورالجديدة">

                        <input type="password" name="password_confirmation" class="form-control"
                               placeholder="تأكيد كلمة المرور">

                        <div class="create-btn">
                            <input type="submit" value="تعديل كلمة المرور">
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
