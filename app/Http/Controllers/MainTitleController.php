<?php

namespace App\Http\Controllers;

use App\Models\MainTitle;
use Illuminate\Http\Request;

class MainTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $mainTitles = MainTitle::all();
        return view('mainTitles.index', compact('mainTitles'));
    }

    public function getTitle()
    {
        $mainTitles = MainTitle::all();
        return response()->json($mainTitles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mainTitles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'word1' => 'required|string',
        'word2' => 'required|string',
    ]);

    // Create a new MainTitle instance and save the data
    $mainTitle = new MainTitle();
    $mainTitle->word1 = $request->input('word1');
    $mainTitle->word2 = $request->input('word2');
    $mainTitle->save();

    // Return the view with the updated list of main titles
    return redirect()->route('mainTitles.index')
    ->with('success', 'Main title added successfully!');

}

    /**
     * Display the specified resource.
     */
    public function show(MainTitle $mainTitle)
    {
        return view('mainTitles.show', compact('mainTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MainTitle $mainTitle)
    {
        return view('mainTitles.edit', compact('mainTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MainTitle $mainTitle)
    {
        $request->validate([
            'word1' => 'required|string',
            'word2' => 'required|string',
        ]);

        $mainTitle->word1 = $request->word1;
        $mainTitle->word2 = $request->word2;
        $mainTitle->save();

        return redirect()->route('mainTitles.index')->with('success', 'Main title updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MainTitle $mainTitle)
    {
        $mainTitle->delete();
        return redirect()->route('mainTitles.index')->with('success', 'Main title deleted successfully!');
    }
}
