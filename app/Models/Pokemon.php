<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $fillable = [
        'pokedex_id',
        'prev_trainer_id',
        'current_trainer_id',
        'abilities',
        'hp',
        'attack',
        'defense',
        'special_attack',
        'special_defense',
        'speed',
        'move1',
        'move2',
        'move3',
        'move4',
    ];

    public function basePokemon()
    {
        return $this->belongsTo(BasePokemon::class, 'pokedex_id', 'pokedex_id');
    }

    public function prevTrainer()
    {
        return $this->belongsTo(Trainer::class, 'prev_trainer_id');
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'current_trainer_id');
    }
}
