<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password', 'phone', 'birthdate', 'last_donation_date', 'city_id', 'blood_type_id', 'is_active');
    protected $hidden = ['password'];

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function governoratesNotify()
    {
        return $this->belongsToMany('App\Models\Governorate');
    }

    public function bloodTypesNotify()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification');
    }

    public function postsFav()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function donationRequest()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function tokens(){
        return $this->hasMany('App\Models\Token');
    }

}
