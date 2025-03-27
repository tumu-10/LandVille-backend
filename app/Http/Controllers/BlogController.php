<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }


    public function getBlog()
    {
        $blogs = Blog::all();
        return response()->json($blogs);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'blog_title' => 'required|string',
            'blog_desc' => 'required|string',
            'blog_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Max 10MB
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $blog = new Blog();
        $blog->blog_title = $request->blog_title;
        $blog->blog_desc = $request->blog_desc;
        $blog->blog_author = $request->blog_author;
        $blog->date = $request->date;

        if ($request->hasFile('blog_img')) {
            $image = $request->file('blog_img');
            $imagePath = $image->store('images/blogs', 'public');
            $blog->blog_img = $imagePath;
        }

        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog post added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'blog_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Max 10MB
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $blog->title = $request->title;
        $blog->description = $request->description;

        if ($request->hasFile('blog_image')) {
            // Delete the old image (optional)
            Storage::disk('public')->delete($blog->image_path);

            $image = $request->file('blog_image');
            $imagePath = $image->store('images/blogs', 'public');
            $blog->image_path = $imagePath;
        }

        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        // Delete the image file
        if ($blog->image_path) {
            Storage::disk('public')->delete($blog->image_path);
        }

        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog post deleted successfully!');
    }
}
