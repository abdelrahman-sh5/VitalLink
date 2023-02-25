@extends('admin.home')

@section('title', 'Settings Page')
@section('small-title', 'Simple title')
{{--{{dd($data)}}--}}
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-file-text-o"></i>
                        <h3 class="box-title">Settings</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('admin.helpers.errors')
                        <form role="form" action="{{route('settings.update', [$data->id])}}" method="post">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label> notification_text </label>
                                    <textarea class="form-control" name="notification_text" rows="3">{{$data->notification_text}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label> about_text </label>
                                    <textarea class="form-control" name="about_text" rows="3">{{$data->about_text}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label> Phone </label>
                                    <input type="text" name="phone" class="form-control" value="{{$data->phone}}">
                                </div>
                                <div class="form-group">
                                    <label> Email </label>
                                    <input type="text" name="email" class="form-control" value="{{$data->email}}">
                                </div>
                                <button type="submit" class="btn btn-warning"> Update </button>
                            </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-link"></i>
                        <h3 class="box-title">Social Links</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="fa fa-twitter"> Twitter </label>
                            <input type="text" name="tw_link" class="form-control" value="{{$data->tw_link}}">
                        </div>
                        <div class="form-group">
                            <label class="fa fa-facebook"> Facebook </label>
                            <input type="text" name="fb_link" class="form-control" value="{{$data->fb_link}}">
                        </div>
                        <div class="form-group">
                            <label class="fa fa-youtube"> Youtube </label>
                            <input type="text" name="yt_link" class="form-control" value="{{$data->yt_link}}">
                        </div>
                        <div class="form-group">
                            <label class="fa fa-instagram"> Instagram </label>
                            <input type="text" name="insta_link" class="form-control" value="{{$data->insta_link}}">
                        </div>
                        <div class="form-group">
                            <label class="fa fa-whatsapp"> WhatsApp </label>
                            <input type="text" name="wa_link" class="form-control" value="{{$data->wa_link}}">
                        </div>

                    </form>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>

    </section>
    <!-- /.content -->
@endsection
