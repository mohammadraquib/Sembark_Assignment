<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamMembersController extends Controller
{

    public function index()
    {
        $team_members = auth()->user()->users()->withCount('urls')->withSum('urls', 'hits')->latest()->paginate(10);
        return view('team_members', compact('team_members'));
    }

}
