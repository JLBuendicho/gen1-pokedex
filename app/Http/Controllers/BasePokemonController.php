<?php

namespace App\Http\Controllers;

use App\Models\BasePokemon;
use Illuminate\Http\Request;

class BasePokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pokemons = BasePokemon::orderBy('pokedex_id')->get();

        return view('pokedex', compact('pokemons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pokemon = BasePokemon::where('pokedex_id', $id)->firstOrFail();

        return view('pokemons.show', compact('pokemon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BasePokemon $basePokemon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BasePokemon $basePokemon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BasePokemon $basePokemon)
    {
        //
    }
}
