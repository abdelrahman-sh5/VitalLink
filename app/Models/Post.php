<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'image', 'category_id');

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function clientsFav()
    {
        return $this->belongsToMany('App\Models\Client');
    }

    public static function getAll()
    {
        $posts = Post::all()->sortDesc();
        return $posts;
    }

    public static function getRelatedPosts($categoryId, $postId)
    {
        $relatedPosts = Post::where('category_id', $categoryId)
                        ->where('id', '!=', $postId)
                        ->get()->sortDesc();
        return $relatedPosts;
    }
}
