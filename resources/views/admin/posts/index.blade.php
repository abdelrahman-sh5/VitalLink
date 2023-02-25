@extends('admin.home')
@inject('categories','App\Models\Governorate')

@section('title', 'Posts Page')
@section('small-title', 'Simple title')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-tag"></i> Posts List</h3>
            </div>
            <div class="box-body">

        @include('admin.helpers.message')
        @if($data->count() > 0)
        <a href="{{url(route('posts.create'))}}" class="btn btn-primary"> <li class="fa fa-plus"></li> &nbsp; Add a new one</a>
            <br> <br>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th width="60px">Content</th>
                        <th width="100px">Image</th>
                        <th width="150px" style="text-align: center">Category</th>
                        <th style="text-align: center">Edit</th>
                        <th style="text-align: center">Delete</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($data as $post)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td> {{$post->title}} </td>
                            <td><textarea cols="40" rows="4" disabled>{{$post->content}}</textarea> </td>
                            <td width="150px"> <img src="{{asset('storage/images/'.$post->image)}}" width="100px" height="90px"> </td>
                            <td style="text-align: center"> {{$post->category->name}} </td>
                            <td style="text-align: center"> <a href="{{ route('posts.edit',[$post->id]) }}" class="btn btn-xs btn-warning fa fa-pencil"> Edit </a> </td>
                            <form action="{{ route('posts.destroy',[$post->id]) }}" method="post">
                                @csrf @method('DELETE')
                                <td style="text-align: center"> <input type="submit" onclick="return confirm('Sure ?')" value="Delete" class="btn btn-xs btn-danger fa fa-trash"> </td>
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
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
@endsection
