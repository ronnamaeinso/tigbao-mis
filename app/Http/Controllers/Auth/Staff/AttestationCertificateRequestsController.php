<?php

namespace App\Http\Controllers\Auth\Staff;

use App\Http\Controllers\Controller;
use App\Models\AttestationCertificateRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class AttestationCertificateRequestsController extends Controller
{
    // index
    public function index(Request $request)
    {
        try {
            // search input
            $search = $request->input('search');

            // get rows
            $attestation_certificate_requests = AttestationCertificateRequest::getRows(
                [
                    'u.name',
                    'attestation_certificate_requests.id',
                    'attestation_certificate_requests.work',
                    'attestation_certificate_requests.monthly_earning',
                    'attestation_certificate_requests.type',
                    'attestation_certificate_requests.status',
                    'attestation_certificate_requests.created_at'
                ],
            )
                ->whereNot('attestation_certificate_requests.status', 3)
                ->when($search, function ($query, $search) {
                    $trim_search = trim($search);
                    return $query->where('u.name', 'LIKE', "%$trim_search%");
                })
                ->join('users as u', 'attestation_certificate_requests.user_id', '=', 'u.id')
                ->paginate(15)
                ->appends(['search' => $search]);

            // encrypt id
            foreach ($attestation_certificate_requests as $item) {
                $item->encrypted_id = Crypt::encrypt($item->id);
            }

            // return views
            return view('pages.staff.attestation-certificate-requests.index', [
                'attestation_certificate_requests' => $attestation_certificate_requests
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

    // approve request
    public function approveRequest($id)
    {
        try {
            // decrypt id
            $decrypted_id = Crypt::decrypt(urldecode($id));

            // update row
            $update_status = AttestationCertificateRequest::udpateRow((int) $decrypted_id, ['status' => 2]);

            // throw new Exception if fails to update row
            throw_if(!$update_status, Exception::class, 'Failed to approve request');

            // return response 200
            return response(null, 200);
        } catch (\Throwable $th) {
            /**
             * log error
             * response 500
             */
            Log::error($th->getMessage());
            return response(null, 500);
        }
    }

    // reject request
    public function rejectRequest(Request $request, $id)
    {
        try {
            // decrypt id
            $decrypted_id = Crypt::decrypt(urldecode($id));

            // validate
            $request->validate([
                'reject_comment' => 'required'
            ]);

            // update row
            $update_status = AttestationCertificateRequest::udpateRow((int) $decrypted_id, ['status' => 3, 'reject_comment' => $request->reject_comment]);

            // throw new Exception if fails to update row
            throw_if(!$update_status, Exception::class, 'Failed to reject request');

            // return response 200
            return response(null, 200);
        } catch (\Throwable $th) {
            /**
             * log error
             * response 500
             */
            Log::error($th->getMessage());
            return response(null, 500);
        }
    }

    // generate certificate of attestation
    public function generateAttestationCertificate($id)
    {
        try {
            // decrypt id
            $decrypted_id = Crypt::decrypt(urldecode($id));

            //get Item
            $item = AttestationCertificateRequest::getRows(
                [
                    'attestation_certificate_requests.id',
                    'attestation_certificate_requests.work',
                    'attestation_certificate_requests.monthly_earning',
                    'attestation_certificate_requests.updated_at',
                    'attestation_certificate_requests.status',
                    'u.name',
                    'ui.bdate',
                    'ui.address',
                ],
                [
                    'attestation_certificate_requests.id' => $decrypted_id
                ]
            )
                ->join('users as u', 'u.id', '=', 'attestation_certificate_requests.user_id')
                ->join('user_informations as ui', 'ui.user_id', '=', 'attestation_certificate_requests.user_id')
                ->get();

            // load view pdf
            $pdf = Pdf::loadView('pages.document-layouts.attestation-certificate', ['item' => $item[0]]);

            // return pdf
            return $pdf->setPaper('a4 portrait')->stream('attestation-certificate.pdf');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            abort(500);
        }
    }

    // issue certificate
    public function issueAttestationCertificate($id)
    {
        try {
            // decode id
            $decrypted_id = Crypt::decrypt(urldecode($id));

            // update status
            $update_status = AttestationCertificateRequest::udpateRow((int)$decrypted_id, ['status' => 4]);

            // throw new Exception
            throw_if(!$update_status, Exception::class, 'Fails to issue certificate');

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
