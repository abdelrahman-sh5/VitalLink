@extends('admin.home')

@section('title', 'Governorates Page')
@section('small-title', 'Simple title')

@section('content')

    <!-- Main content -->
    <section class="content">

        <form role="form" action="{{ route('governorates.store') }}" method="post">
{{--            {{ csrf_field() }}--}}
            <div class="box-body">
                <div class="form-group">
                    <label> Name </label>
                    @if($errors->has('name'))
                        <div class="callout callout-danger">{{ $errors->first('name') }}</div>
                   @endif
                    <input type="text" name="name" class="form-control" placeholder="Enter the name of the governorate ?">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </section>
    <!-- /.content -->
@endsection
