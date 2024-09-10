<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $avatarUrl = $user->profile_photo; // Assuming the avatar URL is stored in the 'profile_photo' column

        return view('profile.show', compact('user', 'avatarUrl'));
    }
}

