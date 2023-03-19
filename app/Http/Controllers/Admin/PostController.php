<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post::paginate(3);
        return view('admin.posts.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.createForm');
    }

    /**
     * Store a newly created resource in storage.
     * $request->file('image')->getClientOriginalExtension()  -OR-  $request->image->extension()
     * guessExtension() - getMimeType() = getClientMimeType() -
     * getClientOriginalName() - getClientExtension() -getSize() - getError()
     * store() - asStore() - storePublicly() - move()
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =['title' => 'required', 'content' => 'required', 'image'=>'image'];
        $request->validate($rules);
        $post = new Post();
        $post->title    = $request->input('title');
        $post->content  = $request->input('content');
        $post->image    = 'default.jpg';        // that's why we did not use static method ::create()
        $post->category_id   = $request->input('category_id');
        if ($request->hasFile('image')){
            $newImageName = time() . rand(10, 999) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(storage_path('app/public/images'), $newImageName);
            $post->image    = $newImageName;
        }
        return ($post->save()) ? redirect(route('posts.index'))->with('message', 'Added Successfully') : redirect(route('posts.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('admin.posts.updateForm', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(['title'=>'required', 'content'=>'required']);
        $post = Post::find($id);
        $post->title    = $request->input('title');
        $post->content  = $request->input('content');
        $post->category_id  = $request->input('category_id');
        if ($request->hasFile('image')){
            $newImageName = time() . rand(10, 999) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(storage_path('app/public/images'), $newImageName);
            $post->image    = $newImageName;
        }
        return ($post->save()) ? redirect(route('posts.index')) : view('admin.posts.updateForm')->with('post', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect(route('posts.index'))->with('message', 'Deleted');
    }
}
