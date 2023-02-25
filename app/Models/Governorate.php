<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{

    protected $table = 'governorates';
    public $timestamps = true;
    protected $fillable = array('name');

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

    // Governorate has many cities which have many clients => Governorate has many clients.
    public function clients()
    {
        return $this->hasManyThrough(Client::class, City::class);
    }

    // Governorate has many donation requests are in many cities => Governorate has many donation requests.
    public function donationRequests()
    {
        return $this->hasManyThrough(donationRequest::class, City::class);
    }

    public function clientsNotify()
    {
        return $this->belongsToMany('App\Models\Client');
    }

    public static function getAll(){
        return Governorate::all();
    }

}
