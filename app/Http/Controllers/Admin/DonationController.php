<?php

namespace App\Http\Controllers\Admin;

use App\Models\BloodType;
use App\Models\City;
use App\Models\DonationRequest;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $data = DonationRequest::where(function ($query) use($request){
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
                $query->where('patient_name', 'LIKE', "%{$request->search}%");
            }
        })->paginate(5);
        return view('admin.donations.index', ['data'=>$data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donation = DonationRequest::find($id);
//        return redirect(route('donations.show'))->with('donation', $donation);
        return view('admin.donations.show')->with('donation', $donation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $donation = DonationRequest::find($id);
        $donation->delete();
        return redirect(route('donations.index'))->with('message', 'Deleted');
    }
}
