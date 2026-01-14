<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasePokemon extends Model
{
    protected $table = 'base_pokemon';

    protected $fillable = [
        'pokedex_id',
        'name',
        'type',
        'base_abilities',
        'min_hp',
        'max_hp',
        'min_attack',
        'max_attack',
        'min_defense',
        'max_defense',
        'min_special_attack',
        'max_special_attack',
        'min_special_defense',
        'max_special_defense',
        'min_speed',
        'max_speed',
        'base_move1',
        'base_move2',
        'base_move3',
        'base_move4',
        'sprite_url',
        'description',
        'evolution_line_id',
    ];
}
    