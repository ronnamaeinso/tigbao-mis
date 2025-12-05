<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Models\CertificateOfGoodMoralRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CertificateOfGoodMoralRequestController extends Controller
{
    public function index(): View
    {
        $status = urldecode(request('status'));

        $query = CertificateOfGoodMoralRequest::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id);

        if(!empty($status)) $query->where('status', $status);

        $myRequests = $query->paginate(15)->withQueryString();

        foreach ($myRequests as $item) {
            $item->encrypted_id = Crypt::encrypt($item->id);
        }

        return view('pages.user.certificate-of-good-moral-request.index', [
            'myRequests' => $myRequests
        ]);
    }

    /**
     * create
     */
    public function create(): View
    {
        return view('pages.user.certificate-of-good-moral-request.create');
    }

    /**
     * store
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required'
        ], [
            'required' => 'This field is required.'
        ]);

        CertificateOfGoodMoralRequest::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name
        ]);

        return redirect()->route('certificate-of-good-moral.request.index')->with('success', 'Successfully Requested Certiicate of Good Moral');
    }
}
