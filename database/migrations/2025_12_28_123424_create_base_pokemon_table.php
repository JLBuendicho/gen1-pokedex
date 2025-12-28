<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('base_pokemon', function (Blueprint $table) {
            $table->id();
            $table->string('pokedex_id')->unique(); // three digits padded by 0 (00x)
            $table->string('name');
            $table->string('type'); // types separated by "|"
            $table->string('base_abilities')->nullable(); // abilities separated by "|"

            // min and max possible starting stats
            $table->integer('min_hp'); // min possible starting HP
            $table->integer('max_hp'); // max possible starting HP
            $table->integer('min_attack'); // min possible starting Attack
            $table->integer('max_attack'); // max possible starting Attack
            $table->integer('min_defense'); // min possible starting Defense
            $table->integer('max_defense'); // max possible starting Defense
            $table->integer('min_special_attack'); // min possible starting Special Attack
            $table->integer('max_special_attack'); // max possible starting Special Attack
            $table->integer('min_special_defense'); // min possible starting Special Defense
            $table->integer('max_special_defense'); // max possible starting Special Defense
            $table->integer('min_speed'); // min possible starting Speed
            $table->integer('max_speed'); // max possible starting Speed

            // starting move set
            $table->string('base_move1');
            $table->string('base_move2')->nullable();
            $table->string('base_move3')->nullable();
            $table->string('base_move4')->nullable();

            // get sprites from external url, using gen 1 normal sprites from https://pokemondb.net/sprites#gen1
            $table->string('sprite_url')->nullable();

            $table->string('description');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_pokemon');
    }
};
