<?php

namespace App\Http\Controllers\Api;

use App\Models\BloodType;
use App\Models\Governorate;
use App\Models\Client;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    # Just a method for learning | practise.
    public function attachClientBloodType(Request $R){
        $client = Client::find($R->id);
//        $clientBloodTypes = $client->bloodTypesNotify()->pluck('blood_types.id');
//        $clientGovernorates = $client->governoratesNotify()->pluck('governorates.id');
//        $client->bloodTypesNotify()->syncWithoutDetaching([6, 4]);
//        $client->bloodTypesNotify()->toggle(3);
//        $request->merge(['nameAdd'=>'test']);   // add data to the ongoing request
        $client->postsFav()->toggle($R->args);
//        $client->bloodTypesNotify()->attach([2, 1]);
//        $client->bloodTypesNotify()->detach([1, 2, 5]);
        return 1;
    }


    public function notifications(Request $request){
        $notifications = $request->user()->notifications()->paginate(10);
        return $notifications;
    }

    public function viewNotificationsSettings(Request $Request) {
         $notifyText     = Setting::get('notification_text');
         $bloodTypes     = BloodType::all();
         $governorates   = Governorate::all();
         $client = $Request->user();
         $clientBloodTypes   = $client->bloodTypesNotify()->pluck('blood_types.id');
         $clientGovernorates = $client->governoratesNotify()->pluck('governorates.id');

         return response()->json([
                'notification_text' => $notifyText,
                'blood_types' => $bloodTypes,
                'client_blood_types' => $clientBloodTypes,
                'governorates' => $governorates,
                'client_governorates' => $clientGovernorates
            ]);
    }

    public function updateNotificationsSettings(Request $Request) {
        $client = $Request->user();
        $client->bloodTypesNotify()->sync($Request->bloodValues);
        $client->governoratesNotify()->sync($Request->governorateValues);
        return response()->json('Done updating your data!');
    }

}
