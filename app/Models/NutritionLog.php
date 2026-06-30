<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'log_date',
        'calories_intake',
        'protein_grams',
        'carbs_grams',
        'fats_grams',
        'meals_description',
        'notes',
    ];

    protected $casts = [
        'log_date' => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(GymMember::class, 'member_id');
    }
}