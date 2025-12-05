<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
use Illuminate\Database\Eloquent\Model;

class SeniorCitizenRecord extends Model
{
<<<<<<< HEAD
    protected $fillable = [
        'name',
        'bdate',
        'is_deceased'
=======
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
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
    ];
}
