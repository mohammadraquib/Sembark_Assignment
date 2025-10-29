<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientsController extends Controller
{

    public function index()
    {
        $clients = auth()->user()->users()->withCount(['users', 'urls'])->latest()->paginate(10);
        return view('clients', compact('clients'));
    }

}
