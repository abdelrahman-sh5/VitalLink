<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\sendMail;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('client.main');
    }

    public function favorites(Request $request)
    {
        $favorites = session()->get('client')->postsFav()->paginate(10);
        return view('client.favorites.favorites', ['favorites' => $favorites, 'clientData' => $profileData]);
    }

    public function toggleFavorite(Request $request)
    {
        if ($request->session()->has('client')) {
            if (session()->get('client')->postsFav()->toggle($request->post_id)) {
                return view('client.main');
            } else {
                return 'error';
            }
        } else {
            return 'false';
        }
    }

    public function post($id)
    {
        $record = Post::find($id);
        $relatedPosts = Post::getRelatedPosts($record->category_id, $record->id);
        return view('client.singles.post', compact('record', 'relatedPosts'));
    }

    public function contact()
    {
        $data = Setting::first();
        return view('client.singles.contact-us', compact('data'));
    }

    public function sendContactDetails(Request $request)
    {
        $rules = [
            'name' => 'required', 'phone' => 'required',
            'email' => 'required', 'title' => 'required', 'message' => 'required'
        ];
        $request->validate($rules);
        $details = [
            'title' => $request->title,
            'body' => 'It\'s just an email to provide you a client contact message '. $request->message
        ];
        \Mail::to($request->email)->send(new sendMail($details));
        $result = Contact::create($request->all());
        if ($result)
            return redirect('/contact-us');
        return view('client.singles.contact-us')->with('message', 'Error');
    }

    public function whoAreUs()
    {
        $data = Setting::first();
        return view('client.singles.who-are-we', compact('data'));
    }

}
