<?php

namespace App\Http\Controllers\Api;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Clone_;
use App\Mail\sendMail;

class AuthController extends Controller
{
    // TODO: protected $hidden not working.

    public function profile(){
        if (\Auth::check())
            return 'logged in';
        return 'not logged in';
    }
    public function register(Request $r)
    {
        // Firstly validate input.
//      $r->validate([]);
        $v = validator()->make($r->all(), [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:clients', // |unique:clients, email',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required',
            'birthdate' => 'required|date',
            'city_id' => 'required',
            'blood_type_id' => 'required|integer|min:1|max:6',
            'last_donation_date' => 'required|date'
        ]);

        if ($v->fails())
            return response()->json($v->errors());

        $c = new Client();
        $c->name = $r->input('name');
        $c->email = $r->input('email');
        $c->password = Crypt::encrypt($r->input('password'));
        $c->phone = $r->input('phone');
        $c->birthdate = $r->input('birthdate');
        $c->city_id = $r->input('city_id');
        $c->blood_type_id = $r->input('blood_type_id');
        $c->last_donation_date = $r->input('last_donation_date');
        $c->api_token = md5(rand());
        $c->save();
        if ($c->save()){
            return response()->json([
                'token' => $c->api_token,
                'client_data' => $r->except(['password', 'password_confirmation'])
            ]);
        }else
            return json_encode("Error registering this client");

    }

    public function login(Request $r){

        $v = validator()->make($r->all(), [
            'phone'     => 'required|string',
            'password'  => 'required'
        ]);

        if ($v->fails())
            return response()->json($v->errors());

//        $auth = auth()->guard('api')->validate($r->all());
        $client = DB::table('clients')->where('phone', $r->phone)->first();

        if ($client && (decrypt($client->password) === $r->password) ) {
            return response()->json([
                'token' => $client->api_token,
                'Client' => [
                    'name' => $client->name,
                    'email' => $client->email,
                    'phone' => $client->phone,
                    'city_id' => $client->city_id,
                    'blood_type_id' => $client->blood_type_id,
                    'last_donation_date' => $client->last_donation_date
                ]
            ]);
        }else{
            return json_encode(["Incorrect Data!"]);
        }

    }

    public function resetPassword(Request $request){

        $validate = validator()->make($request->all(), [ 'phone' => 'required']);

        if ($validate->fails())
            return response()->json($validate->errors());

        # check if pin_code is already there & send email with pin code to this client.
        $clientData = Client::where('phone', '=', $request->phone)->get();

        if ($clientData->first()->pin_code === null) {
            $generatedPinCode = rand(100000, 1000000);
            $client = DB::table('clients')
                ->where('phone', $request->phone)
                ->update(['pin_code' => $generatedPinCode]);

            $details = [
                'title' => 'Your PinCode is Ready',
                'body' => 'It\'s just an email to provide you with your pin_code '. $generatedPinCode
            ];
            \Mail::to($clientData->first()->email)->send(new sendMail($details));
        if ($client)
            return response()->json('Your pin code is ready check your email!');
        }
        return response()->json('Your pin code has been already sent! Check your inbox');
    }

    # Need to be modified (Enhancement)
    public function createNewPassword(Request $Request){
        $validator = validator()->make($Request->all(), [
            'pin_code' => 'required|integer',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        # authenticate this user
        $clientPinCode = DB::table('clients')->where('pin_code', $Request->pin_code)->first();

        $clientObject = Client::where('pin_code', $Request->pin_code)->get();

        if ($clientPinCode && ($clientPinCode->pin_code) == $Request->pin_code) {

            # update this user's data.
           $c_toUpdate =  DB::table('clients')->where('pin_code', $Request->pin_code)
                ->where('pin_code', $Request->pin_code)
                ->update(['password' => Crypt::encrypt($Request->password)]);

            # get his data to be returned.
            $updateClient =  DB::table('clients')->where('pin_code', $Request->pin_code)->first();

            return response()->json([
                'Client' => [
                    'name' => $updateClient->name,
                    'email' => $updateClient->email,
                    'phone' => $updateClient->phone,
                    'city_id' => $updateClient->city_id,
                    'blood_type_id' => $updateClient->blood_type_id,
                    'last_donation_date' => $updateClient->last_donation_date
                ]
            ]);
        }else{
            return json_encode(["Incorrect Data!"]);
        }
    }

}
