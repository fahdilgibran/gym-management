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
            $table->date('birth_date')->nullable()->after('gender');
            $table->enum('membership_type', ['monthly', 'quarterly', 'annual'])->nullable()->after('birth_date');
            $table->date('start_date')->nullable()->after('membership_type');
            $table->date('expire_date')->nullable()->after('start_date');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['gender', 'birth_date', 'membership_type', 'start_date', 'expire_date']);
        });
    }
};
