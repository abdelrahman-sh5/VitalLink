@extends('admin.home')

@section('title', 'Governorates Page')
@section('small-title', 'Simple title')

@section('content')

    <!-- Main content -->
    <section class="content">

        <form role="form" action="{{ route('governorates.update', [$governorate->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="box-body">
                <div class="form-group">
                    <label> Name </label>
                    <input type="text" name="name" class="form-control" value="{{$governorate->name}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </section>
    <!-- /.content -->
@endsection
