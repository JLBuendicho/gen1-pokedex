<?php

use App\Http\Controllers\BasePokemonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pokemons', [BasePokemonController::class, 'index'])->name('pokemons.index');
Route::get('/pokemons/{id}', [BasePokemonController::class, 'show'])->name('pokemons.show');