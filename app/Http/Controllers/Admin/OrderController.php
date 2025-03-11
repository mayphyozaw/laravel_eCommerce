<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function orderLists(Request $request)
    {
        $order = ProductOrder::with('user', 'product');
        if ($request->status) {
            $status = $request->status;
            $order->where('status', $status);
        }
        $order = $order->latest()->paginate(10);
        return view('admin.order.orderlist', compact('order'));
    }

    public function changeOrderStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $product_order = ProductOrder::where('id', $id);

        $product_order->update([
            'status' => $status,
        ]);

        Product::where('id', $product_order->first()->product_id)->update([
            'total_qty' => DB::raw('total_qty-1')
        ]);

        return redirect('admin/order')->with('success', 'Order Status Changed');
    }

    // public function changeOrderStatus(Request $request)
    // {
    //     $id = $request->id;
    //     $status = $request->status;

    //     $product_order = ProductOrder::where('id', $id);

    //     $product_order->update([
    //         'status' => $status,
    //     ]);

    //     Product::where('id', $product_order->first()->product->id)->update([
    //         'total_qty' => DB::raw('total_qty-1')
    //     ]);
    //     return redirect('/order')->with('success', 'Order Status changed');
    // }
}
