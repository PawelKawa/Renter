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
            'deleted' => $request->boolean('deleted'),
            ... $request->only(['by', 'order'])
        ];
        return inertia(
            'Realtor/Index', 
            [
                'filters' => $filters,
                'listings' => Auth::user()
            ->listings()
            ->filter($filters)
            ->paginate(6)
            ->withQueryString()
        ]);
    }
    public function edit(Listing $listing)
    {
        return inertia(
            'Realtor/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:1|max:6',
                'baths' => 'required|integer|min:1|max:6',
                'area' => 'required|integer|min:15|max:400',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1',
                'price' => 'required|integer|min:1|max:20000000'
            ])
        );
    
        return redirect()->route('realtor.listing.index')->with('success', 'Listing was updated!');
    }    

    public function create()
    {
        return inertia('Realtor/Create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // $listing = new Listing ();
        // $listing->beds = $request->beds;
        // $listing->save();

        //this will assign by_user_id to logged user in database.
        $request->user()->listings()->create(
            $request->validate([
                'beds' => 'required|integer|min:1|max:6',
                'baths' => 'required|integer|min:1|max:6',
                'area' => 'required|integer|min:15|max:400',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1',
                'price' => 'required|integer|min:1|max:20000000'
            ])
        );
        
        return redirect()->route('realtor.index')->with('success', 'Listing was created!');

    }
    
    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail();

        return redirect()->back()->with('success', 'Listing was deleted');
    }

    public function restore(Listing $listing){
        $listing->restore();
        
        return redirect()->back()->with('success', 'Listing was restored!');
    }
}
