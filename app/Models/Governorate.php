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

    public function clientsNotify()
    {
        return $this->belongsToMany('App\Models\Client');
    }

    public static function getAll(){
        return Governorate::all();
    }

}
