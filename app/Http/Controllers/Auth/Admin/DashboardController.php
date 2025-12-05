<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index() {
        try {
            // return view
            // return view('pages.admin.dashboard.index');
        } catch (\Throwable $th) {
            /**
             * log error
             * abort 500
             */
            Log::error($th->getMessage());
            abort(500);
        }
    }
}
