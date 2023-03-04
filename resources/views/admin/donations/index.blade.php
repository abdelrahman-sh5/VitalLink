@extends('admin.home')
@inject('bloodTypes', 'App\Models\BloodType')
@inject('governorates','App\Models\Governorate')
@inject('cities','App\Models\City')

@section('title', 'Donation Requests Page')
@section('small-title', 'Simple title')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-tag"></i> Donation Requests List</h3>
            </div>
    <div class="box-body">
        @include('admin.helpers.message')
        @if($data->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered" id="clientsTable" style="height: 90px; max-height: 90px;">
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
                                <label> Search for a Donation Request </label>
                                <input type="search" class="form-control input-sm" placeholder="Pres Enter to search" name="search" aria-controls="example1">
                            </div>
                        </form>
                    </div>
                </div>
                    <tr>
                        <th>No.</th>
                        <th>Patient Name</th>
                        <th>Patient Phone</th>
                        <th style="text-align: center">Age</th>
                        <th style="text-align: center">Bags</th>
                        <th style="text-align: center">Hospital</th>
                        <th style="text-align: center">Address</th>
                        <th style="text-align: center">Notes</th>
                        <th style="text-align: center">Blood Type</th>
                        <th style="text-align: center">City</th>
                        <th style="text-align: center">Client</th>
                        <th style="text-align: center">Show</th>
                        <th style="text-align: center">Delete</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($data as $donation)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td> {{$donation->patient_name}} </td>
                            <td> {{$donation->patient_phone}} </td>
                            <td> {{$donation->age}} </td>
                            <td> {{$donation->bags}} </td>
                            <td> {{$donation->hospital}} </td>
                            <td> {{$donation->address}} </td>
                            <td><textarea cols="30" rows="3" disabled>{{$donation->notes}}</textarea> </td>
                            <td> {{$donation->bloodType->name}} </td>
                            <td> {{$donation->city->name}} </td>
                            <td> {{$donation->client->name}} </td>
                            <td style="text-align: center"> <a href="{{ route('donations.show',[$donation->id]) }}" class="btn btn-xs btn-warning fa fa-eye"> Show </a> </td>
                            <form action="{{ route('donations.destroy',[$donation->id]) }}" method="post">
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
                                    <strong> 0Ops ! No Donation Requests found.</strong> &nbsp; &nbsp;
                                </blockquote>
                                <a href="{{url('admin/donations')}}" class="btn btn-block" type="submit"><li class="fa fa-angle-left"> Go Back</li></a>
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
