<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainerController;

Route::middleware(['auth', 'role:trainer', 'verified'])->group(function () {
    Route::get('/trainer', [TrainerController::class, 'index'])->name('trainer.index');
    Route::get('/trainer/create', [TrainerController::class, 'create'])->name('trainer.create');
    Route::post('/trainer', [TrainerController::class, 'store'])->name('trainer.store');
    Route::get('/trainer/{trainer}', [TrainerController::class, 'show'])->name('trainer.show');
    Route::get('/trainer/pokedex/{trainer}', [TrainerController::class, 'showPokedex'])->name('trainer.pokedex');
    Route::get('/trainer/{trainer}/edit', [TrainerController::class, 'edit'])->name('trainer.edit');
    Route::put('/trainer/{trainer}', [TrainerController::class, 'update'])->name('trainer.update');
    Route::put('/trainer/{trainer}', [TrainerController::class, 'updatePokemonsCaught'])->name('trainer.updatePokemonsCaught');
    Route::delete('/trainer/{trainer}', [TrainerController::class, 'destroy'])->name('trainer.destroy');
});
