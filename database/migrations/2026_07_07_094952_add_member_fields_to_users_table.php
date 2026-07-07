<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('gender', ['M', 'F'])->nullable()->after('phone');
            $table->enum('membership_type', ['monthly', 'quarterly', 'annual'])->default('monthly')->after('gender');
            $table->date('birth_date')->nullable()->after('membership_type');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['gender', 'membership_type', 'birth_date']);
        });
    }
};