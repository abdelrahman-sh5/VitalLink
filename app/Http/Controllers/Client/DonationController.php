<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DonationRequest;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\Request;

class DonationController extends Controller
{

    public function index(Request $request)
    {
        $donations = DonationRequest::where(function ($query) use($request){
            if ($request->get('city_id')){
                $query->where('city_id', $request->city_id);
            }
            if ($request->get('blood_type_id')){
                $query->where('blood_type_id', $request->blood_type_id);
            }
            if ($request->input('search')){
                $query->where('patient_name', 'LIKE', "%{$request->search}%");//->where('patient_name', 'LIKE', "%{$request->search}%");
            }
        })->orderBy('created_at', 'desc')->paginate(3);
        return view('client.donations.donationRequests', ['donations' => $donations]);
    }


    public function create(Request $request)
    {
        if ($request->session()->has('client')) {
            return view('client.donations.createDonation');
        }
        return redirect(route('show-login'));//'client.auth.login');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        if ($request->session()->has('client')) {
            $rules = [ '*' => 'required'];
            $request->validate($rules);
            $request->merge(['client_id'=> session()->get('client')->id]);
            DonationRequest::create($request->all());
            return redirect(route('donation-requests.index'));

        }
        return view('client.auth.login');
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     */
    public function show($id)
    {
        $donation = DonationRequest::findOrFail($id);
        $client = new GuzzleClient();     # Guzzle HTTP Client
        $preciseAddress = $client->get('https://geocode.arcgis.com/arcgis/rest/services/World/GeocodeServer/reverseGeocode?f=pjson&featureTypes=&location=
        '. $donation->latitude . ',' . $donation->longitude)->getBody();

        return view('client.singles.donation')->with([
            'donation'=> $donation,
            'preciseAddress' => json_decode($preciseAddress)
        ]);
    }

}
