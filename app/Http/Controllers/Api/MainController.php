<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Governorate;
use App\Models\City;
use App\Models\Setting;

class MainController extends Controller
{
    public function governorates(){
        $governorates = Governorate::all();
        return json_encode($governorates);
    }


    public function cities(){
        $cities = City::all();
        return json_encode($cities);
    }


    public function categories(){
        $categories = Category::all();
        return json_encode($categories);
    }

    public function settings(){
        $settings = Setting::all();
        return json_encode($settings);
    }

}
