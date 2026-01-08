<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'user_id',
        'pokemons_caught',
        'pokemon_team',
    ];
}
