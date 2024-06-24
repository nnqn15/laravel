<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\GuiEmail;
use Illuminate\Support\Str;
use App\Models\User;

// Phần trên cùng của lớp
use Illuminate\Support\Facades\URL;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại.']);
        }

        $token = (string) Str::uuid() . Str::random(20);
        $user->update(['token'=>$token]);
        $url = URL::temporarySignedRoute(
            'user.reset',
            now()->addMinutes(60),
            ['token' => $token, 'email' => $user->email]
        );

        Mail::to($user->email)->send(new GuiEmail($url));

        return back()->with('success', 'Vui lòng check email để nhận link đổi mật khẩu!');
    }

}

