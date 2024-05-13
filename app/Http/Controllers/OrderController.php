<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $fromDate = Request('from_date');
        $toDate = Request('to_date');

        if ($fromDate && $toDate) {
            $orders = Order::whereBetween('created_at', [$fromDate, $toDate])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
                return view('order.index', compact('orders'));
        } else {
            $orders = Order::paginate(10);
            return view('order.index', compact('orders'));
        } 
    }
    
}
