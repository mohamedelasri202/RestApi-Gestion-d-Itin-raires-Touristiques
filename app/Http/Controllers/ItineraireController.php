<?php

namespace App\Http\Controllers;

use Iterator;
use App\Models\Itineraire;
use App\Models\Destination;
use Illuminate\Http\Request;

class ItineraireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Itineraire::with('destinations')->get();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'duration' => 'required|integer',
            'img' => 'required|string',
            'start_destination' => 'required|string',
            'final_destination' => 'required|string',
        ]);

        // Create the itinerary
        $itineraire = Itineraire::create([
            'title' => $request->title,
            'category' => $request->category,
            'duration' => $request->duration,
            'img' => $request->img,
            'user_id' => auth()->id(),
        ]);

        // Create the start destination
        Destination::create([
            'itineraire_id' => $itineraire->id,
            'type' => 'start',
            'name' => $request->start_destination,
        ]);

        // Create the final destination
        Destination::create([
            'itineraire_id' => $itineraire->id,
            'type' => 'final',
            'name' => $request->final_destination,
        ]);

        return response()->json($itineraire->load('destinations'), 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Itineraire::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $itineraire = Itineraire::findOrFail($id);

        if ($itineraire->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $itineraire->update($request->all());
        return response()->json($itineraire, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $itineraire = Itineraire::findOrFail($id);

        if ($itineraire->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $itineraire->delete();
        return response()->json(['message' => 'Itinerary deleted successfully']);
    }

    public function search(string $title)
    {
        $itineraire = Itineraire::where('title', 'ILIKE', '%' . $title . '%')->get();

        if ($itineraire->isEmpty()) {
            return response()->json(['message' => 'No itineraries found'], 404);
        }

        return response()->json($itineraire, 200);
    }
}
