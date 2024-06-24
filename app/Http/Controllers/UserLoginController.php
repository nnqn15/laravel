<?php

// UserLoginController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Order;

class UserLoginController extends Controller
{
    function index()
    {
        $orders=Order::Where('user_id', '=', Auth::user()->id)->get();
        return view('auth.admin', ['orders' => $orders]);
    }
    function login(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'password.required' => 'Vui lòng nhập password'
        ]);
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            if (Auth()->user()->role === 2) {
                return redirect('admin/dashboard');
            } else {
                return redirect('user/dashboard');
            }
        } else return redirect()->back()->witherrors('Sai email hoặc password');
    }
    function register(Request $req)
    {
        $req->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'repeatPassword' => 'required|same:password|min:8'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'email.unique' => 'Email đã được đăng kí',
            'password.required' => 'Vui lòng nhập password',
            'repeatPassword.required' => 'Vui lòng nhập lại password',
            'repeatPassword.same' => 'Nhập lại mật khẩu không khớp'
        ]);
        $user = User::Create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password),
        ]);
        Auth::login($user);
        return redirect('user/dashboard');
    }
    function update(Request $req)
    {
        $req->validate([
            'password' => 'required|min:8',
            'passwordNew' => 'required|min:8',
            'repeatPasswordNew' => 'required|same:passwordNew|min:8'
        ], [
            'password.required' => 'Vui lòng nhập password hiện tại',
            'passwordNew.required' => 'Vui lòng nhập password mới',
            'repeatPasswordNew.required' => 'Vui lòng nhập lại password mới',
            'repeatPasswordNew.same' => 'Nhập lại mật khẩu mới không khớp'
        ]);
        $user = Auth::user();

        if (!Hash::check($req->password, $user->password)) {
            return back()->withErrors(['password' => 'Mật khẩu hiện tại không đúng']);
        }
        $user->update(['password' => Hash::make($req->passwordNew)]);

        return redirect('user/dashboard')->with('success', 'Mật khẩu đã được thay đổi thành công');
    }
    function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('user/login');
    }
}
