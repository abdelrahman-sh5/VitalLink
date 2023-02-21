@extends('admin.home')

@section('title', 'Categories Page')
@section('small-title', 'Simple title')

@section('content')

    <!-- Main content -->
    <section class="content">

        <form role="form" action="{{ route('categories.update', [$category->id]) }}" method="post">
            @csrf
           {{method_field('PUT')}}
            <div class="box-body">
                <div class="form-group">
                    <label> Name </label>
                    <input type="text" name="name" class="form-control" value="{{$category->name}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </section>
    <!-- /.content -->
@endsection
