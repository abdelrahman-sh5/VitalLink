<?php


use App\Models\Client;

$clientData = Client::whereId(session()->get('client')->id)->with('bloodType', 'city')
    ->first()->makeHidden(['api_token', 'pin_code']);
