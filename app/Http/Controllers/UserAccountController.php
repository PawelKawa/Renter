<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    public function create ()
    {
        return inertia('UserAccount/Create');
    }

    public function store (Request $request)
    {
        $user = User::create($request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]));

        Auth::login($user);

        //password is hashed already
        
        return redirect()->route('listing.index')
        ->with('success', 'Account created');
    }
}
