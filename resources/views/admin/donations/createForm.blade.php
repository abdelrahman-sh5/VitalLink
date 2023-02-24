@extends('admin.home')
@inject('categories','App\Models\Category')

@section('title', 'Posts Page')
@section('small-title', 'Simple title')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-save"></i> Create a new Post</h3>
            </div>
            <div class="box-body">
        <form role="form" action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}     <!-- For security Reasons. -->
            <div class="box-body">
                @include('admin.helpers.errors')
                <div class="form-group">
                    <label> Title </label>
                    <input type="text" name="title" class="form-control" placeholder="Post Title ?">
                </div>
                <div class="form-group">
                    <label> Content </label>
                    <textarea class="form-control" name="content" rows="3" placeholder="Type Content . . ?"></textarea>
                </div>

                <div class="form-group">
                    <label> Image </label>
                    <input type="file" name="image" class="form-control" placeholder="Post Image ?">
                </div>
                <div class="form-group">
                    <label> Category </label>
                    <select name="category_id" class="form-control">
                        @foreach($categories::getAll() as $category)
                            <option value="{{$category->id}}"> {{$category->name}} </option>
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
