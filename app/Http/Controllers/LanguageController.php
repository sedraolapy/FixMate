<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        $request->validate([
            'lang' => 'required|in:en,ar',
        ]);

        session(['locale' => $request->lang]);

        return redirect()->back();
    }
}
