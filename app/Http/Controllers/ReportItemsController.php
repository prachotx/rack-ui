<?php

namespace App\Http\Controllers;

use App\Models\ReportItems;
use Illuminate\Http\Request;

class ReportItemsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $reportItems = ReportItems::query()
        ->where('product_code', 'like', "%{$search}%")
        ->orWhere('quantity', 'like', "%{$search}%")
        ->orWhere('status', 'like', "%{$search}%")
        ->orWhere('comment', 'like', "%{$search}%")
        ->get();

        return view('reports', compact('reportItems', 'search'));
    }
}
