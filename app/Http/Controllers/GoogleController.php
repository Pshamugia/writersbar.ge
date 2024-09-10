<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the Google callback.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
            } else {
                try {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id' => $user->id,
                        'password' => encrypt('123456dummy'),
                        'type' => 1,
                        'profile_photo' => $user->avatar // Save the profile photo URL

                    ]);
                    Auth::login($newUser);
                } catch (\Illuminate\Database\QueryException $e) {
                    if ($e->errorInfo[1] == 1062) {
                        // Duplicate entry error
                        session()->flash('error', 'This email is already in use.');
                    } else {
                        // Other database error
                        session()->flash('error', 'An error occurred while creating the user.');
                    }

                    return redirect()->route('booking.login');

                }
            }

            // Redirect to the booking_room route
            return redirect()->route('booking.room');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
