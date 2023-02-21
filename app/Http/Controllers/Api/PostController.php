<?php

namespace App\Http\Controllers\Api;

use App\Models\ClientPost;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Client;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function listFavorites(Request $Request){
        $client     = $Request->user();
        $favorites  = $client->postsFav()->paginate(10);
        return response()->json($favorites);
    }

    public function toggleFavorite(Request $request){
        $validator = validator()->make($request->all(), [
            'post_id' => 'required|integer'
        ]);
        if ($validator->fails())
            return response()->json($validator->errors());

        $request->user()->postsFav()->toggle($request->post_id);
        return response()->json('Added to - Removed from | favorites!');
    }

    public function viewPosts(Request $request){
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
