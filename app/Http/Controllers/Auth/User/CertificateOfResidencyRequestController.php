<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Models\CertificateOfIndigencyRequest;
use App\Models\CertificateOfResidencyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CertificateOfResidencyRequestController extends Controller
{
    /**
     * index
     */
    public function index()
    {
        $myRequests = CertificateOfResidencyRequest::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        foreach ($myRequests as $item) {
            $item->encrypted_id = Crypt::encrypt($item->id);
        }

        return view('pages.user.certificate-of-residency.index', [
            'myRequests' => $myRequests
        ]);
    }

    /**
     * create
     */
    public function create()
    {
        return view('pages.user.certificate-of-residency.create');
    }

    /**
     * store
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required']
        ]);

        CertificateOfResidencyRequest::create([
            'user_id' => Auth::user()->id,
            'requestor_name' => $request->name,
            'status' => 1
        ]);

        return redirect()->route('certificate-of-residency-request.index')->with('success', 'Successfully Requested Certificate of Residency');
    }

    /**
     * track status of the request
     */
    public function trackRequest(string $id)
    {
        $decrypted_id = Crypt::decrypt(urldecode($id));

        $request = CertificateOfResidencyRequest::findOrFail($decrypted_id);

        $statusLayers = CertificateOfResidencyRequest::getStatusLayers($request->status);

        return view('pages.user.certificate-of-residency.track-request-status', [
            'statusLayers' => $statusLayers
        ]);
    }
}
