<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\BloodType;

use Illuminate\Http\Request;

class DonationRequestController extends Controller
{
    public function viewBloodTypes(){
        $bloodTypes = BloodType::all();
        return json_encode($bloodTypes);
    }
}
