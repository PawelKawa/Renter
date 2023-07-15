<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //login form
    public function create(){
        return inertia('Auth/Login');
    }

    //creating session of user
    public function store(){
    
    }

    //logout
    public function destroy(){

    }
}
