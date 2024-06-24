<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;

class UsersController extends Controller
{
    function index(){
        //lấy dữ liệu từ model

        //truyền dữ liệu sang view
        return view('user.dashboard');
    }
    function login(){
        //lấy dữ liệu từ model

        //truyền dữ liệu sang view
        return view('user.login');
    }
    function register(){
        //lấy dữ liệu từ model

        //truyền dữ liệu sang view
        return view('user.register');
    }
    function wishlist(){
        //lấy dữ liệu từ model
        $products=Product::select('id','title','image','image1','price','sale','description')->limit(9)->get();
        //truyền dữ liệu sang view
        return view('user.wishlist',['products'=>$products]);
    }
    function users()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('admin.user', ['users' => $users]);
    }
    function edituser(Request $request, $id)
    {
        $user = User::findorfail($id);
        //truyền dữ liệu sang view
        return view('admin.edituser', compact('user'));
    }
    function updateuser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
        ], [
            'name.required' => 'Tên người dùng là bắt buộc.',
            'name.max' => 'Tên không được vượt quá :max ký tự.',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->status = $request->input('status');
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Sửa tài khoản thành công');
    }
    function destroy($id)
    {
        $user = User::findorfail($id);
        // Kiểm tra xem sản phẩm có trong order details hay không
        $orders = Order::where('user_id', $id)->get();

        if ($orders->isNotEmpty()) {
            // Cập nhật user_id của các đơn hàng thành null
            foreach ($orders as $order) {
                $order->user_id = null;
                $order->save();
            }
        }
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Xoá tài khoản thành công');
    }
    
    function orderdetail($id){
        $orderDetails = OrderDetail::where('order_id', $id)->get();
        return view('product.orderdetail', compact('orderDetails','id'));
    }
}
