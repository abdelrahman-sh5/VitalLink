@extends('admin.home')

@section('title', 'Contacts Page')
@section('small-title', 'Simple title')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-tag"></i> Contacts List</h3>
            </div>
            <div class="box-body">
                @include('admin.helpers.message')
                @if($data->count() > 0)
                    <div class="table-responsive">
                        <a href="{{url(route('contacts.create'))}}" onclick="return confirm('Are u sure u want to delete all ?')" class="btn btn-danger"> <li class="fa fa-trash"></li> &nbsp; Delete All</a>
                        <form action="" class="pull-right">
                            <input type="search" class="form-control input-sm" placeholder="Pres Enter to search" name="search" aria-controls="example1">
                        </form>
                        <br> <br>
                        <table  style="table-layout: auto; width: 100%" class="table table-bordered" id="clientsTable">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>E-mail</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $contact)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> {{$contact->name}} </td>
                                    <td> {{$contact->phone}} </td>
                                    <td> {{$contact->email}} </td>
                                    <td> {{$contact->title}} </td>
                                    <td><textarea cols="60" rows="4" disabled>{{$contact->message}}</textarea> </td>
                                    <form action="{{ route('contacts.destroy',[$contact->id]) }}" method="post">
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
                                    <strong> 0Ops ! No Contacts yet</strong>
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
@push('script')
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
    <script type="text/javascript">
    //
    </script>
@endpush
