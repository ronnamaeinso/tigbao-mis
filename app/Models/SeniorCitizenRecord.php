<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeniorCitizenRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'bdate',
        'is_deceased',
        'date_deceased',
        'death_certificate',
    ];

    protected $casts = [
        'bdate'         => 'date',
        'date_deceased' => 'date',
        'is_deceased'   => 'boolean',
    ];
}
