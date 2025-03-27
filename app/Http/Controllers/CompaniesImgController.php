<?php

namespace App\Http\Controllers;

use App\Models\Service_img;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\Validator;

class CompaniesImgController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     // session(['title' => 'Collage']);
        $service_img = Service_img::get();
        return view('service_img.index', compact('service_img'));

    }

    public function getServiceImage ()
    {
        $service_img = Service_img::latest()->first(); ;
        return response()->json($service_img);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //session(['title' => 'Create service_img']);

        $service_img = new Service_img();

        return view('service_img.create', compact('service_img'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
            $imagePath = $image->store('images/service', 'public'); // Store in storage/app/public/images/service

            $service_img = new Service_img();
            $service_img->image = $imagePath;
            $service_img->save();


            // Return the view with the updated list of main titles
            return redirect()->route('service_img.index')->with('success', 'service image added successfully!');
        }

        return back()->with('error', 'No image file uploaded.');
    }

    /**
     * Display the specified resource.
     */
    public function show(service_img $service_img)
    {
        $service_img = Service_img::find($category_id);

        return view('service_img.show', compact('service_img'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(service_img $service_img)
    {
        //session(['title' => 'Edit AppMockup']);

        $service_img = Service_img::find($id);

        return view('service_img.create', compact('service_img'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, service_img $service_img)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $service_img = Service_img::find($id);


        if ($image = $request->file('img')) {
            $destinationPath = 'img';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $service_img['img'] = "$profileImage";
        }

        $service_img->save();

        return redirect()->route('service_img.index')
            ->with('success', 'service_img Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(service_img $service_img)
    {
        $service_img->delete();
        return redirect()->route('service_img.index')
            ->with('success', 'service_img has been deleted successfully');
    }
}
