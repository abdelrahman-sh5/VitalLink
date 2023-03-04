@extends('admin.home')

@section('title', 'Users Page')
@section('small-title', 'Simple title')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-tag"></i> Users List</h3>
            </div>
            <div class="box-body">
        @include('admin.helpers.message')
        @if($data->count() > 0)
        <a href="{{url(route('users.create'))}}" class="btn btn-primary"> <li class="fa fa-plus"></li> &nbsp; Add a new one</a>
            <br> <br>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Number of roles allowed</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($data as $user)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td> {{$user->name}} </td>
                            <td> {{$user->getRoleNames()->count()}} </td>
                            <td> <a href="{{ route('users.edit',[$user->id]) }}" class="btn btn-xs btn-warning fa fa-pencil"> Edit </a> </td>
                            <form action="{{ route('users.destroy',[$user->id]) }}" method="post">
                                @csrf @method('DELETE')
                                <td> <input type="submit" onclick="return confirm('Sure ?')" value="Delete" class="btn btn-xs btn-danger fa fa-trash"> </td>
                            </form>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

            @else
                    <div class="col-md-6">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <blockquote>
                                    <strong> 0Ops ! No Users found.</strong> &nbsp; &nbsp;
                                    <a href="{{ url(route('users.create')) }}" class="btn btn-primary"> <li class="fa fa-plus"></li> &nbsp; Add a new one</a>
                                </blockquote>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>

                @endif
            {{$data->links()}}
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
