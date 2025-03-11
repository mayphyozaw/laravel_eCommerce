<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductOrder;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class CartApiController extends Controller
{
    public function addToCart(Request $request)
    {

        $product = Product::where('slug', $request->product_slug)->first();
        if (!$product) {
            return response()->json([
                'message' => false,
                'data' => "data_not found",
            ]);
        }

        $findInCart = ProductCart::where('user_id', $request->user_id)
            ->where('product_id', $product->id)
            ->first();

        if ($findInCart) {
            $total_qty = $findInCart->total_qty + 1;
            $findInCart->update([
                'total_qty' => $total_qty,
            ]);
        } else {
            ProductCart::create([
                'product_id' => $product->id,
                'user_id' => $request->user_id,
                'total_qty' => 1,
            ]);
        }
        $cartCount = ProductCart::where('user_id', $request->user_id)->count();

        return response()->json([
            'message' => true,
            'data' => $cartCount,
        ]);
    }


    public function getCart(Request $request)
    {
        $user_id = $request->user_id;
        $cart = ProductCart::where('user_id', $user_id)
            ->with('product')
            ->get();
        return response()->json([
            'message' => true,
            'data' => $cart,
        ]);
    }

    public function updateQty(Request $request)
    {
        $cart_id = $request->cart_id;
        $qty = $request->total_qty;

        ProductCart::where('id', $cart_id)->update([
            'total_qty' => $qty,

        ]);
        return response()->json([
            'message' => true,
            'data' => null,
        ]);
    }


    public function removeQty(Request $request)
    {
        $cart_id = $request->cart_id;


        ProductCart::where('id', $cart_id)->delete();
        return response()->json([
            'message' => true,
            'data' => null,
        ]);
    }


    public function checkout(Request $request)
    {
        $user_id = $request->user_id;
        $carts = ProductCart::where('user_id', $user_id)->get();

        foreach ($carts as $cart) {
            ProductOrder::create([
                'user_id' => $cart->user_id,
                'product_id' => $cart->product_id,
                'total_qty' => $cart->total_qty,
            ]);
        }

        ProductCart::where('user_id', $user_id)->delete();
        return response()->json([
            'message' => true,
            'data' => null,
        ]);
    }

    public function order(Request $request)
    {
        $user_id = $request->user_id;
        $order = ProductOrder::where('user_id', $user_id)
            ->with('product')
            ->paginate(3);
        return response()->json([
            'message' => true,
            'data' => $order,
        ]);
    }
}
