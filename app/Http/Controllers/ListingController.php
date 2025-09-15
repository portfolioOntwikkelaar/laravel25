<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // Laat alle listings zien
    public function index()
    {
        
        return view('listings.index', [
            'listings' => Listing::all()
        ]);
    }

    // Laat één specifieke listing zien
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }
}


