<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeniorCitizenRecord extends Model
{
    protected $fillable = [
        'name',
        'bdate',
        'is_deceased'
    ];
}
