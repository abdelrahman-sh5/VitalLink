<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password', 'phone', 'pin_code', 'birthdate', 'last_donation_date');

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\BloodType');
    }

    public function governorates_notify()
    {
        return $this->belongsToMany('App\Governorate');
    }

    public function bloodTypes_notify()
    {
        return $this->belongsToMany('App\BloodType');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Notification');
    }

    public function posts_fav()
    {
        return $this->belongsToMany('App\Post');
    }

    public function donationRequest()
    {
        return $this->hasMany('App\DonationRequest');
    }

}