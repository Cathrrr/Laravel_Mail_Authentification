<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $movies = Movie::all(); // Mengambil semua data movie dari database
        return view('movies.index', compact('movies'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        $validatedData = $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'release_year' => 'required|integer',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('movies', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        Movie::create($validatedData);

        return redirect()->route('movies.index')->with('success', 'Movie added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $request->validate([
            'image_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'release_year' => 'required|integer',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('image_path')) {
            if ($movie->image_path) {
                Storage::disk('public')->delete($movie->image_path);
            }
            $imagePath = $request->file('image_path')->store('movies', 'public');
            $movie->image_path = $imagePath;
        }

        $movie->name = $request->input('name');
        $movie->release_year = $request->input('release_year');
        $movie->description = $request->input('description');
        $movie->save();

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        if ($movie->image_path) {
            Storage::disk('public')->delete($movie->image_path);
        }

        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully!');
    }
}
