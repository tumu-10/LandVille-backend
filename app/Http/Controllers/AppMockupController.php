<?php

namespace App\Http\Controllers;

use App\Models\AppMockup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AppMockupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appMockups = AppMockup::all();
        return view('app_mockups.index', compact('appMockups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app_mockups.create');
    }

    /**
     * Store a newly created resource in storage.
     */

     public function getMockup()
    {
        $appMockups = AppMockup::all();
        return response()->json($appMockups);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'app_mockup' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // Max 10MB
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('app_mockup')) {
            $image = $request->file('app_mockup');
            $imagePath = $image->store('images/app_mockups', 'public'); // Store in storage/app/public/images/app_mockups

            $appMockup = new AppMockup();
            $appMockup->image_path = $imagePath;
            $appMockup->save();

            return redirect()->route('app_mockups.index')->with('success', 'App mockup added successfully!');
        }

        return back()->with('error', 'No image file uploaded.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AppMockup $appMockup)
    {
        return view('app_mockups.show', compact('appMockup'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AppMockup $appMockup)
    {
        return view('app_mockups.edit', compact('appMockup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AppMockup $appMockup)
    {
        $validator = Validator::make($request->all(), [
            'app_mockup' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Max 10MB
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('app_mockup')) {
            // Delete the old image (optional)
            Storage::disk('public')->delete($appMockup->image_path);

            $image = $request->file('app_mockup');
            $imagePath = $image->store('images/app_mockups', 'public');
            $appMockup->image_path = $imagePath;
        }

        $appMockup->save();

        return redirect()->route('app_mockups.index')->with('success', 'App mockup updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AppMockup $appMockup)
    {
        // Delete the image file
        Storage::disk('public')->delete($appMockup->image_path);

        $appMockup->delete();

        return redirect()->route('app_mockups.index')->with('success', 'App mockup deleted successfully!');
    }
}
