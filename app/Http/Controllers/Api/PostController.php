<?php

namespace App\Http\Controllers\Api;

use App\ClientPost;
use App\Http\Controllers\Controller;
use App\Post;
use App\Client;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function listFavorites(Request $Request){
        // don't join manually but use many-to-many function in the table
        $client     = $Request->user();
        $favorites  = $client->postsFav()->paginate(10);
        return response()->json($favorites);
    }

    public function toggleFavorite(Request $request){
        $request->user()->postsFav()->toggle($request->post_id);     // Pass this in Body of the request.
        return response()->json('Added to - Removed from | favorites!');
    }

    public function viewPosts(Request $request){
        // Check if there's a category => ask again if there's a needle otherwise get all posts with this category.
        $posts = Post::where(function($query) use($request){
            if($request->has('category_id')){
                if ($request->has('needle')){
                    $query->where(function($query) use($request){
                        $query->where('title', 'LIKE', "%{$request->needle}%")
                              ->orWhere('content', 'LIKE', "%{$request->needle}%");
                    });
                }
                $query->where('category_id', $request->category_id);
            }
        })->paginate(5);

        return $posts;
    }

    public function viewOnePost($id){
        $post = Post::find($id);
        return $post;
    }

}
