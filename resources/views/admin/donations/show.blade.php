@extends('admin.home')

@section('title', 'Donation Request Details Page')
@section('small-title', 'Simple title')

@section('content')

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-hospital-o"></i>
                        <h3 class="box-title">Donation Request Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" action="{{route('donations.index')}}" method="get">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label> Bags </label>
                                    <input type="text" name="title" class="form-control" disabled value="{{$donation->bags}}">
                                </div>
                                <div class="form-group">
                                    <label> Hospital </label>
                                    <input type="text" name="title" class="form-control" disabled value="{{$donation->hospital}}">
                                </div>
                                <div class="form-group">
                                    <label> Address </label>
                                    <input type="text" name="title" class="form-control" disabled value="{{$donation->address}}">
                                </div>
                                <div class="form-group">
                                    <label> Client Name </label>
                                    <input type="text" name="title" class="form-control" disabled value="{{$donation->client->name}}">
                                </div>
                                <div class="form-group">
                                    <label> Notes </label>
                                    <textarea class="form-control" name="content" rows="3" disabled>{{$donation->notes}}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Go Back</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-user"></i>
                        <h3 class="box-title">Patient Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <label> Patient Name </label>
                            <input type="text" name="title" class="form-control" disabled value="{{$donation->patient_name}}">
                        </div>
                        <div class="form-group">
                            <label> Patient Phone </label>
                            <input type="text" name="title" class="form-control" disabled value="{{$donation->patient_phone}}">
                        </div>
                        <div class="form-group">
                            <label> Age </label>
                            <input type="text" name="title" class="form-control" disabled value="{{$donation->age}}">
                        </div>
                        <div class="form-group">
                            <label> Blood Type </label>
                            <input type="text" name="title" class="form-control" disabled value="{{$donation->bloodType->name}}">
                        </div>
                        <div class="form-group">
                            <label> City </label>
                            <input type="text" name="title" class="form-control" disabled value="{{$donation->city->name}}">
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>



    </section>
    <!-- /.content -->
@endsection
