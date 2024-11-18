<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $product_types = ProductType::where('name', 'like', '%' . $search . '%')
            ->orderByDesc('id')->paginate(10)->withQueryString();
        return view("product_type", compact(['product_types', 'search']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        return view('/add_product_type');
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
        $product_type = ProductType::create($data);
        return redirect('/product_types');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductType $product_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    function edit($id)
    {
        $product_type = ProductType::find($id);
        return view('/edit_product_type', compact(['product_type']));
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
        $product_type = ProductType::find($id)->update($data);
        return redirect('/product_types');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        ProductType::find($id)->delete();
        return redirect('/product_types');
    }
}
