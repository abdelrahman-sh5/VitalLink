@extends('admin.home')
@inject('bloodTypes','App\Models\BloodType')
@inject('governorates','App\Models\Governorate')
@inject('cities','App\Models\City')

@section('title', 'Clients Page')
@section('small-title', 'Simple title')
{{--{{dd($data)}}--}}
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
                       <div class="pull-right">
{{--                           <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label>--}}
                       </div>
                        <table class="table table-bordered" id="clientsTable">
                            <thead>
                            <ul class="nav nav-tabs pull-left">
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                            Governorate <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            @forelse($governorates::getAll() as $governorate)
                                                <li role="presentation"><a role="menuitem" href="{{route('clients.index', ['tab' => 'gov', 'governorate_id' => $governorate->id])}}" tabindex="-1">{{$governorate->name}}</a></li>
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
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('clients.index', ['tab' => 'city', 'city_id' => $city->id])}}">{{$city->name}}</a></li>
                                            @empty
                                            @endforelse
                                        </ul>
                                    </li>
                                </ul>

                                <ul class="nav nav-tabs pull-left">
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                            Blood type <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            @forelse($bloodTypes::getAll() as $bloodType)
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('clients.index', ['tab' => 'bloodType', 'blood_type_id' => $bloodType->id])}}">{{$bloodType->name}}</a></li>
                                            @empty
                                            @endforelse
                                        </ul>
                                    </li>
                                </ul>

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
