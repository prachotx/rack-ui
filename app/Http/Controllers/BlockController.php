<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function view($id)
    {
        $block = Block::find($id);
        return view('/view_block', compact(['block']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $block = Block::find($id);
        return view('/edit_block', compact(['block']));
    }

    /**
     * Update the specified resource in storage.
     */
    function update($id, Request $request)
    {
        $request->validate([
            'depth' => 'required',
            'long' => 'required',
            'height' => 'required',
            'remain_height' => 'required',
        ]);
        $data = [
            'depth' => $request->depth,
            'long' => $request->long,
            'height' => $request->height,
            'remain_height' => $request->remain_height,
        ];
        Block::find($id)->update($data);
        $block = Block::find($id);
        //update long in same column
        Block::where('rack_id', $block->rack->id)
        ->where('column_position', $block->column_position)
        ->update(['long' => $request->long]);
        //update long in same row
        Block::where('rack_id', $block->rack->id)
        ->where('row_position', $block->row_position)
        ->update(['height' => $request->height]);
        return redirect('/view_block/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Block $block)
    {
        //
    }
}
