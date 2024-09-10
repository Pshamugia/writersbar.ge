<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Categories;
use App\Models\BookingMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);
                Auth::login($newUser);
            }

            // Redirect to the booking_room route
            return redirect()->route('booking.room');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function login()
    {
        return view('admin.login');
    }
    public function create(Request $request)
    {
        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]
        );

        //auth()->login($user); //ეს არის ავტორიზაციის

        return redirect()->route('admin.index');
    }


    public function admin_user()
    {

        $user = USER::select([
            'id',
            'name',
            'email',
            'password'
        ])->get();

        return view('/admin/user/log', ['user' => $user]);
    }

    public function edit_user($id)
    {

        if ((Auth::user() && ((int) (Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }

        $edit = USER::where('id', $id)->first();

        return view('/admin/user/edit', ['edit' => $edit]);
    }

    public function update_user(Request $request, $id)
    {

        $update = USER::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.user', ['update' => $update]);
    }



    public function user_view(Request $request)
    {
        $data = User::first();

        return view('admin/user/user_view', ['data' => $data]);
    }




    public function user_register(Request $request)
    {
        User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                (bool) $request->remember
            ]
        );

        return redirect()->route('admin.user');
    }



    public function user_delete($id)
    {

        User::where('id', $id)
            ->delete();

        return redirect()->route('admin.user');
    }



    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }

    public function auth(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'type' => 0
        ];

        if (Auth::attempt($credentials, (bool) $request->remember)) {
            return redirect()->route('admin.article');
        } else {
            return redirect()->route('admin.login')->with('error', 'Invalid credentials. Please check your email and password.');
        }
    }



    public function booking_login(Request $request)
    {
        if (auth()->user() && auth()->user()->type === 1) {
            return redirect()->route('welcome');
        }
        if (Auth::check() && Auth::user()->google_id !== null) {
            return redirect()->route('booking.room');
        }
        if (Auth::check() && Auth::user()->type === 0) {
            return redirect()->route('booking.login');
        }

        $data = User::first();
        $categories = Categories::all();

        return view('booking_login', ['categories' => $categories, 'data' => $data]);
    }

    public function booking_register()
    {
        if (auth()->user() && auth()->user()->type === 1) {
            return redirect()->route('welcome');
        }
        $categories = Categories::all();

        return view('booking_register', ['categories' => $categories]);
    }


    public function booking_room()
    {


        $categories = Categories::all();

        return view('booking_room', ['categories' => $categories]);
    }

    public function booking_auth(Request $request)
    {
        if (Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password,
                'type' => 1
            ],
            (bool) $request->remember
        ) || (Auth::user() && Auth::user()->google_id !== null)) {
            return redirect()->route('booking.room');
        }

        else

            echo "<script>";
        echo "alert('Something went wrong. Please, try again');";
        echo "window.location.href='booking_login';";
        echo "</script>";
    }


    public function booking_create(Request $request)
    {
        $request->validate(
            ['email' => 'required|unique:users|max:255'],
            [
                'email.required' => 'This must filled',
                'email.unique' => 'This email is already registered'
            ]
        );
        User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => 1
            ]
        );

return redirect()->route('booking.login')->with('message', 'User created successfully!');
    }


    public function booking_logout()
    {
        Auth::logout();

        return redirect()->route('welcome');
    }


    public function booking_send(Request $request)
    {
        $data = [
            'name' => $request->name,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'news_date' => $request->news_date,
            'hour' => $request->hour,
            'messageText' => $request->message,
            'email' => $request->email
        ];

        $date = Carbon::parse($request->news_date . ' ' . $request->hour);

        if (DB::table('booking')->where('news_date', $date)->count()) {
            return redirect()->route('booking.room', ['result' => 2]);
        }

        DB::table('booking')->insert([
            'news_date' => $date
        ]);

        Mail::to('meetme@writersbar.ge')->send(new BookingMail($data));
        return redirect()->route('booking.room', ['result' => 1]);
    }
}
