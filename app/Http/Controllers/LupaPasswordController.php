<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use App\Models\Password_resets; 
use Mail; 
use Hash;
use Illuminate\Support\Str;

class LupaPasswordController extends Controller
{
    public function lihatLupaPasswordForm()
    {
        return view('auth.lupapassword');
    }

    public function storeLupaPasswordForm(Request $request)
    {
        $request->validate([
          'email' => 'required|email|exists:users',
        ]);
  
        $token = Str::random(50);
  
        $resetpassword = Password_resets::create([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);
  
        Mail::send('auth.verifikasiemail', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
  
        return back()->with('message', 'Kami telah mengirim email link reset password Anda!');
    }

    public function lihatResetPasswordForm($token) 
    {
        $email = Password_resets::where('token', $token)->first();
                            
        return view('auth.resetpassword', ['token' => $token], compact('email'));
    }

    public function storeResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'email|exists:users',
            'password' => 'min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|confirmed',
            'password_confirmation' => 'required'
        ]);
  
        $updatePassword = Password_resets::where('token', $request->token)->first();
  
        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }
  
        $user = User::where('email', $updatePassword->email)
                      ->update(['password' => Hash::make($request->password)]);
 
        $hapusemail = Password_resets::where('email', $updatePassword->email)->delete();
  
        return redirect('/')->with('message', 'Password Anda telah diubah!');
    }
}
