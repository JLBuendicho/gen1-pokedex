<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TradeOfferController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/trade-offer', [TradeOfferController::class, 'index'])->name('tradeOffer.index');
});

Route::middleware(['auth', 'role:trainer', 'verified'])->group(function () {
    Route::get('/trade-offer/inbox', [TradeOfferController::class, 'inbox'])->name('tradeOffer.inbox');
    Route::get('/trade-offer/outbox', [TradeOfferController::class, 'outbox'])->name('tradeOffer.outbox');
    Route::get('/trade-offer/create/{peer}', [TradeOfferController::class, 'create'])->name('tradeOffer.create');
    Route::post('/trade-offer/store/{peer}', [TradeOfferController::class, 'store'])->name('tradeOffer.store');
    Route::get('/trade-offer/offer/{tradeOffer}', [TradeOfferController::class, 'trainerShow'])->name('tradeOffer.trainer.show');
    Route::put('/trade-offer/accept/{tradeOffer}', [TradeOfferController::class, 'acceptOffer'])->name('tradeOffer.trainer.accept');
    Route::put('/trade-offer/reject/{tradeOffer}', [TradeOfferController::class, 'rejectOffer'])->name('tradeOffer.trainer.reject');
    Route::put('/trade-offer/resolve/{tradeOffer}', [TradeOfferController::class, 'resolveOffer'])->name('tradeOffer.trainer.resolve');
    Route::get('/trade-offer/{tradeOffer}', [TradeOfferController::class, 'show'])->name('tradeOffer.show');
    Route::get('/trade-offer/{tradeOffer}/edit', [TradeOfferController::class, 'edit'])->name('tradeOffer.edit');
    Route::put('/trade-offer/{tradeOffer}', [TradeOfferController::class, 'update'])->name('tradeOffer.update');
    Route::delete('/trade-offer/{tradeOffer}', [TradeOfferController::class, 'destroy'])->name('tradeOffer.destroy');
});