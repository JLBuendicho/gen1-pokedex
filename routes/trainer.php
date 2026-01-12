<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainerController;

Route::middleware(['auth', 'role:trainer', 'verified'])->group(function () {
    Route::get('/trainer', [TrainerController::class, 'index'])->name('trainer.index');
    Route::get('/trainer/create', [TrainerController::class, 'create'])->name('trainer.create');
    Route::post('/trainer', [TrainerController::class, 'store'])->name('trainer.store');
    Route::get('/trainer/trade', [TrainerController::class, 'showTradeLobby'])->name('trainer.showTradeLobby');
    Route::get('/trainer/pokedex', [TrainerController::class, 'showPokedex'])->name('trainer.pokedex');
    Route::get('/trainer/{trainer}', [TrainerController::class, 'show'])->name('trainer.show');
    Route::get('/trainer/{trainer}/edit', [TrainerController::class, 'edit'])->name('trainer.edit');
    Route::put('/trainer/{trainer}', [TrainerController::class, 'update'])->name('trainer.update');
    Route::put('/trainer/{trainer}', [TrainerController::class, 'updatePokemonsCaught'])->name('trainer.updatePokemonsCaught');
    Route::put('/trainer/{trainer}/set-starter', [TrainerController::class, 'setStarterPokemon'])->name('trainer.setStarterPokemon');
    Route::delete('/trainer/{trainer}', [TrainerController::class, 'destroy'])->name('trainer.destroy');
});
