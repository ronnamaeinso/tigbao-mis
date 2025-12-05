<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    // table name
    protected $table = 'user_informations';

    /**
     * fillable columns
     *
     * 1  - National ID
     * 2  - Driver's License
     * 3  - Passport
     * 4  - Voter's ID
     * 5  - PRC ID
     * 6  - Postal ID
     * 7  - UMID
     * 8  - Student ID
     * 9  - Employee ID
     * 10 - SSS ID
     * 11 - PhilHealth ID
     * 12 - Pag-Ibig ID
     */
    protected $fillable = [
        'user_id',
        'fname',
        'mname',
        'lname',
        'bdate',
        'bplace',
        'id_type',
        'id_picture',
        'contact_number',
        'sex',
        'address',
    ];

    // cast
    protected $casts = [
        'bdate' => 'date',
    ];
}
