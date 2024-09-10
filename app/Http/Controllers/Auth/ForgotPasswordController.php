<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Mail;
use Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
        $categories = Categories::all();
         return view('forgetPassword', ['categories' => $categories]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);

          $token = Str::random(64);

          DB::table('password_resets')->insert([
              'email' => $request->email,
              'token' => $token,
              'created_at' => Carbon::now()
            ]);

          Mail::send('emails.forgetPassword', ['token' => $token], function($message) use($request){
            $message->from('meetme@writersbar.ge');
            $message->to($request->email);
              $message->subject('Reset Password');
          });


          return back()->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) {
        $categories = Categories::all();

         return view('forgetPasswordLink', ['token' => $token, 'categories' => $categories]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);

          $updatePassword = DB::table('password_resets')
                              ->where([
                                'token' => $request->token
                              ])
                              ->first();
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }

          $user = User::where('email', $updatePassword->email)
                      ->update(['password' => Hash::make($request->password)]);

          DB::table('password_resets')->where(['email'=> $updatePassword->email])->delete();

          return redirect('/booking_login')->with('message', 'Your password has been changed!');
      }
}
