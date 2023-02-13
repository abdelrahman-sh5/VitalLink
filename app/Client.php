<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password', 'phone', 'birthdate', 'last_donation_date', 'city_id', 'blood_type_id');
    protected $hidden = ['password'];

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\BloodType');
    }

    public function governoratesNotify()
    {
        return $this->belongsToMany('App\Governorate');
    }

    public function bloodTypesNotify()
    {
        return $this->belongsToMany('App\BloodType');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Notification');
    }

    public function postsFav()
    {
        return $this->belongsToMany('App\Post');
    }

    // every hasMany function : make its name in plural. i.e (donationRequest(s))
    public function donationRequest()
    {
        return $this->hasMany('App\DonationRequest');
    }

}
