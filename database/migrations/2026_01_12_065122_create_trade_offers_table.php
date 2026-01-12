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
        Schema::create('trade_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_trainer_id')->nullable()->constrained('trainers')->onDelete('set null');
            $table->foreignId('to_trainer_id')->nullable()->constrained('trainers')->onDelete('set null');
            $table->foreignId('offered_pokemon')->nullable()->constrained('pokemon')->onDelete('set null');
            $table->foreignId('requested_pokemon')->nullable()->constrained('pokemon')->onDelete('set null');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_offers');
    }
};
