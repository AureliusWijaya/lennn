<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function index()
    {
        // Get all orders for the authenticated user
        $orders = order::where('user_id', Auth::id())->with('orderitem.product')->get();

        return view('order-history', compact('orders'));
    }
}
