<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;


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
    //Shoze create form
    public function create() {
        return view('listings.create');
}
    //Store listing data
    public function store(Request $request) {
        //dd($request->all());

        $formFields = $request->validate([
            'company' => ['required', Rule::unique('listings','company')],
            'title' => ['required', 'min:3'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => ['required', 'min:10']
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }
}   

