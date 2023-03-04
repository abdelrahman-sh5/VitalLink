@extends('admin.home')
@inject('permissions','App\MyPermission')

@section('title', 'Roles Page')
@section('small-title', 'Simple title')

@section('content')


    <!-- Main content -->
    <section class="content">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Edit a role</h3>
            </div>
            <div class="box-body">
        <form role="form" action="{{ route('roles.update', [$role->id]) }}" method="post">
            @csrf
           {{method_field('PUT')}}
            <div class="box-body">
                @include('admin.helpers.errors')
                <div class="form-group">
                    <label> Name </label>
                    <input type="text" name="name" class="form-control" value="{{$role->name}}">
                </div>

                @forelse($permissions::getAll() as $permission)
                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="permissions[]" value="{{$permission->id}}" {{ ($role->hasPermissionTo($permission->name) ? 'checked' : '')}}>
                                {{$permission->name}}
                            </label>
                        </div>
                    </div>
                @empty
                @endforelse
                <br> <br>

                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
