<?php

use App\Http\Controllers\ProfileController;
use App\Models\Trainer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasePokemonController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\AdminController;

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
    } elseif ($user->role === 'admin') {
        return view('admin.dashboard');
    }

    return redirect()->route('admin.dashboard');

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

Route::get('/base-pokemons', [BasePokemonController::class, 'index'])->name('pokemons.index');
Route::get('/base-pokemons/{pokedexId}', [BasePokemonController::class, 'show'])->name('pokemons.show');

Route::get('/owned-pokemons/{id}', [PokemonController::class, 'show'])->name('owned.pokemons.show');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/pokedex', [AdminController::class, 'pokedex'])
            ->name('pokedex');

        Route::get('/trainers', [AdminController::class, 'trainers'])
            ->name('trainers');

        Route::get('/trades', [AdminController::class, 'tradeOffers'])
            ->name('trades');

    });

require __DIR__ . '/auth.php';
require __DIR__ . '/trainer.php';
require __DIR__ . '/tradeOffer.php';
