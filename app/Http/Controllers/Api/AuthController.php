<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\Clone_;
use App\Mail\sendMail;

class AuthController extends Controller
{
    public function profile(Request $request){
        $clientData = Client::whereId($request->user()->id)->with('bloodType','city')
                    ->get()->makeHidden(['api_token', 'pin_code']);

        if ($request->has('name') || $request->has('email') || $request->has('phone') ||
            $request->has('password') || $request->has('birthdate') || $request->has('last_donation_date') ||
            $request->has('city_id') || $request->has('blood_type_id')){

            $validation = validator()->make($request->all(),[
                'birthdate' => 'date',
                'last_donation_date' => 'date',
                'email' => Rule::unique('clients')->ignore($request->user()->email),
                'phone' => Rule::unique('clients')->ignore($request->user()->phone)
            ]);

            if ($validation->fails()){
                return response()->json($validation->errors());
            }

            if($request->user()->update($request->all())){
                return response()->json('Your data is now updated.');
            }
                return response()->json('Error while updating your data!');
        }
        return $clientData;
    }

    public function register(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:clients',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required|unique:clients'   , 'birthdate' => 'required|date',
            'city_id' => 'required' , 'blood_type_id' => 'required|integer|min:1|max:6',
            'last_donation_date' => 'required|date'
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

          $password = Hash::make($request->password);
          $request->merge(['password'=>$password]);
          $client = Client::create($request->all());
          $client->api_token = md5(rand());

          $clientData = Client::where('name', $request->input('name'))->first();
          $clientData->bloodTypesNotify()->attach($clientData->blood_type_id);
          $clientGovernorate = City::where('id', $clientData->city_id)->first();
          $clientData->governoratesNotify()->attach($clientGovernorate->governorate_id);

        if ($client->save()){
            return response()->json([
                'token' => $client->api_token,
                'client_data' => $request->except(['password', 'password_confirmation'])
            ]);
        }else
            return json_encode("Error registering this client");
    }

    public function login(Request $request){
        $validation = validator()->make($request->all(), [
            'phone'     => 'required|string',
            'password'  => 'required'
        ]);
        if ($validation->fails())
            return response()->json($validation->errors());

        $client = Client::where('phone', $request->phone)->first();

        if ($client && Hash::check($request->password, $client->password) ) {
            return response()->json([
                'token' => $client->api_token,
                'Client' => [
                    'name' => $client->name,
                    'email' => $client->email,
                    'phone' => $client->phone,
                    'city_id' => $client->city_id,
                    'blood_type_id' => $client->blood_type_id,
                    'birthdate' => $client->birthdate,
                    'last_donation_date' => $client->last_donation_date
            ]]);
        }
        return json_encode(["Incorrect Data!"]);
    }

    public function resetPassword(Request $request){
        $validate = validator()->make($request->all(), [ 'phone' => 'required']);
        if ($validate->fails())
            return response()->json($validate->errors());

        $clientData = Client::where('phone', '=', $request->phone)->first();
        if ($clientData && $clientData->pin_code === null) {
            $generatedPinCode = rand(100000, 1000000);
            $client = Client::where('phone', $request->phone)->update(['pin_code' => $generatedPinCode]);
            $details = [
                'title' => 'Your PinCode is Ready',
                'body' => 'It\'s just an email to provide you with your pin_code '. $generatedPinCode
            ];
            \Mail::to($clientData->email)->send(new sendMail($details));
        if ($client)
            return response()->json('Your pin code is ready check your email!');
        }
        return response()->json('Error - Check your phone or email');
    }

    public function createNewPassword(Request $Request){
        $validator = validator()->make($Request->all(), [
            'phone' => 'required',
            'pin_code' => 'required|integer',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());
        $password = Hash::make($Request->password);

        # Ensure this user is registered and if so update his credentials.
        $clientPinCode = Client::where('phone', $Request->phone)
                                ->where('pin_code', $Request->pin_code)
                                ->update(['password'=> $password, 'pin_code' => null]);
        if ($clientPinCode) {
            return response()->json('Your Password has been updated successfully');
        }else{
            return json_encode(["Incorrect Data!"]);
        }
    }

}
