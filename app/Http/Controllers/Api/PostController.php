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
        $favorites = ClientPost::join('posts', 'client_post.post_id', '=', 'posts.id')
            ->join('clients', 'client_post.client_id', '=', 'clients.id')
            ->where('clients.id', '=', $Request->id)       // where clause should come before get
            ->get([
                'posts.title',
                'posts.content',
                'posts.image'
            ]);
        return response()->json($favorites);
    }


    public function toggleFavorite(Request $request){
        $client = Client::find($request->id);
        $client->postsFav()->toggle($request->post);
        return response()->json('Added to - Removed from | favorites!');
    }


    public function viewPosts(){
        $posts = Post::all();
        return json_encode($posts);
    }


    public function viewOnePost($id){
        $post = Post::find($id);
        return $post;
    }

}
