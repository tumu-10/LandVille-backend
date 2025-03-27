<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonies = Test::all();
        return view('testimonies.index', compact('testimonies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('testimonies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author' => 'required|string',
            'content' => 'required|string',
            'testimony_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Max 10MB, optional
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $testimony = new Test();
        $testimony->author = $request->author;
        $testimony->content = $request->content;

        if ($request->hasFile('testimony_image')) {
            $image = $request->file('testimony_image');
            $imagePath = $image->store('images/testimonies', 'public');
            $testimony->image_path = $imagePath;
        }

        $testimony->save();

        return redirect()->route('testimonies.index')->with('success', 'Testimony added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $testimony)
    {
        return view('testimonies.show', compact('testimony'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $testimony)
    {
        return view('testimonies.edit', compact('testimony'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $testimony)
    {
        $validator = Validator::make($request->all(), [
            'author' => 'required|string',
            'content' => 'required|string',
            'testimony_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Max 10MB, optional
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $testimony->author = $request->author;
        $testimony->content = $request->content;

        if ($request->hasFile('testimony_image')) {
            // Delete the old image (optional)
            Storage::disk('public')->delete($testimony->image_path);

            $image = $request->file('testimony_image');
            $imagePath = $image->store('images/testimonies', 'public');
            $testimony->image_path = $imagePath;
        }

        $testimony->save();

        return redirect()->route('testimonies.index')->with('success', 'Testimony updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $testimony)
    {
        // Delete the image file
        if ($testimony->image_path) {
            Storage::disk('public')->delete($testimony->image_path);
        }

        $testimony->delete();

        return redirect()->route('testimonies.index')->with('success', 'Testimony deleted successfully!');
    }
}
