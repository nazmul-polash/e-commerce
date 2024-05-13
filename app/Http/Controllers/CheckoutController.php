<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', 1)->get();
        return view('product.checkout.index', compact('carts'));
    }

    public function placeOrder(Request $request)
    {
        $order = new Order();
        $order->user_id = 1;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address_1 = $request->address_1;
        $order->address_2 = $request->address_2;
        $order->pincode = $request->pincode;
        $order->status = 1;
        $order->tracking_no = rand(1111, 9999);
        $order->save();


        $cartItems = Cart::where('user_id', 1)->get();
        foreach ($cartItems as $cart) {
            OrderItem::create([
                'order_id'      => $order->id,
                'product_id'    => $cart->product_id,
                'qty'           => $cart->product_qty,
                'price'         => $cart->total_price,
            ]);
        }
        $uCart = Cart::where('user_id', 1)->get();
        Cart::destroy($uCart);

        return redirect()->route('product.index');
    }
}
