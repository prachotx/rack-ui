<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $products = Product::where('name', 'like', '%' . $search . '%')
            ->orWhere('code', 'like ', '%' . $search . '%')
            ->orderByDesc('id')->paginate(10)->withQueryString();
        return view("product", compact(['products', 'search']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        $product_types = ProductType::all()->pluck('name','id');
        return view('/add_product',compact(['product_types']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'product_type_id' => 'required',
        ]);
        $data = [
            'code' => $request->code,
            'name' => $request->name,
            'product_type_id' => $request->product_type_id,
        ];
        Product::create($data);
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $product_types = ProductType::all()->pluck('name','id');
        return view('edit_product',compact(['product','product_types']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'product_type_id' => 'required',
        ]);
        $data = [
            'code' => $request->code,
            'name' => $request->name,
            'product_type_id' => $request->product_type_id,
        ];
        Product::find($id)->update($data);
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
