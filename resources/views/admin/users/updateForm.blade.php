@extends('admin.home')
@inject('roles','App\MyRole')

@section('title', 'User Page')
@section('small-title', 'Simple title')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Edit a User</h3>
            </div>
            <div class="box-body">
        <form role="form" action="{{ route('users.update', [$user->id]) }}" method="post">
            @csrf
           {{method_field('PUT')}}
            <div class="box-body">
                @include('admin.helpers.errors')
                <div class="form-group">
                    <label> Name </label>
                    <input type="text" name="name" class="form-control" value="{{$user->name}}">
                </div>
            </div>

        @forelse($roles::getAll() as $role)
                <div class="col-sm-3">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="roles[]" value="{{$role->id}}" {{ ($user->hasRole($role->name)) ? 'checked' : '' }}>
                            {{$role->name}}
                        </label>
                    </div>
                </div>
            @empty
            @endforelse
            <br> <br> <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
