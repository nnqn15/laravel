<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password|min:8'
        ], [
            'password.required' => 'Vui lòng nhập password',
            'password_confirmation.required' => 'Vui lòng nhập lại password',
            'password_confirmation.same' => 'Nhập lại mật khẩu không khớp'
        ]);
        $user = User::where('email', $request->email)->first();
        if($user->token===$request->token){
            $user->password=bcrypt($request->password);
            $user->save();
            return redirect()->route('user.login')->with('success', 'Đổi mật khẩu thành công, vui lòng đăng nhập lại!');
        } else {
            return back()->withErrors(['email' => 'Không thành công do token cũ hoặc không có']);
        }
    }
}
