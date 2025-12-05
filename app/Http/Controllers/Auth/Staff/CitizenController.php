<?php

namespace App\Http\Controllers\Auth\Staff;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use App\Services\HelperService;

class CitizenController extends Controller
{
    // index
    public function index()
    {
        try {
            // get all registered citizens
            $citizens = User::getRows(['id', 'name', 'role', 'email', 'created_at', 'account_verified'], ['account_verified' => '1'])
                ->whereNot('role', 1)
                ->whereNot('role', 2)
                ->paginate(15);

            // return view
            return view('pages.staff.citizen.index', [
                'citizens' => $citizens
            ]);
        } catch (\Throwable $th) {
            /**
             * log error
             * abort 500
             */
            Log::error($th->getMessage());
            abort(500);
        }
    }

    // show
    public function show($id, HelperService $helperService)
    {
        try {
            // decrypt id
            $decrypted_id = Crypt::decrypt($id);

            // get citizen
            $citizen = User::getRows(
                [
                    'users.name',
                    'users.email',
                    'users.created_at',
                    'ui.bdate',
                    'ui.bplace',
                    'ui.id_type',
                    'ui.id_picture',
                    'ui.contact_number',
                    'ui.sex',
                    'ui.address',
                ],
                [
                    'users.id' => $decrypted_id
                ]
            )
                ->join('user_informations as ui', 'users.id', '=', 'ui.user_id')
                ->get();

            // format id
            $citizen[0]->formated_id = $helperService->getIdType($citizen[0]->id_type);

            // return view
            return view('pages.staff.citizen.show', [
                'citizen' => $citizen[0]
            ]);
        } catch (\Throwable $th) {
            /**
             * log error
             * abort 500
             */
            dd($th->getMessage());
            Log::error($th->getMessage());
            abort(500);
        }
    }
}
