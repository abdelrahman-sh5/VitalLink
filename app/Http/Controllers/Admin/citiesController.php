<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\City;
use App\Http\Controllers\Controller;

class citiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = City::paginate(10);
        return view('admin.cities.index')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.createForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =['name' => 'required'];
        $validate = \Validator::make($request->all(),$rules);
        if ($validate->fails())
            return view('admin.cities.createForm')->withErrors($validate);
        return (City::create($request->all()))
            ? redirect(route('cities.index'))->with('message', 'success') :  view('admin.cities.createForm');
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
        $row = City::findOrFail($id);
        return view('admin.cities.updateForm', ['row'=> $row]);
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
        $row = City::findOrFail($id);
        $rules =['name' => 'required'];
        $messages = ['name.required' => 'PLeaZe ENTER da name of this city'];
        $validate = \Validator::make($request->all(),$rules, $messages);
        if ($validate->fails())
            return view('admin.cities.updateForm')->withErrors($validate)->with('row', $row);
        return ($row->update($request->all())) ? redirect(route('cities.index')) :  view('admin.cities.updateForm')->with('row', $row);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = City::find($id);
        $row->delete();
        return redirect(route('cities.index'));
    }
}
