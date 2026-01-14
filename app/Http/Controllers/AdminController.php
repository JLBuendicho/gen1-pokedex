<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\BasePokemon;
use App\Models\TradeOffer;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function pokedex()
    {

        $pokemons = BasePokemon::OrderBy('pokedex_id')->get();

        return view('pokedex', compact('pokemons'));
    }

    public function trainers()
    {
        $trainers = Trainer::with('user')->get();
        return view('admin.trainers', compact('trainers'));
    }

    public function tradeOffers()
    {
        $trades = TradeOffer::with([
            'fromTrainer.user',
            'toTrainer.user',
            'offeredPokemon.basePokemon',
            'requestedPokemon.basePokemon',
        ])
            ->latest()
            ->get();

        return view('admin.trade_offers', compact('trades'));
    }

}