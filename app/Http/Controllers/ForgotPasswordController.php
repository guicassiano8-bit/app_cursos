<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function index(){
        return view('auth.forgot-password');
    }

    public function store(Request $request){
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::ResetLinkSent ? back()->with(['sent' => __($status)]) : back()->withErrors(['email' => __($status)]);
    }

    public function edit(string $token){
        return view('auth.reset-password', ['token' => $token]);
    }

    public function update(Request $request, string $id){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

         $status = Password::reset(
      $request->only('email', 'password', 'password_confirmation', 'token'),
      function (User $user, string $password) {
        $user->forceFill([
          'password' => Hash::make($password)
        ])->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));
      }
    );

    return $status === Password::PasswordReset
      ? redirect()->route('login.index')->with('forgot', __($status))
      : back()->withErrors(['error' => [__($status)]]);
    }
}
