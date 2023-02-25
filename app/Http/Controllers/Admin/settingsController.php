<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index(){
        $data = Setting::first();
        return view('admin.settings.index')->with('data', $data);
    }

    public function update(Request $request, $id){
        # Names in form fields [MUST BE] the same as column names in the database table.
        $settingsObject = Setting::find($id);
        $messages = ['tw_link.required'   => 'Twitter link is required',
                    'wa_link.required'   => 'whatsApp link is required',
                    'fb_link.required'   => 'Facebook link is required',
                    'yt_link.required'   => 'Youtube link is required',
                    'insta_link.required'   => 'Instagram link is required',];
        $request->validate([
            'notification_text' => 'required|string',    'insta_link'   => 'required', 'tw_link' => 'required',
            'about_text'        =>'required|string',     'yt_link'   => 'required', 'wa_link'   => 'required',
            'email'             => 'email:rfc,dns',      'fb_link'   => 'required'
        ], $messages);

        $settingsObject->update($request->all());
        return redirect(route('settings.index'));
    }
}
