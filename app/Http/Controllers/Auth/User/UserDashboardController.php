<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Models\AttestationCertificateRequest;
use App\Models\Summon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Announcement;

class UserDashboardController extends Controller
{
    public function index() {
        $total_attestation_cert_requests = AttestationCertificateRequest::where('user_id', Auth::user()->id)->get()->count();
        $total_summons = Summon::where('user_id', Auth::user()->id)->get()->count();
        $total_requests = $total_attestation_cert_requests + $total_summons;

        $limit = empty(urldecode(request('limit'))) ? 3 : urldecode(request('limit'));

        $announcements = Announcement::orderBy('created_at', 'desc')->limit($limit)->get();

        return view('pages.user.dashboard.index', [
            'total_attestation_cert_requests' => $total_attestation_cert_requests,
            'total_summons' => $total_summons,
            'total_requests' => $total_requests,
            'announcements' => $announcements,
            'limit' => $limit
        ]);
    }
}
