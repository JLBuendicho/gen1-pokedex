<?php

namespace App\Http\Controllers;

use App\Models\BasePokemon;
use App\Models\Trainer;
use App\Models\Pokemon;
use App\Http\Controllers\PokemonController;
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

    public function showTradeLobby()
    {
        $user = auth()->user();
        $trainer = Trainer::where('user_id', $user->id)->first();
        $peers = Trainer::where('id', '!=', $trainer->id)->with('user')->get();

        return view('trainer.trade.lobby', compact('peers'));
    }

    public function showPokedex()
    {
        $user = auth()->user();
        $trainer = Trainer::where('user_id', $user->id)->first();
        $pokemonsCaught = $trainer->pokemons_caught_history;
        $uniquePokemonsCaught = [];
        if (str_contains($pokemonsCaught, '|')) {
            $uniquePokemonsCaught = array_unique(explode('|', $pokemonsCaught));
        } elseif ($pokemonsCaught !== '') {
            $uniquePokemonsCaught = [$pokemonsCaught];
        }

        $uniquePokemonCaughtIds = [];
        foreach ($uniquePokemonsCaught as $pokemonCaught) {
            $uniquePokemonCaughtIds[] = Pokemon::where('id', $pokemonCaught)->first()->pokedex_id;
        }

        $pokemons = BasePokemon::orderBy('pokedex_id')->get();

        return view('trainer.pokedex', compact('pokemons', 'uniquePokemonCaughtIds'));
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

    public function setStarterPokemon(Request $request, Trainer $trainer)
    {
        $request->validate([
            'starter_pokemon_id' => ['required', 'string', 'exists:base_pokemon,pokedex_id'],
        ]);

        $basePokemon = BasePokemon::where('pokedex_id', $request->starter_pokemon_id)->first();
        $starterPokemon = (new PokemonController())->store($basePokemon, $trainer);

        $trainer->update(['pokemons_caught' => $starterPokemon->id, 'pokemons_caught_history' => $starterPokemon->id]);

        return redirect()->back()->with('success', 'Starter Pokémon set successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trainer $trainer)
    {
        //
    }
}
