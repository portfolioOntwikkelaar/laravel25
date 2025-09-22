<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
// ✅ Alle listings tonen
Route::get('/listings', [ListingController::class, 'index']);
// ✅ Home route (je kan dit eventueel ook via controller doen later)
Route::get('/', function () {
    return view('listings.index', [
        'heading' => 'Latest Listings',
        'listings' => \App\Models\Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
    ]);
});
Route::get('/listings/create', [ListingController::class, 'create']);
// ✅ store listing data
Route::post('/listings', [ListingController::class, 'store']);
// Show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);
// Update listing data
Route::put('/listings/{listing}', [ListingController::class, 'update']);
// ✅ Eén specifieke listing tonen
Route::get('/listings/{listing}', [ListingController::class, 'show']);
