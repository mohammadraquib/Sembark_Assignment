<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Mail\Invitation;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InviteController extends Controller
{

    public function index()
    {
        return view('invite');
    }

    public function invite(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'role' => auth()->user()->isAdmin() ? 'required|in:admin,member' : ''
        ]);
        if(auth()->user()->isSuperAdmin()) {
            $role = UserRole::Admin;
        } else {
            $role = UserRole::tryFrom($request->input('role')) ?? UserRole::Member;
        }
        $password = Str::password(10);
        $user = auth()->user()->users()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $password,
            'role' => $role
        ]);
        Mail::to($user)->send(new Invitation($request->input('email'), $password));
        return back()->with('success', 'Invite has been successfully sent.');
    }

}
