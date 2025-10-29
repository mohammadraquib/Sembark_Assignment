<?php

namespace App\Http\Controllers;

use App\Helpers\DateRange;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        $data = ['user' => $user];
        $dateRange = DateRange::getDates($request->input('range'));
        if($user->isSuperAdmin()) {
            $data['clients'] = $user->users()->withCount(['users', 'urls'])->withSum('urls', 'hits')->limit(5)->get();
            $data['total_clients'] = $user->users()->count();
            $data['short_urls'] = ShortUrl::latest()->whereDate('created_at', '>=', $dateRange['start'])->whereDate('created_at', '<=', $dateRange['end'])->limit(5)->get();
            $data['total_short_urls'] = ShortUrl::count();
        } else if($user->isAdmin()) {
            $team_members = $user->users()->pluck('id')->push($user->id);
            $data['short_urls'] = ShortUrl::whereIn('user_id', $team_members)->latest()->whereDate('created_at', '>=', $dateRange['start'])->whereDate('created_at', '<=', $dateRange['end'])->limit(5)->get();
            $data['total_short_urls'] = ShortUrl::whereIn('user_id', $team_members)->count();
            $data['team_members'] = $user->users()->withCount('urls')->withSum('urls', 'hits')->limit(5)->get();
            $data['total_team_members'] = $user->users()->count();
        } else {
            $data['short_urls'] = $user->urls()->latest()->whereDate('created_at', '>=', $dateRange['start'])->whereDate('created_at', '<=', $dateRange['end'])->limit(5)->get();
            $data['total_short_urls'] = $user->urls()->count();
        }
        return view('dashboard', $data);
    }

}
