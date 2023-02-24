@extends('admin.home')
@inject('governorates','App\Models\Governorate')

@section('title', 'City Page')
@section('small-title', 'Simple title')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Edit a city</h3>
            </div>
            <div class="box-body">
        <form role="form" action="{{ route('cities.update', [$row->id]) }}" method="post">
            @csrf
           {{method_field('PUT')}}
            <div class="box-body">
                @include('admin.helpers.errors')
                    <div class="form-group">
                    <label> Name </label>
                    <input type="text" name="name" class="form-control" value="{{$row->name}}">
                </div>
                <div class="form-group">
                    <label> Governorate </label>
                    <select name="governorate_id" class="form-control">
                        @foreach($governorates::getAll() as $governorate)
                            <option value="{{$governorate->id}}" {{($row->governorate->name == $governorate->name) ? 'selected' : ''}}> {{$governorate->name}} </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>

            </div>
        </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
