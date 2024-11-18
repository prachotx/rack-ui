<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Packing;
use App\Models\PackingDetail;
use App\Models\Product;
use App\Models\Rack;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackingDetailController extends Controller
{
    public function index($id)
    {
        $packing = Packing::find($id);
        return view("packing_detail", compact(['packing']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add($id)
    {
        $packing = Packing::find($id);
        $products = Product::all()->pluck('code','id');
        return view('add_packing_detail',compact(['id','packing','products']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create($id, Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'ref_no' => 'required',
            'quantity' => 'required',
        ]);
        $data = [
            'packing_id' => $id,
            'product_id' => $request->product_id,
            'ref_no' => $request->ref_no,
            'quantity' => $request->quantity,
            'remain_quantity' => $request->quantity,
        ];
        PackingDetail::create($data);
        return redirect('/packing_detail/'.$id);
    }

    /**
     * Display the specified resource.
     */
    public function show(PackingDetail $packingDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $packing_detail = PackingDetail::find($id);
        $products = Product::all()->pluck('code','id');
        return view('edit_packing_detail', compact(['packing_detail','products']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'ref_no' => 'required',
            'quantity' => 'required',
        ]);
        $data = [
            'product_id' => $request->product_id,
            'ref_no' => $request->ref_no,
            'quantity' => $request->quantity,
            'remain_quantity' => $request->quantity,
        ];
        $packing_detail = PackingDetail::find($id);
        $packing_detail->update($data);
        return redirect('/packing_detail/'.$packing_detail->packing->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $packing_detail = PackingDetail::find($id);
        $packing_id = $packing_detail->packing->id;
        $packing_detail->delete();
        return redirect('/packing_detail/'.$packing_id);
    }

    public function select_rack($id)
    {
        $packing_detail = PackingDetail::find($id);
        $racks = Rack::all()->pluck('name', 'id')->toArray();
        $rack_data = Rack::all();
        return view('select_rack', compact(['packing_detail','racks','rack_data']));
    }

    public function select_block($id, Request $request)
    {
        $packing_detail = PackingDetail::find($id);
        $request->validate([
            'quantity' => '',
            'remain_height' => 'required',
        ]);
        if($packing_detail->quantity > $request->quantity){
            $data = [
                'packing_id' => $packing_detail->packing->id,
                'product_id' => $packing_detail->product_id,
                'ref_no' => $packing_detail->ref_no,
                'quantity' => $packing_detail->quantity - $request->quantity,
                'remain_quantity' => $packing_detail->quantity - $request->quantity,
                'remark' => $packing_detail->remark,
            ];
        
            $block = Block::find($request->block_id);
            $data = [
                'remain_height' => $request->remain_height,
            ];

            $block->update($data);
            $data = [
                'block_id' => $request->block_id,
                'height' => '50',
                'support_weight' => '50',
                'status' => 'draft',
            ];
            $packing_detail->update($data);
        }
        else
        {
            $block = Block::find($request->block_id);
            $data = [
                'remain_height' => $request->remain_height,
            ];
            $block->update($data);
            $data = [
                'block_id' => $request->block_id,
                'height' => '50',
                'support_weight' => '50',
                'status' => 'draft',
            ];
            $packing_detail->update($data);
        }

        return redirect('/packing_detail/'.$packing_detail->packing->id);
    }

    public function stores(Request $request)
    {
        $search = $request->search;
        $packing_details = PackingDetail::join('packings','packing_details.packing_id','packings.id')
        ->join('products','packing_details.product_id','products.id')
        ->where('packings.status','=','approve')
        ->where(function (Builder $query) use($search){
            $query->orWhere('products.code','like','%'.$search.'%')
                  ->orWhere('packing_details.ref_no','like','%'.$search.'%');
        })
        ->where('packing_details.remain_quantity','>',0)
        ->select('packing_details.*')
        ->orderBy('products.code')
        ->paginate(10)
        ->withQueryString();;
        return view('/stores',compact(['packing_details','search']));
    }
}
