@extends('admin.home')
@inject('roles','App\MyRole')

@section('title', 'Users Page')
@section('small-title', 'Simple title')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-save"></i> Create a new User</h3>
            </div>
            <div class="box-body">
                <form role="form" action="{{route('users.store')}}" method="post">
                    @csrf
                    <div class="box-body">
                        @include('admin.helpers.errors')
                        <div class="form-group">
                            <label> Name </label>
                            <input type="text" name="name" class="form-control" placeholder="Full Name">
                        </div>

                        <div class="form-group">
                            <label> Email </label>
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label> Password </label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label> Confirm Password </label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
                        </div>


                    <label class="col-sm-3"> Roles </label> <br>
                    @forelse($roles::getAll() as $role)
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="roles[]" value="{{$role->id}}">
                                    {{$role->name}}
                                </label>
                            </div>
                        </div>
                    @empty
                    @endforelse
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
        </div>
    </div>
    </section>
    <!-- /.content -->
@endsection
