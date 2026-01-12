<?php

namespace App\Http\Controllers;

use App\Models\TradeOffer;
use App\Models\Trainer;
use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TradeOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function inbox()
    {
        $user = auth()->user();
        $trainer = Trainer::where('user_id', $user->id)->first();
        $recievedOffers = TradeOffer::where('to_trainer_id', '=', $trainer->id)
            ->where('status', '=', 'pending')
            ->with(['fromTrainer.user', 'toTrainer.user', 'offeredPokemon.basePokemon', 'requestedPokemon.basePokemon'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('trainer.trade.inbox', compact('trainer', 'recievedOffers'));
    }


    public function outbox()
    {
        $user = auth()->user();
        $trainer = Trainer::where('user_id', $user->id)->first();
        $sentOffers = TradeOffer::where('from_trainer_id', '=', $trainer->id)
            ->where('status', '!=', 'resolved')
            ->with(['fromTrainer.user', 'toTrainer.user', 'offeredPokemon.basePokemon', 'requestedPokemon.basePokemon'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('trainer.trade.outbox', compact('trainer', 'sentOffers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Trainer $peer)
    {
        $user = auth()->user();
        $trainer = Trainer::where('user_id', $user->id)->first();

        if ($trainer->id === $peer->id) {
            return redirect()->route('trainer.showTradeLobby')->with('error', 'You can not trade with yourself!');
        }

        return view('trainer.trade.make-offer', [
            'peer' => $peer,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
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
            return ['result' => 'fail', 'message' => 'Selected Pokemon is not owned by ' . $trainer->user->name];
        }

        $pokemonTeamArray = function ($trainerX) {
            if (str_contains($trainerX->pokemon_team, '|')) {
                return explode('|', $trainerX->pokemon_team);
            } else {
                return [$trainerX->pokemon_team];
            }
        };
        if (in_array($selectedPokemonId, $pokemonTeamArray($trainer))) {
            return ['result' => 'fail', 'message' => 'Selected Pokemon is currently in ' . $trainer->user->name . '\'s team'];
        }

        return ['result' => 'success', 'message' => 'Validation Success'];
    }

    public function store(Request $request, Trainer $peer)
    {
        $user = auth()->user();
        $trainer = Trainer::where('user_id', $user->id)->first();
        $request->validate([
            'selected_pokemon_A_id' => ['required', 'string', 'exists:pokemon,id'],
            'selected_pokemon_B_id' => ['required', 'string', 'exists:pokemon,id'],
        ]);

        $selectedPokemonAValidation = $this->validateSelectedPokemon($request->selected_pokemon_A_id, $trainer);
        $selectedPokemonBValidation = $this->validateSelectedPokemon($request->selected_pokemon_B_id, $peer);

        if ($selectedPokemonAValidation['result'] == 'fail') {
            return redirect()->back()->with('error', $selectedPokemonAValidation['message']);
        }

        if ($selectedPokemonBValidation['result'] == 'fail') {
            return redirect()->back()->with('error', $selectedPokemonBValidation['message']);
        }

        TradeOffer::create([
            'from_trainer_id' => $trainer->id,
            'to_trainer_id' => $peer->id,
            'offered_pokemon' => $request->selected_pokemon_A_id,
            'requested_pokemon' => $request->selected_pokemon_B_id,
            'status' => 'pending',
        ]);

        return redirect()->route('trainer.showTradeLobby')->with('success', 'Trade offer sent to ' . $peer->user->name . ' successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(TradeOffer $tradeOffer)
    {
        //
    }

    public function trainerShow(TradeOffer $tradeOffer)
    {
        $user = auth()->user();
        $trainer = Trainer::where('user_id', $user->id)->first();

        if (!(($trainer->id === $tradeOffer->from_trainer_id) || ($trainer->id === $tradeOffer->to_trainer_id))) {
            return redirect()->route('trainer.showTradeLobby')->with('error', 'You are not part of that trade!');
        }

        // $tradeOffer->load(['fromTrainer', 'toTrainer', 'offeredPokemon.basePokemon', 'requestedPokemon.basePokemon']);
        // return response()->json($tradeOffer);
        return view('trainer.trade.offer', compact('tradeOffer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TradeOffer $tradeOffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TradeOffer $tradeOffer)
    {
        //
    }

    private function handleOtherOffers(string $pokemonId)
    {
        $offers = TradeOffer::where('offered_pokemon', '=', $pokemonId)
            ->where('status', '!=', 'resolved')
            ->orderBy('updated_at', 'desc')
            ->get();
        foreach ($offers as $offer) {
            $offer->update(['status' => 'resolved']);
        }

        $requests = TradeOffer::where('requested_pokemon', '=', $pokemonId)
            ->where('status', '!=', 'resolved')
            ->orderBy('updated_at', 'desc')
            ->get();
        foreach ($requests as $request) {
            $request->update(['status' => 'rejected']);
        }
    }

    private function updateTrainerPokemons(Trainer $trainer, string $toPushPokemonId, string $toPopPokemonId)
    {
        if (str_contains($trainer->pokemons_caught, '|')) {
            $pokemonsCaughtArray = explode('|', $trainer->pokemons_caught);
        } else {
            $pokemonsCaughtArray = [$trainer->pokemons_caught];
        }

        $indexToPop = array_search($toPopPokemonId, $pokemonsCaughtArray);
        array_splice($pokemonsCaughtArray, $indexToPop, 1);

        $pokemonsCaughtArray[] = $toPushPokemonId;

        if (count($pokemonsCaughtArray) > 1) {
            $updatedPokemonsCaught = implode('|', $pokemonsCaughtArray);
        } else {
            $updatedPokemonsCaught = $pokemonsCaughtArray[0];
        }

        if (str_contains($trainer->pokemons_caught_history, '|')) {
            $pokemonsCaughtHistoryArray = explode('|', $trainer->pokemons_caught_history);
        } else {
            $pokemonsCaughtHistoryArray = [$trainer->pokemons_caught_history];
        }

        Log::info('$pokemonsCaughtHistoryArray: ' . json_encode($pokemonsCaughtHistoryArray));
        Log::info('$toPushPokemonId ' . $toPushPokemonId);
        $pokemonsCaughtHistoryArray[] = $toPushPokemonId;
        Log::info('$pokemonsCaughtHistoryArray: ' . json_encode($pokemonsCaughtHistoryArray));

        if (count($pokemonsCaughtHistoryArray) > 1) {
            $updatedPokemonsCaughtHistory = implode('|', $pokemonsCaughtHistoryArray);
        } else {
            $updatedPokemonsCaughtHistory = $pokemonsCaughtHistoryArray[0];
        }

        Log::info('$updatedPokemonsCaughtHistory ' . $updatedPokemonsCaughtHistory);
        $trainer->update(['pokemons_caught' => $updatedPokemonsCaught, 'pokemons_caught_history' => $updatedPokemonsCaughtHistory]);
    }

    private function updatePokemonOwner(Pokemon $pokemon, Trainer $newTrainer)
    {
        $pokemon->update(['prev_trainer_id' => $pokemon->current_trainer_id, 'current_trainer_id' => $newTrainer->id]);
    }

    public function acceptOffer(TradeOffer $tradeOffer)
    {
        $user = auth()->user();
        $trainer = Trainer::where('user_id', $user->id)->first();

        if ($tradeOffer->to_trainer_id != $trainer->id) {
            return redirect()->route('trainer.showTradeLobby')->with('error', 'That trade is not for you to accept!');
        }

        $selectedPokemonAValidation = $this->validateSelectedPokemon($tradeOffer->offeredPokemon->id, $tradeOffer->fromTrainer);
        $selectedPokemonBValidation = $this->validateSelectedPokemon($tradeOffer->requestedPokemon->id, $tradeOffer->toTrainer);

        if ($selectedPokemonAValidation['result'] == 'fail') {
            return redirect()->back()->with('error', $selectedPokemonAValidation['message']);
        }

        if ($selectedPokemonBValidation['result'] == 'fail') {
            return redirect()->back()->with('error', $selectedPokemonBValidation['message']);
        }

        $this->handleOtherOffers($tradeOffer->offeredPokemon->id);
        $this->handleOtherOffers($tradeOffer->requestedPokemon->id);

        $this->updateTrainerPokemons($tradeOffer->fromTrainer, $tradeOffer->requestedPokemon->id, $tradeOffer->offeredPokemon->id);
        $this->updateTrainerPokemons($tradeOffer->toTrainer, $tradeOffer->offeredPokemon->id, $tradeOffer->requestedPokemon->id);

        $this->updatePokemonOwner($tradeOffer->requestedPokemon, $tradeOffer->fromTrainer);
        $this->updatePokemonOwner($tradeOffer->offeredPokemon, $tradeOffer->toTrainer);

        $tradeOffer->update(['status' => 'accepted']);

        return redirect()->route('tradeOffer.inbox')->with('success', 'Accepted ' . $tradeOffer->fromTrainer->user->name . '\'s offer');
    }

    public function rejectOffer(TradeOffer $tradeOffer)
    {
        $user = auth()->user();
        $trainer = Trainer::where('user_id', $user->id)->first();

        if ($tradeOffer->to_trainer_id != $trainer->id) {
            return redirect()->route('trainer.showTradeLobby')->with('error', 'That trade is not for you to reject!');
        }

        $tradeOffer->update(['status' => 'rejected']);

        return redirect()->route('tradeOffer.inbox')->with('success', 'Rejected ' . $tradeOffer->fromTrainer->user->name . '\'s offer');
    }

    public function resolveOffer(TradeOffer $tradeOffer)
    {
        $user = auth()->user();
        $trainer = Trainer::where('user_id', $user->id)->first();

        if ($tradeOffer->from_trainer_id != $trainer->id) {
            return redirect()->route('trainer.showTradeLobby')->with('error', 'That trade is not for you to resolve!');
        }

        $tradeOffer->update(['status' => 'resolved']);

        return redirect()->route('tradeOffer.outbox')->with('success', 'Resolved ' . $tradeOffer->fromTrainer->user->name . '\'s offer');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TradeOffer $tradeOffer)
    {
        //
    }
}
