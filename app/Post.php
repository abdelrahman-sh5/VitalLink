<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'image');

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function clientsFav()
    {
        return $this->belongsToMany('App\Client');
    }

}
