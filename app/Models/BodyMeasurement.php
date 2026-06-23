<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyMeasurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'measurement_date',
        'weight_kg',
        'body_fat_percentage',
        'muscle_mass_kg',
        'chest_cm',
        'waist_cm',
        'arm_cm',
        'notes',
    ];

    protected $casts = [
        'measurement_date' => 'date',
        'weight_kg' => 'decimal:2',
        'body_fat_percentage' => 'decimal:2',
        'muscle_mass_kg' => 'decimal:2',
    ];

    public function member()
    {
        return $this->belongsTo(GymMember::class);
    }
}