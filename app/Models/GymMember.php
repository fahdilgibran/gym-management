<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymMember extends Model
{
    use HasFactory;

    protected $table = 'gym_members';

    protected $fillable = [
        'member_code',
        'name',
        'email',
        'phone',
        'birth_date',
        'gender',
        'membership_type',
        'start_date',
        'expire_date',
        'emergency_contact',
        'photo',
        'status',
        'membership_status'
    ];

    protected $casts = [
        'birth_date'  => 'date',
        'start_date'  => 'date',
        'expire_date' => 'date',
    ];

    // Relationship
    public function workoutSessions()
    {
        return $this->hasMany(WorkoutSession::class, 'member_id');
    }

    public function bodyMeasurements()
    {
        return $this->hasMany(BodyMeasurement::class, 'member_id');
    }

    public function nutritionLogs()
    {
        return $this->hasMany(NutritionLog::class, 'member_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Accessor untuk mengambil phone dari User jika kosong di gym_members
    public function getPhoneAttribute($value)
    {
        if ($value) {
            return $value;
        }
        return $this->user?->phone ?? '-';
    }
}