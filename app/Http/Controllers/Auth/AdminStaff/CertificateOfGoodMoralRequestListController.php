<?php

namespace App\Http\Controllers\Auth\AdminStaff;

use App\Http\Controllers\Controller;
use App\Models\CertificateOfGoodMoralRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CertificateOfGoodMoralRequestListController extends Controller
{
    /**
     * index
     */
    public function index(): View
    {
        $search = urldecode(request('search'));
        $status = urldecode(request('status'));

        $data_query = CertificateOfGoodMoralRequest::orderBy('created_at')->whereNot('status', 3);

        if (!empty($search)) $data_query->where('name', 'LIKE', "%$search%");

        if (!empty($status)) $data_query->where('status', 'LIKE', "%$status%");

        $data = $data_query->paginate(15)->withQueryString();

        foreach ($data as $item) {
            $item->encrypted_id = Crypt::encrypt($item->id);
        }

        return view('pages.admin-staff.certificate-of-good-moral-request-list.index', [
            'data' => $data
        ]);
    }

    /**
     * update
     *
     * This will update the data dynamically , to centralized the resource for the route
     *
     * @param string $id
     * @param Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(string $id, Request $request)
    {
        $validation = $this->getValidationUpdate($request->type);

        $request->validate($validation['rules'], $validation['messages']);

        $decrypted_id = (int) Crypt::decrypt(urldecode($id));

        $status = match ($request->type) {
            'approve-request' => $this->approveRequest($decrypted_id),
            'reject-request' => $this->rejectRequest($decrypted_id, $request->comment),
            'generate-certificate' => $this->generateCertificate($decrypted_id),
            'set-paid' => $this->setPaid($decrypted_id),
            'issue-request' => $this->issueCertificate($decrypted_id),
        };

        if ($request->type == "generate-certificate") {

            if (!$status) return redirect()->back()->with('error', 'Failed to generate Certification');

            return redirect()->back()->with('success', "Successfully Generate Certificate");
        } else {

            if (!$status) return response()->json(null, 500);

            return response()->json(null, 200);
        }
    }

    /**
     * get validation per type
     */
    private function getValidationUpdate(string $type): array
    {
        $rules = [];
        $messages = [];

        switch ($type) {
            case 'approve-request':
                $rules = [
                    'type' => 'required',
                ];

                $messages = [
                    'required' => 'This field is required'
                ];
                break;
            case 'reject-request':
                $rules = [
                    'type' => 'required',
                    'comment' => 'required'
                ];

                $messages = [
                    'required' => 'This field is required'
                ];
                break;
            case 'issue-request':
                $rules = [
                    'type' => 'required',
                ];

                $messages = [
                    'required' => 'This field is required'
                ];
                break;
            case 'generate-certificate':
                $rules = [
                    'type' => 'required',
                ];

                $messages = [
                    'required' => 'This field is required'
                ];
                break;
            case 'set-paid':
                $rules = [
                    'type' => 'required',
                ];

                $messages = [
                    'required' => 'This field is required'
                ];
                break;
        }

        return [
            'rules' => $rules,
            'messages' => $messages
        ];
    }

    /**
     * approve request from the citizens/users
     *
     * Get the row with the id, then update and return result
     *
     * @param int
     * @return bool
     */
    private function approveRequest(int $id)
    {
        $row = CertificateOfGoodMoralRequest::findOrFail($id);

        return $row->update([
            'status' => 2
        ]);
    }

    /**
     * reject request from the citizens/users
     *
     * Get the row with the id, then update and return result
     *
     * @param int
     * @param string
     * @return bool
     */
    private function rejectRequest(int $id, string $comment)
    {

        $row = CertificateOfGoodMoralRequest::findOrFail($id);

        return $row->update([
            'status' => 3,
            'reject_remarks' => $comment
        ]);
    }

    /**
     * generate file for certificate of residency
     */
    private function generateCertificate($id)
    {
        $row = CertificateOfGoodMoralRequest::findOrFail($id);
        return $row->update([
            'status' => 4
        ]);
    }

    /**
     *
     * set paid
     */
    private function setPaid($id)
    {
        $row = CertificateOfGoodMoralRequest::findOrFail($id);
        return $row->update([
            'status' => 5
        ]);
    }

    /**
     * issue certificate
     */
    private function issueCertificate($id)
    {
        $row = CertificateOfGoodMoralRequest::findOrFail($id);
        return $row->update([
            'status' => 6
        ]);
    }
}
