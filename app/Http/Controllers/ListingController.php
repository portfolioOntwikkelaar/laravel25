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
        //return view('listings.index', [
        //    'listings' => Listing::all()
        //]);
        return view('listings.index', [
        //    'listings' => Listing::all()
        //]);
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
    //Show edit form
    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
}   


    //Update listing data
    public function update(Request $request, Listing $listing) {
        // Make sure logged in user is owner
        //if($listing->user_id != auth()->id()) {
        //    abort(403, 'Unauthorized Action');
        //}
        $formFields = $request->validate([
            'company' => ['required'],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
        $listing->update($formFields);
        return back()->with('message', 'Listing updated successfully!');
    }
} 