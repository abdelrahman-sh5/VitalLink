@extends('admin.home')
@inject('categories','App\Models\Category')

@section('title', 'Post Page')
@section('small-title', 'Simple title')

@section('content')

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-newspaper-o"></i>
                        <h3 class="box-title">Post Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" action="{{ route('posts.update', [$post->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="box-body">
                                @include('admin.helpers.errors')
                                <div class="form-group">
                                    <label> Title </label>
                                    <input type="text" name="title" class="form-control" value="{{$post->title}}">
                                </div>
                                <div class="form-group">
                                    <label> Content </label>
                                    <textarea class="form-control" name="content" rows="5" placeholder="Type Content . . ?">{{$post->content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label> Image </label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label> category </label>
                                    <select name="category_id" class="form-control">
                                        @foreach($categories::getAll() as $category)
                                            <option value="{{$category->id}}" {{($post->category->name == $category->name) ? 'selected' : ''}}> {{$category->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
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
                        <i class="fa fa-image"></i>
                        <h3 class="box-title">Post Image</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <img src="{{asset('storage/images/'.$post->image)}}" width="500px" height="350px">
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
