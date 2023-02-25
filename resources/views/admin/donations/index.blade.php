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
            <table class="table table-bordered" style="table-layout: auto; width: 100%">
                <thead>
                <ul class="nav nav-tabs pull-left">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            Blood Types <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            @forelse($bloodTypes::getAll() as $bloodType)
                                <li role="presentation"><a role="menuitem" href="{{route('donations.index', ['tab' => 'bloodType', 'blood_type_id' => $bloodType->id])}}" tabindex="-1">bloodType : &nbsp; {{$bloodType->name}}</a></li>
                            @empty
                            @endforelse
                        </ul>
                    </li>
                </ul>

                <ul class="nav nav-tabs pull-left">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            Governorate <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            @forelse($governorates::getAll() as $governorate)
                                <li role="presentation"><a role="menuitem" href="{{route('donations.index', ['tab' => 'gov', 'governorate_id' => $governorate->id])}}" tabindex="-1">{{$governorate->name}}</a></li>
                            @empty
                            @endforelse
                        </ul>
                    </li>
                </ul>

                <ul class="nav nav-tabs pull-left">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            City <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            @forelse($cities::getAll() as $city)
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('donations.index', ['tab' => 'city', 'city_id' => $city->id])}}">{{$city->name}}</a></li>
                            @empty
                            @endforelse
                        </ul>
                    </li>
                </ul>
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
