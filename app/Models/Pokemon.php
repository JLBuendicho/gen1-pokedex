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
}
