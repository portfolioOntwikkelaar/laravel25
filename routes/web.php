<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

// ✅ Alle listings tonen
Route::get('/listings', [ListingController::class, 'index']);

// ✅ Eén specifieke listing tonen
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// ✅ Home route (je kan dit eventueel ook via controller doen later)
Route::get('/', function () {
    
    return view('listings.index', [
        'heading' => 'Latest Listings',
        'listings' => \App\Models\Listing::latest()->filter(request(['tag']))->get()
    ]);
});

// Route::get('/listings/{id}', function ($id) {
//     $listing = Listing::find($id);

//     if($listing) {
//     return view('listings', [
        
//         'listing' => $listing
//     ]);
//     } else {
//         abort('404');
//     }
// });
