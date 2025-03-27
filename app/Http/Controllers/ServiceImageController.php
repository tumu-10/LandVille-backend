<?php

namespace App\Http\Controllers;

use App\Models\ServiceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ServiceImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exclusiveServiceImages = ServiceImage::all();
        return view('service_imgs.index', compact('exclusiveServiceImages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('service_imgs.create');
    }

    /**
     * Store a newly created resource in storage.
     */

     public function getServiceImage()
     {
         $serviceImages = ServiceImage::latest()->first();
         return response()->json($serviceImages);
     }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // Max 10MB
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('service_image')) {
            $image = $request->file('service_image');
            $imagePath = $image->store('images/service', 'public'); // Store in storage/app/public/images/exclusive_service

            $serviceImage = new ServiceImage();
            $serviceImage->image = $imagePath;
            $serviceImage->save();

            return redirect()->route('service_imgs.index')->with('success', 'Exclusive service image added successfully!');
        }

        return back()->with('error', 'No image file uploaded.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExclusiveServiceImage $exclusiveServiceImage)
    {
        return view('service_imgs.show', compact('exclusiveServiceImage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceImage $serviceImage)
    {
        return view('service_imgs.edit', compact('serviceImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceImage $serviceImage)
    {
        $validator = Validator::make($request->all(), [
            'service_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Max 10MB
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('exclusive_image')) {
            // Delete the old image (optional)
            Storage::disk('public')->delete($serviceImage->image_path);

            $image = $request->file('exclusive_image');
            $imagePath = $image->store('images/service', 'public');
            $serviceImage->image = $imagePath;
        }

        $serviceImage->save();

        return redirect()->route('service_imgs.index')->with('success', 'Exclusive service image updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceImage $serviceImage)
    {
        // Delete the image file
        Storage::disk('public')->delete($serviceImage->image);

        $ServiceImage->delete();

        return redirect()->route('service_imgs.index')->with('success', 'Exclusive service image deleted successfully!');
    }
}
