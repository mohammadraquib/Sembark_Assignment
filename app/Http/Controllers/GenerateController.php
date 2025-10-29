<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GenerateController extends Controller
{

    public function index()
    {
        return view('generate');
    }

    public function create(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);
        $user = Auth::user();
        $short_url = $user->urls()->create([
            'shortcode' => Str::random(6),
            'url' => $request->input('url'),
            'hits' => 0
        ]);
        return back()->with('short_url', route('shorturl', ['shorturl' => $short_url]));
    }

}
