@extends('admin.home')

@section('title', 'Governorates Page')
@section('small-title', 'Simple title')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Edit a Governorate</h3>
            </div>
            <div class="box-body">
        <form role="form" action="{{ route('governorates.update', [$governorate->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="box-body">
                @include('admin.helpers.errors')
                <div class="form-group">
                    <label> Name </label>
                    <input type="text" name="name" class="form-control" value="{{$governorate->name}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        </div>
    </div>
    </section>
    <!-- /.content -->
@endsection
