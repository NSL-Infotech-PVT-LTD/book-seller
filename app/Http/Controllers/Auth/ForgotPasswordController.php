<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use DB;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    public function showResetPasswordForm($token) { 
        $email = PasswordReset::where('token', $token)->value('email');
        return view('auth.forgetPasswordLink', ['token' => $token,'email'=>$email]);
    }
    public function successResetPassword() { 
        return view('auth.afterReset');
     }
 

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = PasswordReset::where([
                            'email' => $request->email, 
                            'token' => $request->token
                            ])
                            ->first();

        if(!$updatePassword){
            return redirect(route('reset.password.get', $request->token))->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

    PasswordReset::where(['email'=> $request->email])->delete();

        return redirect(route('reset.successResetPassword.get'))->with('message', 'Your password has been changed!');
    }
}
