<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Listing::orderByDesc('created_at');

        $filters = $request->only([
            'priceFrom', 'priceTo', 'minBeds', 'maxBeds', 'minBaths', 'maxBaths', 'areaFrom', 'areaTo'
        ]);

        if ($filters['priceFrom'] ?? false) {
            $query->where('price', '>=', $filters['priceFrom']);
        }

        if ($filters['priceTo'] ?? false) {
            $query->where('price', '<=', $filters['priceTo']);
        }

        if ($filters['minBeds'] ?? false) {
            $query->where('beds', '>=', $filters['minBeds']);
        }
        if ($filters['maxBeds'] ?? false) {
            $query->where('beds', '<=', $filters['maxBeds']);
        }

        if ($filters['minBaths'] ?? false) {
            $query->where('baths', '>=', $filters['minBaths']);
        }
        if ($filters['maxBaths'] ?? false) {
            $query->where('baths', '<=', $filters['maxBaths']);
        }

        if ($filters['areaFrom'] ?? false) {
            $query->where('area', '>=', $filters['areaFrom']);
        }

        if ($filters['areaTo'] ?? false) {
            $query->where('area', '<=', $filters['areaTo']);
        }

        return inertia(
            'Listing/Index',
            [
                'filters' => $filters,
                'listings' => $query
                ->paginate(10)
                ->withQueryString()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        
        return redirect()->route('listing.index')->with('success', 'Listing was created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        // if (Auth::user()->cannot('view', $listing)){
        //     abort(403);
        // };

        $this->authorize('view' ,$listing);
        return inertia(
            'Listing/Show',
            [
                'listing' => $listing
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        return inertia(
            'Listing/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    
        return redirect()->route('listing.index')->with('success', 'Listing was updated!');
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->back()->with('success', 'Listing was deleted');
    }
}