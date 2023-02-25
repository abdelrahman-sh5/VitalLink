<?php

namespace App\Http\Controllers\Admin;

use App\Models\BloodType;
use App\Models\City;
use App\Models\DonationRequest;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        if ($request->get('tab') == 'city'){
            $city = City::find($request->city_id);
            $data = $city->donationRequest()->paginate(3);
            return view('admin.donations.index', compact('data'));
        }
        elseif ($request->get('tab') == 'bloodType'){
            $bloodType = BloodType::find($request->blood_type_id);
            $data = $bloodType->donationRequest()->paginate(3);
            return view('admin.donations.index', compact('data'));
        }
        elseif ($request->get('tab') == 'gov'){
            $governorate = Governorate::find($request->governorate_id);
            $data = $governorate->donationRequests()->paginate(2);
            return view('admin.donations.index', compact('data'));
        }
        $data = DonationRequest::paginate(3);
        return view('admin.donations.index', compact('data'));
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
