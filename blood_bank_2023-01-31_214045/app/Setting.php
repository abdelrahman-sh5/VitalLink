<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('notification_text', 'about_text', 'phone', 'email', 'fb_link', 'wa_link', 'tw_link', 'insta_link', 'yt_link');

}