<?php

namespace App\Http\Controllers\Auth\AdminStaff;

use App\Http\Controllers\Controller;
use App\Models\AttestationCertificateRequest;
use App\Models\Summon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CertificateOfIndigencyRequest;
use App\Models\CertificateOfResidencyRequest;
use App\Models\BarangayClearanceBuildingPermitRequest;
use App\Models\CertificateOfGoodMoralRequest;
use App\Models\AnimalTransportationClearanceRequest;
use App\Models\SeniorCitizenRecord;

class DashboardController extends Controller
{
    /**
     * return dashboard
     *
     * get all the statistics of the users, citizens, staffs, pending account verifications
     *
     * @return Illuminate\Contracts\View\View
     */
    public function index()
    {
        $total_users = User::where('account_verified', '1')->get()->count();

        $total_staffs = User::where('account_verified', '1')->where('role', 2)->get()->count();

        $total_citizens = User::where('account_verified', '1')->where('role', 3)->get()->count();

        $total_pending_accounts = User::where('account_verified', '0')->get()->count();

        $total_pending_attestation_certificate_requests = AttestationCertificateRequest::get()->count();

        $total_pending_summon_requests = Summon::get()->count();

        $total_indigency = CertificateOfIndigencyRequest::get()->count();

        $total_residency_cert= CertificateOfResidencyRequest::get()->count();

        $total_building_clearance = BarangayClearanceBuildingPermitRequest::get()->count();

        $total_good_moral = CertificateOfGoodMoralRequest::get()->count();

        $total_animal = AnimalTransportationClearanceRequest::get()->count();

        $total_senior = SeniorCitizenRecord::where('is_deceased', 0)->get()->count();

        return view('pages.admin-staff.dashboard.index', [
            'total_users' => $total_users,
            'total_staffs' => $total_staffs,
            'total_citizens' => $total_citizens,
            'total_pending_accounts' => $total_pending_accounts,
            'total_pending_attestation_certificate_requests' => $total_pending_attestation_certificate_requests,
            'total_pending_summon_requests' => $total_pending_summon_requests,

            'total_indigency' => $total_indigency,
            'total_residency_cert' => $total_residency_cert,
            'total_building_clearance' => $total_building_clearance,
            'total_good_moral' => $total_good_moral,
            'total_animal' => $total_animal,
            'total_senior' => $total_senior,
        ]);
    }

    public function getChartData(Request $request)
    {
        $year = $request->year ?? now()->year;

        // -----------------------------------
        // Attestation Certificate Requests
        // -----------------------------------
        $query_current_attestation_certificate_per_month = AttestationCertificateRequest::where('status', 4)
            ->select([
                DB::raw('MONTH(updated_at) as month'),
                DB::raw('COUNT(*) as total')
            ])
            ->orderBy(DB::raw('MONTH(updated_at)'));

        if (!empty($year)) {
            $query_current_attestation_certificate_per_month->whereYear('updated_at', $year);
        }

        $attestation_certificate_request_per_months = $query_current_attestation_certificate_per_month
            ->groupBy(DB::raw('MONTH(updated_at)'))
            ->pluck('total', 'month');

        // Fill missing months (Jan–Dec) with 0
        $attestation_certificate_request_per_months = collect(range(1, 12))
            ->map(fn($m) => $attestation_certificate_request_per_months[$m] ?? 0)
            ->values();

        // -----------------------------------
        // Summons Requests
        // -----------------------------------
        $query_summons = Summon::where('status', 5)
            ->select([
                DB::raw('MONTH(updated_at) as month'),
                DB::raw('COUNT(*) as total')
            ])
            ->orderBy(DB::raw('MONTH(updated_at)'));

        if (!empty($year)) {
            $query_summons->whereYear('updated_at', $year);
        }

        $summons_per_month = $query_summons
            ->groupBy(DB::raw('MONTH(updated_at)'))
            ->pluck('total', 'month');

        // Fill missing months (Jan–Dec) with 0
        $summons_per_month = collect(range(1, 12))
            ->map(fn($m) => $summons_per_month[$m] ?? 0)
            ->values();

        // -----------------------------------
        // Return JSON
        // -----------------------------------
        return response()->json([
            'attestation_certificate_request_per_months' => $attestation_certificate_request_per_months,
            'summons_per_month' => $summons_per_month
        ]);
    }
}
