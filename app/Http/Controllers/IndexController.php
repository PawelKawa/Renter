<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){
        return inertia('Index/index',
        [
            //go to web dev vue and index chech attribute it will be there this message
            'message' => "Hi from laravel, yo"
        ]);
    }
    
    
    public function test(){
        // dd(Auth::check());
        return inertia('Index/test');
    }
}
