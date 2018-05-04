<?php

namespace App\Http\Controllers\Artist;

use App\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Artists\StoreArtist;
use App\Http\Resources\Artists\ArtistResource;

/**
 * ArtistController
 *
 * @author Bastien Nicoud
 * @package App\Http\Controllers\Artist
 */
class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artist::orderBy('name', 'asc')->paginate(25);
        return view('artists.index')->with(compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Artist::class);
        return view('artists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Artists\StoreArtist  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArtist $request)
    {
        $this->authorize('create', Artist::class);
        Artist::create($request->all());
        return redirect()->route('artists.index')->with('success', "L'artiste a bien été crée !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        return view('artists.show');
    }

    /**
     * Search in the model, return json
     * This method is designed to be used with the search fields (see the search field component)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if ($request->needle) {
            // Case insensitive search
            $results = Artist::whereRaw('LOWER(`name`) LIKE ? ', [trim(strtolower($request->needle)).'%'])->get();
            return ArtistResource::collection($results);
        } else {
            return response()->json([], 200);
        }
        return response()->json([], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        $this->authorize('create', Artist::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {
        $this->authorize('create', Artist::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $this->authorize('create', Artist::class);
    }
}
