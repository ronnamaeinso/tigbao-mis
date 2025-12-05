<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangayClearanceBuildingPermitRequest extends Model
{
    // fillable
    protected $fillable = [
        'user_id',
        'status',
        'name',
        'reject_remarks'
    ];

    /**
     * get status layers
     */
    public static function getStatusLayers(int $status): array
    {
        $return = [];

        switch ($status) {
            case 1:
                $return = [
                    'Pending' => 'on',
                    'Approved - Processing' => 'off',
                    'File Generate' => 'off',
                    'Paid' => 'off',
                    'Ready To Claim' => 'off'
                ];
                break;
            case 2:
                $return = [
                    'Pending' => 'on',
                    'Approved - Processing' => 'on',
                    'File Generate' => 'off',
                    'Paid' => 'off',
                    'Ready To Claim' => 'off',
                ];

                break;
            case 3:
                $return = [
                    'Pending' => 'on',
                    'Rejected' => 'on',
                    'Paid' => 'off',
                    'File Generate' => 'off',
                    'Ready To Claim' => 'off'
                ];

                break;
            case 4:
                $return = [
                    'Pending' => 'on',
                    'Approved - Processing' => 'on',
                    'File Generate' => 'on',
                    'Paid' => 'on',
                    'Ready To Claim' => 'off'
                ];

                break;
            case 5:
                $return = [
                    'Pending' => 'on',
                    'Approved - Processing' => 'on',
                    'File Generate' => 'on',
                    'Paid' => 'on',
                    'Ready To Claim' => 'off'
                ];

                break;
            case 6:
                $return = [
                    'Pending' => 'on',
                    'Approved - Processing' => 'on',
                    'File Generate' => 'on',
                    'Paid' => 'on',
                    'Ready To Claim' => 'on'
                ];

                break;
        }

        return $return;
    }
}
