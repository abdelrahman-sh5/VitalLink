@extends('admin.home')
@inject('permissions','App\MyPermission')

@section('title', 'Roles')
@section('small-title', 'Create a new role')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-save"></i> Create a new Role</h3>
            </div>
            <div class="box-body">
            <form role="form" action="{{ route('roles.store') }}" method="post">
            {{ csrf_field() }}     <!-- For security Reasons. -->
            <div class="box-body">
                <div class="form-group">
                    <label> Name </label>
                    @include('admin.helpers.errors')       <!-- For Validation Reasons. -->
                    <input type="text" name="name" class="form-control" placeholder="Type the name of the role">
                </div>

                @forelse($permissions::getAll() as $permission)
                <div class="col-sm-3">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[]" value="{{$permission->id}}">
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
