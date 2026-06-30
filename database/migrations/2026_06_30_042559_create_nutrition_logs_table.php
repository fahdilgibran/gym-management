<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nutrition_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('gym_members')->onDelete('cascade');
            $table->date('log_date');
            $table->integer('calories_intake')->nullable();        // Kalori yang dikonsumsi
            $table->integer('protein_grams')->nullable();
            $table->integer('carbs_grams')->nullable();
            $table->integer('fats_grams')->nullable();
            $table->text('meals_description')->nullable();         // Deskripsi makanan
            $table->text('notes')->nullable();                     // Catatan tambahan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nutrition_logs');
    }
};