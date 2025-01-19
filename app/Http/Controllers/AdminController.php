<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        $categories = category::all();
        $products = product::all();
        return view('admin', compact('categories', 'products'));
    }
}
