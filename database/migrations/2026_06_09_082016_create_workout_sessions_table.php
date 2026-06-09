<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workout_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')
                  ->constrained('gym_members')
                  ->onDelete('cascade');
            
            $table->date('session_date');
            $table->string('trainer_name')->nullable();
            $table->string('session_type', 50);
            $table->integer('duration_minutes')->default(60);
            $table->integer('calories_burned')->nullable();
            $table->text('exercises_done')->nullable();
            $table->decimal('weight_kg', 5, 2)->nullable();
            $table->text('notes')->nullable();
            $table->tinyInteger('rating')->nullable(); // 1 sampai 5
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workout_sessions');
    }
};