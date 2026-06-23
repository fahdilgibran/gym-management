<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('body_measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('gym_members')->onDelete('cascade');
            $table->date('measurement_date');
            $table->decimal('weight_kg', 5, 2);
            $table->decimal('body_fat_percentage', 5, 2)->nullable();
            $table->decimal('muscle_mass_kg', 5, 2)->nullable();
            $table->decimal('chest_cm', 5, 2)->nullable();
            $table->decimal('waist_cm', 5, 2)->nullable();
            $table->decimal('arm_cm', 5, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('body_measurements');
    }
};