<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $cart = new Cart();
        $cart->user_id = 1;
        $cart->product_id = $request->pro_id;
        $cart->product_qty = $request->pro_qty;
        $cart->total_price = $request->total_price;
        $cart->save();

        return response()->json(['success' => true,]);
    }

    public function qtyChangePrice(Request $request){
        // dd($request->all());

        $cart = Cart::where('id',$request->id)->where('user_id',1)->first();
        $product = Product::where('id',$cart->product_id)->first();
        $proPrice = $product->selling_price;

        $total = $proPrice * $request->qty;

        $cart->product_qty = $request->qty;
        $cart->total_price = $total;
        $cart->save();

        $subT = Cart::where('user_id',1)->sum('total_price');
        
        return response()->json(['success'=>true, 'totalPrice'=> $total,'id'=> $cart->id,'subT'=>$subT]);

    }
}
