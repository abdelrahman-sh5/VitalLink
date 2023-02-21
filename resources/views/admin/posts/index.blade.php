@extends('admin.home')
@inject('categories','App\Models\Governorate')

@section('title', 'Posts Page')
@section('small-title', 'Simple title')

@section('content')
    <!-- Main content -->
    <section class="content">
        @if(session('message'))
            <div class="alert alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';"> &times; </span>
                {{session('message')}}
            </div>
        @endif
        @if($data->count() > 0)
        <a href="{{url(route('cities.create'))}}" class="btn btn-primary"> <li class="fa fa-plus"></li> &nbsp; Add a new one</a>
            <br> <br>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($data as $post)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td> {{$post->title}} </td>
                            <td> {{$post->content}} </td>
{{--                            <td> {{ $post->image- }} </td>--}}
                            <td><img src="{{ asset('storage/images/'.$post->image) }}"> </td>
                            <td> {{$post->category->name}} </td>
                            <td> <a href="{{ route('posts.edit',[$post->id]) }}" class="btn btn-xs btn-warning fa fa-pencil"> Edit </a> </td>
                            <form action="{{ route('posts.destroy',[$post->id]) }}" method="post">
                                @csrf @method('DELETE')
                                <td> <input type="submit" onclick="return confirm('Sure ?')" value="Delete" class="btn btn-xs btn-danger fa fa-trash"> </td>
                            </form>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
        </div>

            @elseif($categories->count() == 0)
                <div class="col-md-6">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <blockquote>
                                <strong> 0Ops ! No Categories found .. you can add now </strong> &nbsp; &nbsp;
                                <a href="{{ url(route('categories.create')) }}" class="btn btn-primary"> <li class="fa fa-plus"></li> &nbsp; Add a new Category !! </a>
                            </blockquote>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

            @else
                    <div class="col-md-6">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <blockquote>
                                    <strong> 0Ops ! No Posts found.</strong> &nbsp; &nbsp;
                                    <a href="{{ url(route('posts.create')) }}" class="btn btn-primary"> <li class="fa fa-plus"></li> &nbsp; Add a new post </a>
                                </blockquote>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                @endif
            {{$data->links()}}
    </section>
    <!-- /.content -->
@endsection
