<?php

namespace App\Http\Controllers;

use App\Models\gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class galleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $galleries = gallery::simplePaginate(16);
        return view('gallery', compact('galleries'));
    }

    public function showtable()
    {

        $galleries = gallery::all();
        return view('upload', compact('galleries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:255',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');
        gallery::create([
            'name' => $request->input('name'),
            'image' => $imagePath,
            'description' => $request->input('description'),
        ]);

        return response("
        <script>
            alert('Image stored successfully!');
            location.reload;
        </script>
    ");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:255',
        ]);

        $gallery->name = $validatedData['name'];

        if ($request->hasFile('image')) {
            Storage::delete('public/images/' . $gallery->image);
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);
            $gallery->image = $imageName;
        }
        $gallery->save();
        return redirect()->route('upload')->with('success', 'Gallery updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $gallery = Gallery::find($id);
    
        if ($gallery) {
            $gallery->delete();
            return redirect()->route('upload')->with('success', 'Image deleted successfully!');
        } else {
            return redirect()->route('upload')->with('error', 'Image not found!');
        }
    }
    
}
