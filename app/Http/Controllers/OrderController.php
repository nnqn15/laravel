<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;

class OrderController extends Controller
{
    function orders()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.order', ['orders' => $orders]);
    }
    function editorder(Request $request, $id)
    {
        $order = Order::findorfail($id)?? [];
        //truyền dữ liệu sang view
        return view('admin.editorder', compact('order'));
    }
    function updateorder(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->ship = $request->input('ship');
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Sửa đơn hàng thành công');
    }
}
