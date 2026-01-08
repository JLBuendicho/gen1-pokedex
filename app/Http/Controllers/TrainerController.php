<?php

namespace App\Http\Controllers;

use App\Models\BasePokemon;
use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Trainer $trainer)
    {
        //
    }

    public function showPokedex(Trainer $trainer)
    {
        $pokemons = BasePokemon::orderBy('pokedex_id')->get();
        if (str_contains($trainer->pokemons_caught, '|')) {
            $pokemonsCaught = explode('|', $trainer->pokemons_caught);
        } elseif ($trainer->pokemons_caught !== '') {
            $pokemonsCaught = [$trainer->pokemons_caught];
        } else {
            $pokemonsCaught = [];
        }

        return view('trainer.pokedex', compact('trainer', 'pokemons', 'pokemonsCaught'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trainer $trainer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trainer $trainer)
    {
        //
    }

    public function updatePokemonsCaught(Request $request, Trainer $trainer)
    {
        $validated = $request->validate([
            'pokemons_caught' => ['required', 'string'],
        ]);

        $trainer->update($validated);

        return redirect()->back()->with('success', 'Pokémon/s added to inventory.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trainer $trainer)
    {
        //
    }
}
