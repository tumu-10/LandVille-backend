<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.create');
    }

    public function getService()
    {
        $service = Service::all();
        return response()->json($service);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'services_title' => 'required|string',
            'services_desc' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $service = new Service();
        $service->services_title = $request->services_title;
        $service->services_desc = $request->services_desc;
        $service->sub_services = $request->sub_services;

        if ($request->hasFile('services_img')) {
            $imageFile = $request->file('services_img');
            $imageExt = $imageFile->getClientOriginalExtension();
            $imageName = time().'_'.$imageExt;
            $imagePath = $imageFile->storeAs('images/cover_pic', $imageName, 'public');
            $service->services_img = $imagePath;
        }

        if ($request->hasFile('video')) {
            // Store the uploaded file
            $video = $request->file('video');
            $videoPath = $video->store('videos', 'public');

            // Optionally, you can manually save the file using Storage::put (already done here)
            $contents = file_get_contents($video->getRealPath());
            Storage::put('videos/' . $video->getClientOriginalName(), $contents, 'public');

            // Save the video path in the database
            $service->services_video = $videoPath;

        }

        $service->save();

        return redirect()->route('services.index')->with('success', 'Service added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validator = Validator::make($request->all(), [
            'services_title' => 'required|string',
            'services_desc' => 'required|string',
            'service_media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,avi,mov|max:20480', // Max 20MB
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $service->services_title = $request->services_title;
        $service->services_desc = $request->services_desc;
        $service->sub_services = $request->sub_services;

        if ($request->hasFile('service_media')) {
            // Delete old media (if any)
            if ($service->media_path) {
                Storage::disk('public')->delete($service->media_path);
            }

            $media = $request->file('service_media');
            $mediaType = $media->getMimeType();

            if (strpos($mediaType, 'image') !== false) {
                $mediaPath = $media->store('images/services', 'public');
                $service->media_type = 'image';
            } elseif (strpos($mediaType, 'video') !== false) {
                $mediaPath = $media->store('videos/services', 'public');
                $service->media_type = 'video';
            } else {
                return back()->with('error', 'Invalid media type.');
            }

            $service->media_path = $mediaPath;
        }

        $service->save();

        return redirect()->route('services.index')->with('success', 'Service updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        // Delete the media file (if any)
        if ($service->media_path) {
            Storage::disk('public')->delete($service->media_path);
        }

        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully!');
    }
}
