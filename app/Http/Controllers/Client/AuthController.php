<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\sendMail;
use App\Models\City;
use App\Models\Client;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('client.auth.register');
    }

    public function register(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:clients',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required|unique:clients',
            'birthdate' => 'required|date',
            'city_id' => 'required',
            'blood_type_id' => 'required|integer|min:1|max:6',
            'last_donation_date' => 'required|date'
        ]);

        if ($validator->fails()) {
            return back()->with('errors', $validator->errors());
        }

        $password = Hash::make($request->password);
        $request->merge(['password' => $password]);
        $client = Client::create($request->all());
        $client->api_token = md5(rand());

        $clientData = Client::where('name', $request->input('name'))->first();
        $clientData->bloodTypesNotify()->attach($clientData->blood_type_id);
        $clientGovernorate = City::where('id', $clientData->city_id)->first();
        $clientData->governoratesNotify()->attach($clientGovernorate->governorate_id);

        if ($client->save()) {
            return view('client.main');
        } else {
            return back()->withErrors(["Incorrect Data!"]);
        }
    }

    public function showLogin()
    {
        return view('client.auth.login');
    }

    public function login(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'phone' => 'required|string',
            'password' => 'required'
        ]);
        if ($validation->fails()) {
            return back()->with('errors', $validation->errors());
        }
        if ($request->rememberMe){
            // save client's cookies for 3 days
            $phoneCookie    = Cookie::queue(Cookie::make('phone', $request->phone, time() + 60 * 60 * 24 * 3));
            $passwordCookie = Cookie::queue(Cookie::make('password', $request->password, time() + 60 * 60 * 24 * 3));
        }

        $client = Client::where('phone', $request->phone)->first();

        if ($client && Hash::check($request->password, $client->password)) {
            $request->session()->put('client', $client);
            return redirect(route('/'));
        }
        return back()->withErrors(["Incorrect Data!"]);
    }

    # Show profile
    public function profile(Request $request)
    {
        $profileData = Client::whereId(session()->get('client')->id)->with('bloodType', 'city')
            ->first()->makeHidden(['api_token', 'pin_code']);

        return view('client.auth.profile', ['clientData' => $profileData]);

    }

    # Update profile data
    public function updateProfile(Request $request)
    {
        $id = session()->get('client')->id;

        $rules = [
            'name' => 'required',
            'email' => ['required', Rule::unique('clients')->ignore($id)],
            'phone' => ['required', Rule::unique('clients')->ignore($id)],
            'birthdate' => 'required|date',
            'city_id' => 'required',
            'blood_type_id' => 'required|integer|min:1|max:6',
            'last_donation_date' => 'required|date'
        ];
        $request->validate($rules);
        $client = Client::whereId($id)->update($request->except(['_token', '_method']));
        $profileData = Client::whereId($id)->with('bloodType', 'city')
            ->first()->makeHidden(['api_token', 'pin_code']);
        if ($client) {
            return view('client.auth.profile')->with('clientData', $profileData);
        }
        return back()->withErrors(['Error updating your profile']);
    }

    public function showResetPassword()
    {
        return view('client.auth.resetPassword');
    }

    public function resetPassword(Request $request)
    {
        $request->validate(['phone' => 'required']);
        $clientData = Client::where('phone', '=', $request->phone)->first();
        if ($clientData && $clientData->pin_code === null) {
            $generatedPinCode = rand(100000, 1000000);
            $client = Client::where('phone', $request->phone)->update(['pin_code' => $generatedPinCode]);
            $details = [
                'title' => 'Your PinCode is Ready',
                'body' => 'It\'s just an email to provide you with your pin_code ' . $generatedPinCode .
                 'Click the following link to create a new password  ' . url('auth/show-change-password')
            ];
            \Mail::to($clientData->email)->send(new sendMail($details));
            if ($client) {
                return redirect('/')->with('message', 'Email');
            }
        }
        return back()->withErrors(["Error - Check your data"]);
    }

    public function showChangePassword()
    {
        return view('client.auth.changePassword');
    }

    public function changePassword(Request $Request)
    {
        $validator = validator()->make($Request->all(), [
            'phone' => 'required',
            'pin_code' => 'required',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $password = Hash::make($Request->password);

        # Ensure this user is registered and if so update his credentials.
        $clientPinCode = Client::where('phone', $Request->phone)
            ->where('pin_code', $Request->pin_code)
            ->update(['password' => $password, 'pin_code' => null]);
        # reset pin_code to null in case he forgot his password again.

        if ($clientPinCode) {
            return redirect('/')->with('message', 'Password');
        } else {
            return back()->withErrors(["Incorrect Data!"]);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('client');
        return redirect(route('/'));
    }

}
