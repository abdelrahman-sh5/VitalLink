<?php

namespace App\Http\Controllers\Admin;

use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $data = Client::where(function ($query) use($request){
            if ($request->get('city_id')){
                $query->where('city_id', $request->city_id);
            }
            if ($request->get('blood_type_id')){
                $query->where('blood_type_id', $request->blood_type_id);
            }
            if ($request->get('governorate_id')){
                $query->whereHas('city', function ($query) use ($request){
                    $query->where('governorate_id', $request->governorate_id);
                });
            }
            if ($request->input('search')){
                $query->where('name', 'LIKE', "%{$request->search}%");
            }
        })->paginate(5);
        return view('admin.clients.index', ['data'=>$data]);
    }



    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        $client->update($request->only('is_active'));
        return redirect()->to('/admin/clients');
    }

    public function destroy($id){
        $client = Client::find($id);
        $client->delete();
        return redirect(route('clients.index'));
    }

}
