<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content');

    public function donationRequest()
    {
        return $this->belongsTo('App\DonationRequest');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Client');
    }

}
