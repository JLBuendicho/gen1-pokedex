<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'user_id',
        'pokemons_caught',
        'pokemons_caught_history',
        'pokemon_team',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
