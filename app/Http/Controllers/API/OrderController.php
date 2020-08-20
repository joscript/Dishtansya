<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Product;
use App\Order;

class OrderController extends Controller
{
    public function order(Request $request){
        $product = Product::findOrFail($request->product_id);

        if($request->quantity > $product->available_stock)
            return response()->json(['message' => "Failed to order this product due to unavailability of the stock"], 400);

        Order::create([
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);
        $product->available_stock = ($product->available_stock - $request->quantity);
        $product->save();

        return response()->json(['message' => "You have successfully ordered this product."], 201);
    }
}
