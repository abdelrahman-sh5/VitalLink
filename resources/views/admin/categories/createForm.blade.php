@extends('admin.home')

@section('title', 'Categories Page')
@section('small-title', 'Simple title')

@section('content')

    <!-- Main content -->
    <section class="content">

        <form role="form" action="{{ route('categories.store') }}" method="post">
            {{ csrf_field() }}     <!-- For security Reasons. -->
            <div class="box-body">
                <div class="form-group">
                    <label> Name </label>
                    @error('name')
                        <div class="callout callout-danger">{{ $errors->first('name') }}</div>
                    @enderror
                    <input type="text" name="name" class="form-control" placeholder="Enter the name of the category ?">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </section>
    <!-- /.content -->
@endsection
