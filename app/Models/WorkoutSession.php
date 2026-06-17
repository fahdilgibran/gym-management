<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutSession extends Model
{
    use HasFactory;

    protected $table = 'workout_sessions';

    protected $fillable = [
        'member_id',
        'session_date',
        'trainer_name',
        'session_type',
        'duration_minutes',
        'calories_burned',
        'exercises_done',
        'weight_kg',
        'notes',
        'rating',
    ];

    protected $casts = [
        'session_date' => 'date',
        'weight_kg' => 'decimal:2',
        'rating' => 'integer',
    ];

    // Relationship
    public function member()
    {
        return $this->belongsTo(GymMember::class, 'member_id');
    }
}