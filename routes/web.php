<?php

use App\Http\Controllers\ProfileController;
use App\Models\Trainer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasePokemonController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'trainer') {
        $trainer = Trainer::where('user_id', $user->id)->first();
        if ($trainer->pokemons_caught === '') {
            return redirect()->route('starter');
        }

        return view('trainer.dashboard');
    }

    return view('pokedex');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/starter', function () {
    $user = auth()->user();
    $trainer = Trainer::where('user_id', $user->id)->first();
    if (!($trainer->pokemons_caught === '')) {
        return redirect()->route('dashboard');
    }
    return view('trainer.starter');
})->middleware(['auth', 'role:trainer', 'verified'])->name('starter');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/pokemons', [BasePokemonController::class, 'index'])->name('pokemons.index');
Route::get('/pokemons/{pokedexId}', [BasePokemonController::class, 'show'])->name('pokemons.show');

require __DIR__ . '/auth.php';
require __DIR__ . '/trainer.php';
require __DIR__ . '/tradeOffer.php';
