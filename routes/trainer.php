<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainerController;

Route::middleware(['auth', 'role:trainer', 'verified'])->group(function () {
    Route::get('/trainer', [TrainerController::class, 'index'])->name('trainer.index');
    Route::get('/trainer/create', [TrainerController::class, 'create'])->name('trainer.create');
    Route::post('/trainer', [TrainerController::class, 'store'])->name('trainer.store');
    Route::get('/trainer/trade', [TrainerController::class, 'showTradeLobby'])->name('trainer.showTradeLobby');
    Route::get('/trainer/pokedex', [TrainerController::class, 'showPokedex'])->name('trainer.pokedex');
    Route::get('/trainer/pokedex/{pokedexId}', [TrainerController::class, 'showPokedexPokemon'])->name('trainer.pokedex.showPokemon');
    Route::get('/trainer/team', [TrainerController::class, 'showTeam'])->name('trainer.show.team');
    Route::put('/trainer/team/add', [TrainerController::class, 'updateTeamAdd'])->name('trainer.update.team.add');
    Route::put('/trainer/team/clear', [TrainerController::class, 'updateTeamClear'])->name('trainer.clear.team');
    Route::get('/trainer/explore', [TrainerController::class, 'showExplore'])->name('trainer.explore');
    Route::put('/trainer/catch/{pokemon}', [TrainerController::class, 'catchPokemon'])->name('trainer.catch');
    Route::get('/trainer/{trainer}', [TrainerController::class, 'show'])->name('trainer.show');
    Route::get('/trainer/{trainer}/edit', [TrainerController::class, 'edit'])->name('trainer.edit');
    Route::put('/trainer/{trainer}', [TrainerController::class, 'update'])->name('trainer.update');
    Route::put('/trainer/{trainer}', [TrainerController::class, 'updatePokemonsCaught'])->name('trainer.updatePokemonsCaught');
    Route::put('/trainer/{trainer}/set-starter', [TrainerController::class, 'setStarterPokemon'])->name('trainer.setStarterPokemon');
    Route::delete('/trainer/{trainer}', [TrainerController::class, 'destroy'])->name('trainer.destroy');
});
