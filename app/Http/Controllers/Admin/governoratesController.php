<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Governorate;
use App\Http\Controllers\Controller;


class governoratesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Governorate::paginate(10);
        return view('admin.governorates.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.governorates.createForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required'], ['name.required' => 'fill name field']);
        Governorate::create($request->all());

        return redirect(route('governorates.index'))->with('message', 'Successfully Added');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $governorate = Governorate::find($id);
        return view('admin.governorates.updateForm', ['governorate'=> $governorate]);
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
        $request->validate(['name' => 'required']);
        $governorate = Governorate::find($id);
        $governorate->update($request->all());
        return redirect(route('governorates.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $governorate = Governorate::find($id);
        $governorate->delete();
        return redirect(route('governorates.index'));
    }
}
