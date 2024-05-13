<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductColorSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        $carts = Cart::where('user_id',1)->get();

        return view('product.list', compact('products','carts'));
    }

    public function cartView(Request $request){
        $product = Product::where('id',$request->id)->first();
        return response()->json(['success'=> true, 'product'=> $product]);
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // Validate the incoming request
        $request->validate([
            'product_name' => 'required',
            'product_sku' => 'required',
            'color.*' => 'required',
            'size.*' => 'required',
            'price.*' => 'required',
            'tax' => 'required',
            'product_image' => 'required',
        ]);

        DB::beginTransaction();
        try {
            if ($request->hasFile('product_image')) {
                $file       = $request->file('product_image');
                $extenstion = $file->getClientOriginalExtension();
                $filename   = Str::random(8) . time() . '.' . $extenstion;
                $file->move('uploads/product/', $filename);
            }

            $product = new Product();
            $product->product_name          = $request->product_name;
            $product->product_sku           = $request->product_sku;
            $product->product_unit          = $request->product_unit;
            $product->product_unit_value    = $request->product_unit_value;
            $product->selling_price         = $request->selling_price;
            $product->purchase_price        = $request->purchase_price;
            $product->discount              = $request->discount;
            $product->tax                   = $request->tax;
            $product->product_image         = $filename;
            $product->save();

            // Store color, size, and price sets
            foreach ($request->color as $index => $color) {
                $colorSize = new ProductColorSize();
                $colorSize->product_id = $product->id;
                $colorSize->color = $color;
                $colorSize->size = $request->size[$index];
                $colorSize->price = $request->price[$index];
                $colorSize->save();
            }

            DB::commit();
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            // Log::error('Transaction failed: ' . $th->getMessage());
            return back()->with('upload filded');
        }
    }

    public function searchProduct()
    {
        $products = Product::select('product_name', 'product_sku')->get();
        $searchData = [];
        foreach ($products as $data) {
            $searchData[] = $data['product_name'];
        }
        return $searchData;
    }

    public function searchProductShow(Request $request){
        $products = Product::where('product_name', 'LIKE', '%'.$request->name.'%')
        ->orWhere('product_sku', 'LIKE', '%'.$request->name.'%')->paginate(10);
        return view('product.list', compact('products'));
    }
}
