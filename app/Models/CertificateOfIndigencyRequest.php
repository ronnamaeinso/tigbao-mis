<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateOfIndigencyRequest extends Model
{
    protected $fillable = [
        'fullname',
        'user_id',
        'status',
        'reject_comment'
    ];
}
