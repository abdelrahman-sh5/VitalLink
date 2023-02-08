<?php

namespace App\Http\Controllers\Api;

use App\BloodType;
use App\Governorate;
use App\Http\Controllers\Controller;
use App\Client;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    # Just a method for learning | practise.
    public function attachClientBloodType(Request $R){
        $client = Client::find($R->id);
//        $clientBloodTypes = $client->bloodTypesNotify()->pluck('blood_types.id');
//        $clientGovernorates = $client->governoratesNotify()->pluck('governorates.id');
//        $client->bloodTypesNotify()->syncWithoutDetaching([6, 4]);
//        $client->bloodTypesNotify()->toggle(3);
        $client->postsFav()->toggle($R->args);
//        $client->bloodTypesNotify()->attach([2, 1]);
//        $client->bloodTypesNotify()->detach([1, 2, 5]);
        return 1;
    }


     public function viewNotificationsSettings(Request $Request) {
         $notifyText     = Setting::get('notification_text');
         $bloodTypes     = BloodType::all();
         $governorates   = Governorate::all();
         $client = Client::find($Request->id);
         $clientBloodTypes   = $client->bloodTypesNotify()->pluck('blood_types.id');
         $clientGovernorates = $client->governoratesNotify()->pluck('governorates.id');

         return response()->json([
                'Notification Text' => $notifyText,
                'BloodTypes' => $bloodTypes,
                'Client BloodTypes' => $clientBloodTypes,
                'Governorates' => $governorates,
                'Client Governorates' => $clientGovernorates
            ]);
    }

    public function updateNotificationsSettings(Request $Request) {
        $client = Client::find($Request->id);
        $client->bloodTypesNotify()->sync($Request->bloodValues);
        $client->governoratesNotify()->sync($Request->governorateValues);
        return response()->json('Done updating your data!');
    }

}
