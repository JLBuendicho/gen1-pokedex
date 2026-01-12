<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradeOffer extends Model
{
    protected $fillable = [
        'from_trainer_id',
        'to_trainer_id',
        'offered_pokemon',
        'requested_pokemon',
        'status',
    ];

    public function fromTrainer()
    {
        return $this->belongsTo(Trainer::class, 'from_trainer_id');
    }

    public function toTrainer()
    {
        return $this->belongsTo(Trainer::class, 'to_trainer_id');
    }

    public function offeredPokemon()
    {
        return $this->belongsTo(Pokemon::class, 'offered_pokemon');
    }

    public function requestedPokemon()
    {
        return $this->belongsTo(Pokemon::class, 'requested_pokemon');
    }
}
