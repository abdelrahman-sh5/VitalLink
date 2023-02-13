<?php

namespace App\Http\Controllers\Api;

use App\BloodTypeClient;
use App\City;
use App\ClientGovernorate;
use App\ClientNotification;
use App\DonationRequest;
use App\Http\Controllers\Controller;
use App\BloodType;

use App\Notification;
use Illuminate\Http\Request;

class DonationRequestController extends Controller
{
    public function createNewDonationRequest(Request $Request){
        $validation = validator()->make($Request->all(), [
            'patient_name'=> 'required'         , 'patient_phone'=> 'required',
            'age'       => 'required|integer'   , 'bags'         => 'required',
            'hospital'  => 'required'           , 'address'      => 'required',
            'notes'     => 'required'           , 'blood_type_id'=> 'required',
            'city_id'   => 'required|integer'   , 'client_id'    => 'required|integer'
        ]);

        if ($validation->fails())
            return response()->json($validation->errors());
        $donation = $Request->user()->donationRequest()->create($Request->all());
        $bloodTypeName = BloodType::where('id', $Request->blood_type_id)->pluck('name');

        $notification = new Notification;
        $notification->id = $donation->id;
        $notification->title = 'Alert! There\'s a new donation request now';
        $notification->content = $Request->patient_name . ' needs blood of type : ' . $bloodTypeName;
        $notification->save();

        # get governorate_id from cities based on city_id
        $governorateId = City::where('id', $Request->city_id)->pluck('governorate_id');
        # get client_id from client_governorate based on governorate_id
        $governorateClients = ClientGovernorate::where('governorate_id', $governorateId)->pluck('client_id');

        # get client_id from blood_type_client based on blood_type_id
        $bloodTypeClients = BloodTypeClient::where('blood_type_id', $Request->blood_type_id)->pluck('client_id');

        # check if (same client here & there), then insert into client_notification
        foreach ($governorateClients as $gc){
            foreach ($bloodTypeClients as $bc) {
                if ($gc == $bc)
                    $result = ClientNotification::create([
                        'client_id'       => $gc,
                        'notification_id' => $donation->id
                    ]);
            }
        }

        if ($result)
            return response()->json('Donation Request with Notification Stored Successfully.');
        return response()->json('Error - check entered data.');
    }

    public function viewOneDonationRequest($id){
        return DonationRequest::where('id', $id)->get();
    }

    public function viewDonationRequests(Request $request){
        $donationRequests = DonationRequest::join('cities', 'donation_requests.city_id', '=', 'cities.id')
            ->join('governorates', 'cities.governorate_id', '=', 'governorates.id')
            ->join('blood_types', 'donation_requests.blood_type_id', '=', 'blood_types.id')
            ->select(['donation_requests.*', 'cities.name as cityName', 'blood_types.name as bloodTypeName'])
            ->where(function($query)use ($request){
                if ($request->has('bloodType')){
                    $query->where('blood_type_id', $request->bloodType);
                }
//                if ($request->has('cityId')){
//                    $query->where('city_id', $request->cityId);
//                }
                if ($request->has('govId')){
                    $query->where('governorate_id', $request->govId);
                }
            })->paginate(10);

        return response()->json($donationRequests);
    }

    public function viewBloodTypes(){
        $bloodTypes = BloodType::all();
        return json_encode($bloodTypes);
    }
}
