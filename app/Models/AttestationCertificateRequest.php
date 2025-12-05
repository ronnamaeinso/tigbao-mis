<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttestationCertificateRequest extends Model
{
    use SoftDeletes;

    // fillables
    /**
     * @status
     * 1 for submitted
     * 2 for approved
     * 3 for rejected
     * 4 for generated ready for pick up
     */
    protected $fillable = [
        'user_id',
        'work',
        'monthly_earning',
        'type',
        'status',
        'reject_comment',
    ];

    // get row/s
    public function scopeGetRows($query, array $selects= [], array $wheres =  []) {
        try {
            return $query->select($selects)
                ->where($wheres);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    // update row
    public static function udpateRow(int $id, array $data) : bool {
        try {
            // get row
            $item = self::findOrFail($id);

            // update row and return result
            return $item->update($data);

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

