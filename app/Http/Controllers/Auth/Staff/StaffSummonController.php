<?php

namespace App\Http\Controllers\Auth\Staff;

use App\Http\Controllers\Controller;
use App\Models\Summon;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Controller for Staff - Summon Request from citizen
 *
 * Handle Summon request from citizens
 * Approve the request
 * Reject the request
 * Generate Form for summone issuance
 * And Issue Summon
 */
class StaffSummonController extends Controller
{
    /**
     * View Summon request of the citizens
     *
     * Get all summon request from the citizen,
     * loop each row and add encrypted_id,
     * then return view with data
     *
     * @return Illuminate\View\View Return index view of the summon request of the citizen
     */
    public function index()
    {
        $data = Summon::whereNot('status', 3)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        foreach ($data as $item) {
            $item->encrypted_id = Crypt::encrypt($item->id);
        }

        return view('pages.staff.summons.index', [
            'data' => $data
        ]);
    }

    /**
     * View Specific summon request from the user
     *
     * Decrypt id  from query param , find the row and return view show blade
     *
     * @param string $id This is the encrypted id from query
     * @return Illuminate\View\View This return sa show blade
     */
    public function show(string $id)
    {
        $decrypted_id = Crypt::decrypt(urldecode($id));

        $item = Summon::findOrFail($decrypted_id);

        $item->encypted_id = urldecode($id);

        return view('pages.staff.summons.show', [
            'data' => $item
        ]);
    }

    /**
     * Approve A Summon Request
     *
     * Decrypt id from the query, update row status, if failed to update then return a response 500, else response 200.
     *
     * @param string $id This is the encrypted id from query
     * @param return Illuminate\Http\Response Returns 200 response
     */
    public function approveSummonRequest($id)
    {
        $decrypted_id = (int) Crypt::decrypt(urldecode($id));

        $status = Summon::updateRow($decrypted_id, [
            'status' => 2
        ]);

        if (!$status) {
            Log::error('Failed to approve summon request');
            return response(null, 500);
        }

        return response(null, 200);
    }

    /**
     * Reject A Summon request
     *
     * Decrypt id from query, validate request payload from the user,
     * get row and update its status into 3 for rejected, return response 200 if success else 500
     *
     * @param Illuminate\Http\Request $request This is the request holding the reject comments
     * @return Illuminate\Http\Response Returns response 200 if success else 500
     */
    public function rejectSummonRequest(Request $request, string $id)
    {
        $decrypted_id = Crypt::decrypt(urldecode($id));

        $request->validate([
            'comments' => 'required'
        ], [
            'required' => 'Comments is required if no comment, put n/a or N/A'
        ]);

        $row = Summon::findOrFail($decrypted_id);

        $update_status = $row->update(['status' => 3, 'reject_comment' => $request->comments]);

        if (!$update_status) {
            Log::error("Failed to update row for reject.");
            return response(null, 500);
        }

        return response(null, 200);
    }

    /**
     * Generate Summon pdf
     *
     * Decrypt id from param, update status intpo 4 for status generated summon,
     * get row and render pdf for summon with data row.
     *
     * @param string $id The encrypted id from uri query
     * @return Illuminate\Http\Response This is the response 500 if update fails
     * @return Barryvdh\DomPDF\Facade\Pdf This is the summon pdf.
     */
    public function generateSummonRequest(string $id)
    {
        $decrypted_id = (int) Crypt::decrypt(urldecode($id));

        $update_status = Summon::updateRow($decrypted_id, ['status' => 4, 'generated_at' => now()]);

        if (!$update_status) {
            Log::error('Failed to update row for generated_at col in tbl summons');
            return response(null, 500);
        }

        $data = Summon::findOrFail($decrypted_id);

        $data->date = Carbon::now();

        return Pdf::loadView('pages.document-layouts.summons', [
            'data' => $data
        ])
            ->stream('KP Form No. 9 Summon.pdf');
    }

    /**
     * View Generated PDF Summon
     *
     * Decrypt id from uri query, get row, set date key for the pdf to render
     * and return pdf load view with the row
     *
     * @param string $id The encrypted id from the uri query.
     * @return Barryvdh\DomPDF\Facade\Pdf Return pdf view.
     */
    public function viewSummon(string $id)
    {
        $decrypted_id = Crypt::decrypt(urldecode($id));

        $item = Summon::findOrFail($decrypted_id);

        $item->date = Carbon::parse($item->generated_at);

        return Pdf::loadView('pages.document-layouts.summons', [
            'data' => $item
        ])
            ->stream('KP Form No. 9 Summon.pdf');
    }

    /**
     * Issue summon for it to be pick up by citizen
     *
     * Decrypt id from uri query id, update status into 5 - Ready for pick up,
     * if update fails log error and return response 500
     * Else response 200
     *
     * @param string $id - Encrypted id from uri query.
     * @return Illuminate\Http\Response Return 500 if update fails else 200
     */
    public function issueSummon(string $id)
    {
        $decrypted_id = Crypt::decrypt(urldecode($id));

        $update_status = Summon::updateRow($decrypted_id, ['status' => 5]);

        if (!$update_status) {
            Log::error("Fails to update status into 5 - Issued - ready for pick up");
            return response(null, 500);
        }

        return response(null, 200);
    }
}
