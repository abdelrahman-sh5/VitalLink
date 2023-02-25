<?php

namespace App\Http\Controllers\Admin;

use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->get('tab') == 'city'){
            $city = City::find($request->city_id);
            $data = $city->clients()->paginate(3);
            return view('admin.clients.index', compact('data'));
        }elseif ($request->get('tab') == 'bloodType'){
            $bloodType = BloodType::find($request->blood_type_id);
            $data = $bloodType->clients()->paginate(3);
            return view('admin.clients.index', compact('data'));
        }elseif ($request->get('tab') == 'gov'){
            $governorate = Governorate::find($request->governorate_id);
            $data = $governorate->clients()->paginate(2);
            return view('admin.clients.index', compact('data'));
        }
        $data = Client::paginate(7);
        return view('admin.clients.index', ['data'=>$data]);
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        $client->update($request->only('is_active'));
        return redirect()->to('/admin/clients');
    }

}
