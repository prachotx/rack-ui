<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search=$request->search;
        $locations=Location::where('name','like','%'.$search.'%')
        ->orderByDesc('id')->paginate(10)->withQueryString();
        return view("location",compact(['locations','search']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        return view('/add_location');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $data = [
            'name' => $request->name,
        ];
        $location = Location::create($data);
        return redirect('/locations');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    function edit($id)
    {
        $location = Location::find($id);
        return view('/edit_location', compact(['location']));
    }

    /**
     * Update the specified resource in storage.
     */
    function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $data = [
            'name' => $request->name,
        ];
        $location = Location::find($id)->update($data);
        return redirect('/locations');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        Location::find($id)->delete();
        return redirect('/locations');
    }
}
