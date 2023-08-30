<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing;

class RealtorListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(Request $request){
        // dd(Auth::user()->listings);
        // dd($request->boolean('deleted'));
        $filters = [
            'deleted' => $request->boolean('deleted')
        ];
        return inertia(
            'Realtor/Index', 
            ['listings' => Auth::user()
            ->listings()
            ->mostRecent()
            ->filter($filters)
            ->get()]);
    }
    
    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail();

        return redirect()->back()->with('success', 'Listing was deleted');
    }
}
