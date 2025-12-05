<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Models\AttestationCertificateRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RequestDocumentAttestationCertController extends Controller
{
    // index
    public function index()
    {
        try {
            // get my request
            $myrequests = AttestationCertificateRequest::where('user_id', Auth::user()->id)
                ->orderBy('created_at', 'asc')
                ->paginate(15);

            // return view
            return view('pages.user.certificate-of-attestation.index', [
                'myrequests' => $myrequests
            ]);
        } catch (\Throwable $th) {
            /**
             * log error
             *abprt 500
             */
            dd($th->getMessage());
            Log::error($th->getMessage());
            abort(500);
        }
    }

    // create
    public function create()
    {
        try {
            return view('pages.user.certificate-of-attestation.create');
        } catch (\Throwable $th) {
            /**
             * log error
             *abprt 500
             */
            Log::error($th->getMessage());
            abort(500);
        }
    }

    // store
    public function store(Request $request)
    {
        try {
            // validate
            $request->validate([
                'work',
                'monthly_earning'
            ]);

            // insert data
            $create_status = AttestationCertificateRequest::create(
                [
                    'user_id' => Auth::user()->id,
                    'work' => $request->work,
                    'monthly_earning' => $request->monthly_earning,
                    'type' => 1,
                    'status' => 1
                ]
            );

            // throw new Exception if fails to insert new data
            throw_if(!$create_status, Exception::class, 'Failed to insert data into table');

            // response 200
            return response(null, 200);
        } catch (\Throwable $th) {
            /**
             * log error
             * response 500
             */
            dd($th->getMessage());
            Log::error($th->getMessage());
            return response(null, 500);
        }
    }
}
