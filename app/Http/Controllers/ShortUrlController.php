<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShortUrlController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $data = ['user' => $user];
        if($user->isSuperAdmin()) {
            $data['short_urls'] = ShortUrl::with('user')->latest()->paginate(10);
        } else if($user->isAdmin()) {
            $team_members = $user->users()->pluck('id')->push($user->id);
            $data['short_urls'] = ShortUrl::whereIn('user_id', $team_members)->with('user')->latest()->paginate(10);
        } else {
            $data['short_urls'] = $user->urls()->with('user')->latest()->paginate(10);
        }
        return view('shorturls', $data);
    }

    public function show(ShortUrl $shorturl)
    {
        $shorturl->increment('hits');
        return redirect($shorturl->url);
    }

}
