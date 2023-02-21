@extends('admin.home')
@inject('governorates','App\Models\Governorate')

@section('title', 'Cities Page')
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
                        <th>Name</th>
                        <th>Governorate</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($data as $city)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td> {{$city->name}} </td>
                            <td> {{$city->governorate->name}} </td>
                            <td> <a href="{{ route('cities.edit',[$city->id]) }}" class="btn btn-xs btn-warning fa fa-pencil"> Edit </a> </td>
                            <form action="{{ route('cities.destroy',[$city->id]) }}" method="post">
                                @csrf @method('DELETE')
                                <td> <input type="submit" onclick="return confirm('Sure ?')" value="Delete" class="btn btn-xs btn-danger fa fa-trash"> </td>
                            </form>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
        </div>

            @elseif($governorates->count() == 0)
                <div class="col-md-6">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <blockquote>
                                <strong> 0Ops ! No Governorates found .. you can add now </strong> &nbsp; &nbsp;
                                <a href="{{ url(route('governorates.create')) }}" class="btn btn-primary"> <li class="fa fa-plus"></li> &nbsp; Add a new Governorate !! </a>
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
                                    <strong> 0Ops ! No Cities found.</strong> &nbsp; &nbsp;
                                    <a href="{{ url(route('cities.create')) }}" class="btn btn-primary"> <li class="fa fa-plus"></li> &nbsp; Add a new City </a>
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
