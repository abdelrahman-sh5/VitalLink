<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model 
{

    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $fillable = array('patient_name', 'patient_phone', 'age', 'bags', 'hospital', 'address', 'notes', 'latitude', 'longitude');

    public function bloodType()
    {
        return $this->belongsTo('App\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function notification()
    {
        return $this->hasOne('App\Notification');
    }

}