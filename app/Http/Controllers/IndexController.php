<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){
        // I can see all my queries on index.vue with code below
        // dd(Listing::all());
        // dd(Auth::user());
        return inertia('Index/index',
    [
        //go to web dev vue and index chech attribute it will be there this message
        'message' => "Hi from laravel, yo"
    ]);
    }


    public function second(){
        return inertia('Index/second');
    }
}
