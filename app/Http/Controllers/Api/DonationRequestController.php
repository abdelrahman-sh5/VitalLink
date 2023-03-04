<?php

namespace App\Http\Controllers\Api;

use App\Models\BloodTypeClient;
use App\Models\City;
use App\Models\ClientGovernorate;
use App\Models\ClientNotification;
use App\Models\DonationRequest;
use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\Notification;
use App\Models\Token;
use Illuminate\Http\Request;

class DonationRequestController extends Controller
{
    public function sendFCM($tokens, $title, $body){
        $data = [
            "registration_ids" => $tokens,
            "notification" => [
                "title" => $title,
                "body" => $body,
                'sound' => "default",
                'color' => "#203E78",
                'light' => 'default'
            ]
        ];

        $dataString = json_encode($data);
        $headers = array(
            'Authorization: key=' . config('fcm.app_key'),
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    public function createNewDonationRequest(Request $request){
        $validation = validator()->make($request->all(), [
            'patient_name'=> 'required'         , 'patient_phone'=> 'required',
            'age'       => 'required|integer'   , 'bags'         => 'required',
            'hospital'  => 'required'           , 'address'      => 'required',
            'notes'     => 'required'           , 'blood_type_id'=> 'required',
            'city_id'   => 'required|integer'
        ]);

        if ($validation->fails())
            return response()->json($validation->errors());
        $donation = $request->user()->donationRequest()->create($request->all());
        $bloodTypeName = BloodType::where('id', $request->blood_type_id)->pluck('name');

        $notification = new Notification;
        $notification->id       = $donation->id;
        $notification->title    = 'Alert! There\'s a new donation request now';
        $notification->content  = $request->patient_name . ' needs blood of type : ' . $bloodTypeName;
        $notification->save();

        $clientsIds = $donation->city->governorate
            ->clientsNotify()->whereHas('bloodTypesNotify', function($q) use ($request){
                $q->where('blood_types.id', $request->blood_type_id);
            })->pluck('clients.id')->toArray();
        $result = $notification->clients()->sync($clientsIds);

        $tokens = Token::whereIn('client_id', $clientsIds)
                        ->where('token' ,'!=',null)->pluck('token')->toArray();

        if (count($tokens) > 0){
        $result = $this->sendFCM($tokens, $notification->title, $notification->content);
        }

        $tokens = $request->user()->tokens()->where('token' ,'!='. '')
                        ->whereIn('client_id', $clientsIds)->pluck('token')->toArray();

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
