<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Models\BarangayClearanceBuildingPermitRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class BarangayClearanceBuildingPermitRequestController extends Controller
{
    /**
     * index
     */
    public function index(): View
    {
        $status = urldecode(request('status'));

        $query = BarangayClearanceBuildingPermitRequest::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id);

        if(!empty($status)) $query->where('status', $status);

        $data = $query->paginate(15);

        foreach ($data as $item) {
            $item->encrypted_id = Crypt::encrypt($item->id);
        }

        return view('pages.user.barangay-clearance-building-permit-request.index', ['data' => $data]);
    }

    /**
     * create
     */
    public function create(): View
    {
        return view('pages.user.barangay-clearance-building-permit-request.create');
    }

    /**
     * store
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        BarangayClearanceBuildingPermitRequest::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name
        ]);

        return redirect()->route('barangay-clearance.building-permit.request.index')->with('success', 'Successfully Requested for Barangay Clearance - Building Permit');
    }
}
