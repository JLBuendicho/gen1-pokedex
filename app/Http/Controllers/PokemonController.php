<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\BasePokemon;
use App\Models\Trainer;
use Illuminate\Http\Request;

class PokemonController extends Controller
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
    public function store(BasePokemon $basePokemon, Trainer $trainer)
    {
        $pokemon = Pokemon::create([
            'pokedex_id' => $basePokemon->pokedex_id,
            'prev_trainer_id' => null,
            'current_trainer_id' => $trainer->id,
            'abilities' => $basePokemon->base_abilities,
            'hp' => mt_rand($basePokemon->min_hp, $basePokemon->max_hp),
            'attack' => mt_rand($basePokemon->min_attack, $basePokemon->max_attack),
            'defense' => mt_rand($basePokemon->min_defense, $basePokemon->max_defense),
            'special_attack' => mt_rand($basePokemon->min_special_attack, $basePokemon->max_special_attack),
            'special_defense' => mt_rand($basePokemon->min_special_defense, $basePokemon->max_special_defense),
            'speed' => mt_rand($basePokemon->min_speed, $basePokemon->max_speed),
            'move1' => $basePokemon->base_move1,
            'move2' => $basePokemon->base_move2,
            'move3' => $basePokemon->base_move3,
            'move4' => $basePokemon->base_move4,
        ]);

        return $pokemon;
    }

    public function storeFree(BasePokemon $basePokemon)
    {
        $pokemon = Pokemon::create([
            'pokedex_id' => $basePokemon->pokedex_id,
            'prev_trainer_id' => null,
            'current_trainer_id' => null,
            'abilities' => $basePokemon->base_abilities,
            'hp' => mt_rand($basePokemon->min_hp, $basePokemon->max_hp),
            'attack' => mt_rand($basePokemon->min_attack, $basePokemon->max_attack),
            'defense' => mt_rand($basePokemon->min_defense, $basePokemon->max_defense),
            'special_attack' => mt_rand($basePokemon->min_special_attack, $basePokemon->max_special_attack),
            'special_defense' => mt_rand($basePokemon->min_special_defense, $basePokemon->max_special_defense),
            'speed' => mt_rand($basePokemon->min_speed, $basePokemon->max_speed),
            'move1' => $basePokemon->base_move1,
            'move2' => $basePokemon->base_move2,
            'move3' => $basePokemon->base_move3,
            'move4' => $basePokemon->base_move4,
        ]);

        return $pokemon;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pokemon = Pokemon::with(['basePokemon', 'prevTrainer.user', 'trainer.user'])->findOrFail($id);
        // return response()->json($pokemon);
        return view('pokemons.owned.show', compact('pokemon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pokemon $pokemon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pokemon $pokemon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pokemon $pokemon)
    {
        //
    }
}
