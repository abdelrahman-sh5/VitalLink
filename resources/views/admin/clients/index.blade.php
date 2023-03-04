@extends('admin.home')
@inject('bloodTypes','App\Models\BloodType')
@inject('governorates','App\Models\Governorate')
@inject('cities','App\Models\City')

@section('title', 'Clients Page')
@section('small-title', 'Simple title')
{{-- style="width:150px;" --}}
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-tag"></i> Clients List</h3>
            </div>
            <div class="box-body">
                @include('admin.helpers.message')
                @if($data->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered" id="clientsTable">
                            <thead>
                                <div class="box-body">
                                    <div class="row">
                                        <form action="" class="pull-right" method="get">
                                        <div class="col-xs-2">
                                            <label> Governorate </label>
                                            <select name="governorate_id" class="form-control">
                                                <option value=""> --All-- </option>
                                                @forelse($governorates::getAll() as $governorate)
                                                    <option value="{{$governorate->id}}" {{ (Request::get('governorate_id') == $governorate->id) ? 'selected' : '' }}> {{$governorate->name}} </option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>

                                        <div class="col-xs-2">
                                            <label> Blood Types </label>
                                            <select name="blood_type_id" class="form-control">
                                                <option value=""> --All-- </option>
                                                @forelse($bloodTypes::getAll() as $bloodType)
                                                    <option value="{{$bloodType->id}}" {{ (Request::get('blood_type_id') == $bloodType->id) ? 'selected' : '' }}> {{$bloodType->name}} </option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>

                                        <div class="col-xs-2">
                                            <label> City </label>
                                            <select name="city_id" class="form-control">
                                                <option value=""> --All-- </option>
                                                @forelse($cities::getAll() as $city)
                                                    <option value="{{$city->id}}" {{ (Request::get('city_id') == $city->id) ? 'selected' : '' }}> {{$city->name}} </option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
                                            <label> Click to view changes</label>
                                            <input type="submit" class="btn btn-primary" value="Apply Filters">
                                        </div>
                                    </form>
                                    <form action="" method="get">
                                        <div class="col-xs-2 pull-right">
                                            <label> Search for a client </label>
                                            <input type="search" class="form-control input-sm" placeholder="Pres Enter to search" name="search" aria-controls="example1">
                                        </div>
                                    </form>
                                    </div>
                                </div>


                                    <!-- /.box-body -->
                            <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Phone</th>
                                    <th>Birthdate</th>
                                    <th>Last Donation Date</th>
                                    <th>Blood Type</th>
                                    <th>City</th>
                                    <th>Activation</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $client)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td> {{$client->name}} </td>
                                        <td> {{$client->email}} </td>
                                        <td> {{$client->phone}} </td>
                                        <td> {{$client->birthdate}} </td>
                                        <td> {{$client->last_donation_date}} </td>
                                        <td> {{$client->bloodType->name}} </td>
                                        <td> {{$client->city->name}} </td>
                                        <td>
                                            <form action="{{route('clients.update', [$client->id])}}" method="post">
                                                {{method_field('PUT')}}
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-default {{($client->is_active != null) ? "active" : ""}}">
                                                    <input type="radio" onchange="this.form.submit();" name="is_active" value="{{1}}" id="option1"> Active
                                                </label>
                                                <label class="btn btn-default {{($client->is_active == null) ? "active" : ""}}">
                                                    <input type="radio" onchange="this.form.submit();" name="is_active" value="{{0}}" id="option2"> Inactive
                                                </label>
                                            </div> </form>
                                        </td>
                                        <form action="{{ route('clients.destroy',[$client->id]) }}" method="post">
                                        @csrf @method('DELETE')
                                        <td style="text-align: center"> <input type="submit" onclick="return confirm('Sure ?')" value="Delete" class="btn btn-xs btn-danger fa fa-trash"> </td>
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
                                        <strong> 0Ops ! No Clients yet</strong>
                                    </blockquote>

                                    <a type="submit" href="{{url('admin/clients')}}" class="btn btn-primary">
                                        <li class="fa fa-step-backward">&nbsp; Go Back </li>
                                    </a>
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
