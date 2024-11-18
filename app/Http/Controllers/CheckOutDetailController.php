<?php

namespace App\Http\Controllers;

use App\Models\CheckOut;
use App\Models\CheckOutDetail;
use App\Models\PackingDetail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CheckOutDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $check_out = CheckOut::find($id);
        return view("check_out_detail", compact(['check_out']));
    }

    public function select_packing_detail($id,Request $request)
    {
        $check_out = CheckOut::find($id);
        $search = $request->search;
        $packing_details = PackingDetail::join('packings','packing_details.packing_id','packings.id')
        ->join('products','packing_details.product_id','products.id')
        ->leftJoin('check_out_details', function($q) use ($id)
        {
            $q->on('check_out_details.packing_detail_id', '=', 'packing_details.id')
                ->where('check_out_details.check_out_id', '=', "$id");
        })
        ->where('packings.status','=','approve')
        ->where(function (Builder $query) use($search){
            $query->orWhere('products.code','like','%'.$search.'%')
                  ->orWhere('packing_details.ref_no','like','%'.$search.'%');
        })
        ->where('packing_details.remain_quantity','>',0)
        ->whereNull('check_out_details.id')
        ->select('packing_details.*')
        ->orderBy('products.code')
        ->paginate(10)
        ->withQueryString();;
        
        return view("select_packing_detail", compact(['check_out','packing_details','search']));
    }

    
    public function assign_check_out_quantity($id,Request $request)
    {
        $check_out = CheckOut::find($id);
        $packing_detail = PackingDetail::find($request->packing_detail_id);
        return view('assign_check_out_quantity',compact(['check_out','packing_detail']));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($id,Request $request)
    {
        $check_out = CheckOut::find($id);
        $packing_detail = PackingDetail::find($request->packing_detail_id);
        $request->validate([
            'packing_detail_id' => 'required',
            'quantity' => 'required',
        ]);
        $data = [
            'check_out_id' => $id,
            'packing_detail_id' => $request->packing_detail_id,
            'quantity' => $request->quantity,
        ];
        CheckOutDetail::create($data);;
        return redirect('/check_out_detail/'.$id);
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
    public function show(CheckOutDetail $checkOutDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CheckOutDetail $checkOutDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CheckOutDetail $checkOutDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $check_out_detail = CheckOutDetail::find($id);
        $check_out_id = $check_out_detail->check_out_id;
        $check_out_detail->delete();
        return redirect('/check_out_detail/'.$check_out_id);
    }
}
