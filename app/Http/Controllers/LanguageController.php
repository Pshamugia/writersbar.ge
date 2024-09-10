<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function setLanguage(Request $request)
    {
        $language = $request->input('language');

        // Store the selected language preference in the session
        session(['language' => $language]);

        // Redirect back to the previous page or any desired route
        return redirect()->back();
    }
}
