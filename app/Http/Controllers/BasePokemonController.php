<?php

namespace App\Http\Controllers;

use App\Models\BasePokemon;
use App\Models\Trainer;
use App\Http\Controllers\TrainerController;
use Illuminate\Http\Request;

class BasePokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pokemons = BasePokemon::orderBy('pokedex_id')->get();
        $user = auth()->user();
        if ($user && $user->role === 'trainer') {
            $trainer = Trainer::where('user_id', $user->id)->first();
            return (new TrainerController())->showPokedex($trainer);
        }

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

        $baseMoves = \DB::table('base_pokemon')
            ->where('pokedex_id', $pokemon->pokedex_id)
            ->get(['base_move1', 'base_move2', 'base_move3', 'base_move4'])
            ->flatMap(function ($row) {
                return collect([
                    $row->base_move1,
                    $row->base_move2,
                    $row->base_move3,
                    $row->base_move4,
                ]);
            })
            ->filter()
            ->unique()
            ->values();

        $abilities = \DB::table('base_pokemon')
            ->where('pokedex_id', $pokemon->pokedex_id)
            ->whereNotNull('base_abilities')
            ->distinct()
            ->pluck('base_abilities');

        $evolutionLineIds = explode('|', $pokemon->evolution_line_id);
        $evolutions = [];

        foreach ($evolutionLineIds as $evolutionId) {
            $evolution = BasePokemon::where('pokedex_id', $evolutionId)
                ->firstOrFail();
            $evolutions[] = $evolution;
        }

        if ($evolutions[0]->pokedex_id === $evolutions[1]->pokedex_id) {
            $evolutions = [$evolutions[0]];
        }

        $nextPokemon = BasePokemon::where('pokedex_id', '>', $id)
            ->orderBy('pokedex_id')
            ->first();

        $prevPokemon = BasePokemon::where('pokedex_id', '<', $id)
            ->orderByDesc('pokedex_id')
            ->first();

        return view('pokemons.show', compact(
            'pokemon',
            'nextPokemon',
            'prevPokemon',
            'evolutions',
            'abilities',
            'baseMoves'
        ));
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
