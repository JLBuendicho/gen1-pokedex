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

    public function showTeam()
    {
        return view('trainer.pokemon.team');
    }

    public function showExplore()
    {
        $freePokemons = Pokemon::whereNull('current_trainer_id')->get();
        if (count($freePokemons) < 5) {
            $basePokemons = BasePokemon::get();
            $basePokemonsLen = count($basePokemons);
            $basePokemon = BasePokemon::findOrFail(mt_rand(1, $basePokemonsLen));
            $freePokemon = (new PokemonController())->storeFree($basePokemon);

            return view('trainer.explore', ['pokemon' => $freePokemon]);
        }

        $freePokemonsLen = count($freePokemons);
        $freePokemon = $freePokemons[mt_rand(0, $freePokemonsLen - 1)];

        // return response()->json($freePokemon);
        return view('trainer.explore', ['pokemon' => $freePokemon]);
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
        $pokemonCaughtIds = $trainer->pokemons_caught_history;
        $pokemonsCaughtIdArray = [];
        if (str_contains($pokemonCaughtIds, '|')) {
            $pokemonsCaughtIdArray = array_unique(explode('|', $pokemonCaughtIds));
        } elseif ($pokemonCaughtIds !== '') {
            return redirect()->route('trainer.pokedex')->with('error', 'You\'re yet to catch a pokemon');
        } else {
            $pokemonsCaughtIdArray = [$pokemonCaughtIds];
        }

        $pokemonsCaught = [];
        foreach ($pokemonsCaughtIdArray as $pokemonCaughtId) {
            $pokemonsCaught[] = Pokemon::with('basePokemon')->where('id', $pokemonCaughtId)->first();
        }

        $uniquePokemonsCaught = [];
        foreach ($pokemonsCaught as $pokemonCaught) {
            if (empty($uniquePokemonsCaught)) {
                $uniquePokemonsCaught[] = $pokemonCaught;
                continue;
            }

            $ids = [];
            foreach ($uniquePokemonsCaught as $uniquePokemon) {
                $ids[] = $uniquePokemon->pokedex_id;
            }
            if (!in_array($pokemonCaught->pokedex_id, $ids)) {
                $uniquePokemonsCaught[] = $pokemonCaught;
            }
        }

        $uniquePokemonCaughtIds = [];
        foreach ($uniquePokemonsCaught as $pokemonCaught) {
            $uniquePokemonCaughtIds[] = Pokemon::where('id', $pokemonCaught->id)->first()->pokedex_id;
        }

        $pokemons = BasePokemon::orderBy('pokedex_id')->get();

        return view('trainer.pokedex.pokedex', compact('pokemons', 'uniquePokemonCaughtIds'));
    }

    public function showPokedexPokemon($pokedexId)
    {
        $user = auth()->user();
        $trainer = Trainer::where('user_id', $user->id)->first();
        $trainer = Trainer::where('user_id', $user->id)->first();
        $pokemonCaughtIds = $trainer->pokemons_caught_history;
        $pokemonsCaughtIdArray = [];
        if (str_contains($pokemonCaughtIds, '|')) {
            $pokemonsCaughtIdArray = array_unique(explode('|', $pokemonCaughtIds));
        } elseif ($pokemonCaughtIds !== '') {
            $pokemonsCaughtIdArray = [$pokemonCaughtIds];
        } else {
            return redirect()->route('trainer.pokedex')->with('error', 'You\'re yet to catch a pokemon');
        }

        $pokemonsCaught = [];
        foreach ($pokemonsCaughtIdArray as $pokemonCaughtId) {
            $pokemonsCaught[] = Pokemon::where('id', $pokemonCaughtId)->with('basePokemon')->first();
        }

        $uniquePokemonsCaught = [];
        foreach ($pokemonsCaught as $pokemonCaught) {
            if (empty($uniquePokemonsCaught)) {
                $uniquePokemonsCaught[] = $pokemonCaught;
                continue;
            }

            $ids = [];
            foreach ($uniquePokemonsCaught as $uniquePokemon) {
                $ids[] = $uniquePokemon->pokedex_id;
            }
            if (!in_array($pokemonCaught->pokedex_id, $ids)) {
                $uniquePokemonsCaught[] = $pokemonCaught;
            }
        }

        $uniquePokemonCaughtIds = [];
        foreach ($uniquePokemonsCaught as $pokemonCaught) {
            $uniquePokemonCaughtIds[] = Pokemon::where('id', $pokemonCaught->id)->first()->pokedex_id;
        }

        if (!in_array($pokedexId, $uniquePokemonCaughtIds)) {
            return redirect()->route('trainer.pokedex')->with('error', 'You\'re yet to catch that pokemon');
        }

        $currentIndex = 0;
        $uniquePokemonsCaughtLen = count($uniquePokemonsCaught);
        foreach ($uniquePokemonsCaught as $pokemonCaught) {
            if ($pokemonCaught->pokedex_id == $pokedexId) {
                $currentIndex = array_search($pokemonCaught, $uniquePokemonsCaught);
            }
        }

        if ($currentIndex - 1 < 0) {
            $prevPokemon = $uniquePokemonsCaught[$uniquePokemonsCaughtLen - 1];
        } else {
            $prevPokemon = $uniquePokemonsCaught[$currentIndex - 1];
        }

        if ($currentIndex + 1 >= $uniquePokemonsCaughtLen) {
            $nextPokemon = $uniquePokemonsCaught[0];
        } else {
            $nextPokemon = $uniquePokemonsCaught[$currentIndex + 1];
        }

        //Base Moves
        $pokemon = BasePokemon::where('pokedex_id', $pokedexId)->firstOrFail();

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


        //Base Abilities
        $abilities = \DB::table('base_pokemon')
            ->where('pokedex_id', $pokemon->pokedex_id)
            ->whereNotNull('base_abilities')
            ->distinct()
            ->pluck('base_abilities');


        //Evolutions
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

        return view('trainer.pokedex.show', compact(
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

    public function catchPokemon(Pokemon $pokemon)
    {
        if ($pokemon->current_trainer_id != null) {
            $unavailablePokemon = Pokemon::with('trainer.user')->findOrFail($pokemon->id);
            return redirect()->back()->with('error', 'You were too slow! ' . $unavailablePokemon->trainer->user->name . ' already caught this ' . $unavailablePokemon->basePokemon->name);
        }

        $user = auth()->user();
        $trainer = Trainer::where('user_id', $user->id)->first();

        if (str_contains($trainer->pokemons_caught, '|')) {
            $pokemonsCaughtArray = explode('|', $trainer->pokemons_caught);
        } else {
            $pokemonsCaughtArray = [$trainer->pokemons_caught];
        }

        if (str_contains($trainer->pokemons_caught_history, '|')) {
            $pokemonsCaughtHistoryArray = explode('|', $trainer->pokemons_caught_history);
        } else {
            $pokemonsCaughtHistoryArray = [$trainer->pokemons_caught_history];
        }

        $pokemonsCaughtArray[] = $pokemon->id;
        $pokemonsCaughtHistoryArray[] = $pokemon->id;

        if (count($pokemonsCaughtArray) > 1) {
            $updatedPokemonsCaught = implode('|', $pokemonsCaughtArray);
        } else {
            $updatedPokemonsCaught = $pokemonsCaughtHistoryArray[0];
        }

        if (count($pokemonsCaughtHistoryArray) > 1) {
            $updatedPokemonsCaughtHistory = implode('|', $pokemonsCaughtHistoryArray);
        } else {
            $updatedPokemonsCaughtHistory = $pokemonsCaughtHistoryArray[0];
        }

        $pokemon->update(['current_trainer_id' => $trainer->id]);
        $trainer->update(['pokemons_caught' => $updatedPokemonsCaught, 'pokemons_caught_history' => $updatedPokemonsCaughtHistory]);

        return redirect()->back()->with('success', $pokemon->basePokemon->name . ' caught successfully!');
    }

    private function validateSelectedPokemon(string $selectedPokemonId, Trainer $trainer)
    {
        $pokemonsCaughtArray = function (Trainer $trainerX) {
            if (str_contains($trainerX->pokemons_caught, '|')) {
                return explode('|', $trainerX->pokemons_caught);
            } else {
                return [$trainerX->pokemons_caught];
            }
        };
        if (!in_array($selectedPokemonId, $pokemonsCaughtArray($trainer))) {
            return ['result' => 'fail', 'message' => 'You do not own the selected Pokemon'];
        }

        $pokemonTeamArray = function ($trainerX) {
            if (str_contains($trainerX->pokemon_team, '|')) {
                return explode('|', $trainerX->pokemon_team);
            } else {
                return [$trainerX->pokemon_team];
            }
        };
        if (in_array($selectedPokemonId, $pokemonTeamArray($trainer))) {
            return ['result' => 'fail', 'message' => 'Selected Pokemon is already in your team'];
        }

        return ['result' => 'success', 'message' => 'Validation Success'];
    }

    public function updateTeamAdd(Request $request)
    {
        $user = auth()->user();
        $trainer = Trainer::where('user_id', $user->id)->first();
        $request->validate([
            'selected_pokemon_id' => ['required', 'string', 'exists:pokemon,id'],
        ]);

        $selectedPokemonValidation = $this->validateSelectedPokemon($request->selected_pokemon_id, $trainer);

        if ($selectedPokemonValidation['result'] == 'fail') {
            return redirect()->back()->with('error', $selectedPokemonValidation['message']);
        }

        if (str_contains($trainer->pokemon_team, '|')) {
            $pokemonTeamArray = explode('|', $trainer->pokemon_team);
        } elseif ($trainer->pokemon_team == '') {
            $pokemonTeamArray = [];
        } else {
            $pokemonTeamArray = [$trainer->pokemon_team];
        }

        if (count($pokemonTeamArray) >= 6) {
            array_shift($pokemonTeamArray);
        }

        $pokemonTeamArray[] = $request->selected_pokemon_id;

        if (count($pokemonTeamArray) > 1) {
            $updatedPokemonTeam = implode('|', $pokemonTeamArray);
        } else {
            $updatedPokemonTeam = $pokemonTeamArray[0];
        }

        $trainer->update(['pokemon_team' => $updatedPokemonTeam]);

        return redirect()->back();
    }

    public function updateTeamClear()
    {
        $user = auth()->user();
        $trainer = Trainer::where('user_id', $user->id)->first();

        $trainer->update(['pokemon_team' => '']);

        return redirect()->back();
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
