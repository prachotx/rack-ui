<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
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
        $branches=Branch::where('name','like','%'.$search.'%')
        ->orderByDesc('id')->paginate(10)->withQueryString();
        return view("branch",compact(['branches','search']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        return view('/add_branch');
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
        $branch = Branch::create($data);
        return redirect('/branches');
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    function edit($id)
    {
        $branch = Branch::find($id);
        return view('/edit_branch', compact(['branch']));
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
        $branch = Branch::find($id)->update($data);
        return redirect('/branches');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        Branch::find($id)->delete();
        return redirect('/branches');
    }
}
