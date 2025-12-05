<?php

namespace App\Http\Controllers\Auth\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    // index
    public function index() {
        try {
            return view('pages.staff.dashboard.index');
        } catch (\Throwable $th) {
            /**
             * log error
             * abort 500
             */
            dd($th->getMessage());
            Log::error($th->getMessage());
            return abort(500);
        }
    }
}
