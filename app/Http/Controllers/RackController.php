<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Location;
use App\Models\Rack;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\Storage;

class RackController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $racks = Rack::where('name', 'like', '%' . $search . '%')
            ->orderByDesc('id')->paginate(10)->withQueryString();
        return view("rack", compact(['racks', 'search']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        $locations = Location::all()->pluck('name', 'id')->toArray();
        return view('/add_rack',compact([ 'locations']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location_id' => 'required',
            'depth' => 'required',
            'rows' => 'required',
            'columns' => 'required',
        ]);
        $data = [
            'code' => uniqid('R-'),
            'name' => $request->name,
            'location_id' => $request->location_id,
            'depth' => $request->depth,
            'rows' => $request->rows,
            'columns' => $request->columns,
        ];
        $rack = Rack::create($data);
        $data = [
            'code' => 'R-'.str_pad($rack->id,4,'0',STR_PAD_LEFT),
        ];
        $rack->update($data);
        return redirect('/racks');
    }

    /**
     * Display the specified resource.
     */
    public function view($id)
    {
        //
        $rack = Rack::find($id);
        $locations = Location::all()->pluck('name', 'id')->toArray();
        return view('/view_rack', compact(['rack', 'locations']));
    }

    function edit($id)
    {
        $rack = Rack::find($id);
        $locations = Location::all()->pluck('name', 'id')->toArray();
        return view('/edit_rack', compact(['rack', 'locations']));
    }

    function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location_id' => 'required',
            'depth' => 'required',
            'rows' => 'required',
            'columns' => 'required',
        ]);
        $data = [
            'name' => $request->name,
            'location_id' => $request->location_id,
            'depth' => $request->depth,
            'rows' => $request->rows,
            'columns' => $request->columns,
        ];
        $rack = Rack::find($id)->update($data);
        return redirect('/racks');
    }

    function enable($id, Request $request)
    {
        $data = [
            'status' => 'confirm',
        ];
        $rack = Rack::find($id)->update($data);
        return redirect('/racks');
    }

    function disable($id, Request $request)
    {
        $data = [
            'status' => 'disable',
        ];
        $rack = Rack::find($id)->update($data);
        return redirect('/racks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        Rack::find($id)->delete();
        return redirect('/racks');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function confirm($id)
    {
        $rack = Rack::find($id);
        for ($r = 0; $r < $rack->rows; $r++) {
            for ($c = 0; $c < $rack->columns; $c++) {
                $data = [
                    'code' => $rack->name . '-' . str_pad($r + 1, 2, '0', STR_PAD_LEFT) . '-' . str_pad($c + 1, 2, '0', STR_PAD_LEFT),
                    'rack_id' => $rack->id,
                    'depth' => $rack->depth,
                    'long' => 200,
                    'height' => 50,
                    'row_position' => $r + 1,
                    'column_position' => $c + 1,
                    'support_weight' => 200,
                    'remain_height' => 100,
                ];
                $block = Block::create($data);
            }
        }
        $rack->update(['status' => 'confirm']);
        return redirect('/racks');
    }
}
