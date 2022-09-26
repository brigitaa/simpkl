<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
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
  
        DB::table('password_resets')->insert([
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
        return view('auth.resetpassword', ['token' => $token]);
    }

    public function storeResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|confirmed',
            'password_confirmation' => 'required'
        ]);
  
        $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }
  
        $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
        DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
        return redirect('/')->with('message', 'Password Anda telah diubah!');
    }
}
