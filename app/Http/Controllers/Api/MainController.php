<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Governorate;
use App\City;
use App\Setting;

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
