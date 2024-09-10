<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminLoginController extends Controller
{
    public function login()
    {
        return view('admin/login');
    }

    public function auth(Request $request)
    {
        $user = $request->user;
        $passwords = $request->passwords;

        $dbUser = DB::table('kultura_password')->where('user', $user)->where('passwords', $passwords)->first();

        if ($dbUser) {
            session()->put('is_admin', $dbUser->id);
            session()->put('sessia', $dbUser->id);
            session()->put('user', $dbUser);
            session()->put('delete_status', $dbUser->delete_status);
            session()->put('hide_admins', $dbUser->hide_admins);

            return redirect()->route('admin.index');
        } else {
            return redirect()->route('admin.login');
        }
    }

    public function logout()
    {
        session()->put('is_admin', '');
        session()->put('sessia', '');
        session()->put('user', '');
        session()->put('delete_status', '');
        session()->put('hide_admins', '');

        return redirect()->route('admin.login');
    }
}
