<?php

namespace App\Services;

class HelperService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * get id type
     * with int type
     * return string
     */
    public function getIdType(int $type) : string {
        $id = ''; // init var

        // switch
        switch ($type) {
            case 1:
                $id = 'National ID';
                break;

            default:
                $id = 'Other';
                break;
        }

        return $id; // return id
    }
}
