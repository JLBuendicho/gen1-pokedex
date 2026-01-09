<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pokemon', function (Blueprint $table) {
            $table->id();
            $table->string('pokedex_id');
            $table->foreign('pokedex_id')->references('pokedex_id')->on('base_pokemon')->onDelete('cascade');
            $table->foreignId('prev_trainer_id')->nullable()->constrained('trainers')->onDelete('set null');
            $table->foreignId('current_trainer_id')->nullable()->constrained('trainers')->onDelete('set null');
            $table->string('abilities')->nullable();
            $table->integer('hp');
            $table->integer('attack');
            $table->integer('defense');
            $table->integer('special_attack');
            $table->integer('special_defense');
            $table->integer('speed');
            $table->string('move1');
            $table->string('move2')->nullable();
            $table->string('move3')->nullable();
            $table->string('move4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon');
    }
};
