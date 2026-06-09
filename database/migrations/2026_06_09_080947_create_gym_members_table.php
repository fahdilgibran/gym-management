<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gym_members', function (Blueprint $table) {
            $table->id();
            $table->string('member_code', 20)->unique();
            $table->string('name', 100);
            $table->string('email', 100)->unique()->nullable();
            $table->string('phone', 20);
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['M', 'F'])->nullable();
            $table->enum('membership_type', ['monthly', 'quarterly', 'annual'])->default('monthly');
            $table->date('start_date');
            $table->date('expire_date');
            $table->string('emergency_contact', 20)->nullable();
            $table->string('photo')->nullable();
            $table->enum('status', ['active', 'expired', 'suspended'])->default('active');
            $table->timestamps();                    // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gym_members');
    }
};