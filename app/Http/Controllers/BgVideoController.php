<?php

namespace App\Http\Controllers;

use App\Models\BgVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BgVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bgVideos = BgVideo::all();
        return view('bg_videos.index', compact('bgVideos'));
    }

    public function getVideo()
    {
        $bgVideo = BgVideo::latest()->first(); // Fetch the latest video by `created_at` field
        if ($bgVideo) {
            return response()->json($bgVideo, 200); // Success response with the latest video
        } else {
            return response()->json(['message' => 'No videos available'], 404); // Error response if no videos exist
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bg_videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate that the 'video' field is uploaded and has the right format
        $validator = Validator::make($request->all(), [
            'video' => 'required|file|mimes:mp4,avi,mov|max:153600', // Max 150MB (150 * 1024)
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Check if a video file is uploaded
        if ($request->hasFile('video')) {
            // Store the uploaded file
            $video = $request->file('video');
            $videoPath = $video->store('videos', 'public');

            // Optionally, you can manually save the file using Storage::put (already done here)
            $contents = file_get_contents($video->getRealPath());
            Storage::put('videos/' . $video->getClientOriginalName(), $contents, 'public');

            // Save the video path in the database
            $bgVideo = new BgVideo();
            $bgVideo->video_path = $videoPath;
            $bgVideo->save();

            // Retrieve all main titles
            $bgVideos = BgVideo::all();


            return view('bg_videos.index', compact('bgVideos'))->with('success', 'Background video added successfully!');
        }

        return view()->with('error', 'No video file uploaded.');
    }

    /**
     * Display the specified resource.
     * Show the form for editing the specified resource.
     */
    public function edit(BgVideo $bgVideo)
    {
        return view('bg_videos.edit', compact('bgVideos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BgVideo $bgVideo)
    {
        $validator = Validator::make($request->all(), [
            'video_path' => 'nullable|file|mimes:mp4,avi,mov|max:153600', // Max 150MB (150 * 1024)
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('video_path')) {
            // Delete the old video (optional)
            Storage::disk('public')->delete($bgVideo->video_path);

            $video = $request->file('video_path');
            $videoPath = $video->store('videos', 'public');
            $bgVideo->video_path = $videoPath;
        }

        $bgVideo->save();

        return redirect()->route('bg_videos.index')->with('success', 'Background video updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BgVideo $bgVideo)
    {
        // Delete the video file
        Storage::disk('public')->delete($bgVideo->video_path);

        $bgVideo->delete();

        return redirect()->route('bg_videos.index')->with('success', 'Background video deleted successfully!');
    }
}
