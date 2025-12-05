<?php

namespace App\Http\Controllers\Auth\AdminStaff;

use App\Http\Controllers\Controller;
use App\Models\CertificateOfIndigencyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateOfIndigencyRequestsController extends Controller
{
    public function index()
    {
        $requestList = CertificateOfIndigencyRequest::whereNot('status', 3)->orderBy('created_at')->paginate(10);

        foreach ($requestList as $item) {
            $item->encrypted_id = Crypt::encrypt($item->id);
        }

        return view('pages.admin-staff.certificate-of-indigency-requests.index', [
            'data' => $requestList,
        ]);
    }

    /**
     * approve request
     */
    public function approveRequest(string $id)
    {
        $did = Crypt::decrypt(urldecode($id));

        $row = CertificateOfIndigencyRequest::findOrFail($did);

        $status = $row->update([
            'status' => 2,
        ]);

        if (! $status) {
            return response(null, 500);
        }

        return response(null, 200);
    }

    /**
     * reject request
     */
    public function rejectRequest(string $id, Request $request)
    {

        $did = Crypt::decrypt(urldecode($id));

        $row = CertificateOfIndigencyRequest::findOrFail($did);

        $status = $row->update([
            'status' => 3,
            'reject_comment' => $request->comment,
        ]);

        if (! $status) {
            return response(null, 500);
        }

        return response(null, 200);
    }
    /**
     * issue request
     */
    public function issueCert(string $id, Request $request)
    {

        $did = Crypt::decrypt(urldecode($id));

        $row = CertificateOfIndigencyRequest::findOrFail($did);

        $status = $row->update([
            'status' => 4
        ]);

        if (! $status) {
            return response(null, 500);
        }

        return response(null, 200);
    }

    /**
     * generate cert
     */
    public function generateCert(string $id)
    {
        $did = Crypt::decrypt(urldecode($id));

        $row = CertificateOfIndigencyRequest::findOrFail($did);

        return Pdf::loadView('pages.document-layouts.certificate-of-indigency', ['data' => $row])
        ->setPaper('letter')->stream('indigency.pdf');
    }
}
