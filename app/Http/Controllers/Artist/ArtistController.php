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
        return view('artists.show')->with(compact('artist'));
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
        $this->authorize('update', $artist);
        return view('artists.edit')->with(compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Artists\StoreArtist  $request
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(StoreArtist $request, Artist $artist)
    {
        $this->authorize('update', $artist);
        $artist->fill($request->all());
        $artist->save();
        return redirect()
            ->route('artists.show', ['artist' => $artist->id])
            ->with('success', "L'artiste a bien été modifié !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $this->authorize('delete', $artist);
        if ($artist->runs()->exists()) {
            return redirect()
                ->back()
                ->with('warning', "L'artiste {$artist->name} est utilisé dans un ou plusieurs runs, il ne peut pas être supprimé.");
        } else {
            $artist->delete();
            return redirect()
                ->route('artists.index')
                ->with('success', "L'artiste : {$artist->name} a bien été supprimé !");
        }
    }
}
