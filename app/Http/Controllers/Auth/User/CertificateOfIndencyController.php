<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Models\CertificateOfIndigencyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateOfIndencyController extends Controller
{
    public function index()
    {
        $myrequests = CertificateOfIndigencyRequest::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('pages.user.certificate-of-indigency.index', compact('myrequests'));
    }

    public function create()
    {
        return view('pages.user.certificate-of-indigency.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
        ], [
            'required' => 'This Field is required.',
        ]);

        CertificateOfIndigencyRequest::create([
            'user_id' => Auth::user()->id,
            'fullname' => $request->fullname,
            'status' => 1,
        ]);

        return redirect()->route('request.certificate-of-indigency.index')->with('success', 'Successfully Requested Certificate of Indigency');
    }
}
