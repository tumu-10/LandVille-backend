<?php

namespace App\Http\Controllers;

use App\Models\Collage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CollageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collages = Collage::all();
        return view('collages.index', compact('collages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('collages.create');
    }

    public function getCollage()
    {
        $collages = Collage::latest()->first(); // Fetch the latest video by `created_at` field
        if ($collages) {
            return response()->json($collages, 200); // Success response with the latest video
        } else {
            return response()->json(['message' => 'No image available'], 404); // Error response if no videos exist
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'collage_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // Max 10MB
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('collage_image')) {
            $image = $request->file('collage_image');
            $imagePath = $image->store('images/collages', 'public');

            $collage = new Collage();
            $collage->image = $imagePath;
            $collage->save();

            return redirect()->route('collages.index')->with('success', 'Collage image added successfully!');
        }

        return back()->with('error', 'No image file uploaded.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Collage $collage)
    {
        return view('collages.show', compact('collage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collage $collage)
    {
        return view('collages.edit', compact('collage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Collage $collage)
    {
        $validator = Validator::make($request->all(), [
            'collage_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Max 10MB
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('collage_image')) {
            // Delete the old image (optional)
            Storage::disk('public')->delete($collage->image_path);

            $image = $request->file('collage_image');
            $imagePath = $image->store('images/collages', 'public');
            $collage->image_path = $imagePath;
        }

        $collage->save();

        return redirect()->route('collages.index')->with('success', 'Collage image updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collage $collage)
    {
        // Delete the image file
        Storage::disk('public')->delete($collage->image);

        $collage->delete();

        return redirect()->route('collages.index')->with('success', 'Collage image deleted successfully!');
    }
}
