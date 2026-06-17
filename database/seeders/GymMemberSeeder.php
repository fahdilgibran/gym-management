<?php

namespace Database\Seeders;

use App\Models\GymMember;
use App\Models\WorkoutSession;
use Illuminate\Database\Seeder;

class GymMemberSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 10 member dummy
        GymMember::factory(10)->create()->each(function ($member) {
            // Setiap member punya 3-8 sesi workout
            WorkoutSession::factory(rand(3, 8))->create([
                'member_id' => $member->id,
            ]);
        });
    }
}