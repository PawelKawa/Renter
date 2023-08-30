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
        
        $filters = $request->only([
            'priceFrom', 'priceTo', 'minBeds', 'maxBeds', 'minBaths', 'maxBaths', 'areaFrom', 'areaTo'
        ]);
        
        $query = Listing::orderByDesc('created_at');

        // if ($filters['areaFrom'] ?? false) {
        //     $query->where('area', '>=', $filters['areaFrom']);
        // }
        // if ($filters['areaTo'] ?? false) {
        //     $query->where('area', '<=', $filters['areaTo']);
        // }

        return inertia(
            'Listing/Index',
            [
                'filters' => $filters,
                'listings' => Listing::orderByDesc('created_at')
                ->when(
                    ($filters['priceFrom'] ?? false),
                    //when will not run if it is null, because null will be changed to false therefore not run this when.
                    fn ($query, $value) => $query->where('price', '>=', $value)
                )->when(
                    ($filters['priceTo'] ?? false),
                    fn ($query, $value) => $query->where('price', '<=', $value)
                )->when(
                    ($filters['minBeds'] ?? false),
                    fn ($query, $value) => $query->where('beds', '>=', $value)
                )->when(
                    ($filters['maxBeds'] ?? false),
                    fn ($query, $value) => $query->where('beds', '<=', $value)
                )->when(
                    ($filters['minBaths'] ?? false),
                    fn ($query, $value) => $query->where('baths', '>=', $value)
                )->when(
                    ($filters['maxBaths'] ?? false),
                    fn ($query, $value) => $query->where('baths', '<=', $value)
                )->when(
                    ($filters['areaFrom'] ?? false),
                    fn ($query, $value) => $query->where('area', '>=', $value)
                )->when(
                    ($filters['areaTo'] ?? false),
                    fn ($query, $value) => $query->where('area', '<=', $value)
                )
                ->paginate(12)
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

    }
}