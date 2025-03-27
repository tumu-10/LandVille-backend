<?php

namespace App\Http\Controllers;

use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PropertyImgController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all property images
        $propertyImages = PropertyImage::all();

        // Return the view with the list of property images
        return view('property_images.index', compact('propertyImages'));
    }
    /**
     * Show the form for creating a new resource.
     */

     public function getImage()
     {
         $propertyImages = PropertyImage::latest()->first();
         return response()->json($propertyImages);
     }

    public function create()
    {
        return view('property_images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'property_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // Max 10MB
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('property_image')) {
            $image = $request->file('property_image');
            $imagePath = $image->store('images/property', 'public'); // Store in storage/app/public/images/property

            $propertyImage = new PropertyImage();
            $propertyImage->img = $imagePath;
            $propertyImage->save();


            // Return the view with the updated list of main titles
            return redirect()->route('property_images.index')->with('success', 'Property image added successfully!');
        }

        return back()->with('error', 'No image file uploaded.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyImage $propertyImage)
    {
        return view('property_images.show', compact('propertyImage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyImage $propertyImage)
    {
        return view('property_images.edit', compact('propertyImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PropertyImage $propertyImage)
    {
        $validator = Validator::make($request->all(), [
            'property_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Max 10MB
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('property_image')) {
            // Delete the old image (optional)
            Storage::disk('public')->delete($propertyImage->img);

            $image = $request->file('property_image');
            $imagePath = $image->store('images/property', 'public');
            $propertyImage->img = $imagePath;
        }

        $propertyImage->save();

        return redirect()->route('property_images.index')->with('success', 'Property image updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyImage $propertyImage)
    {
        // Delete the image file
        Storage::disk('public')->delete($propertyImage->img);

        $propertyImage->delete();

        return redirect()->route('property_images.index')->with('success', 'Property image deleted successfully!');
    }
}
