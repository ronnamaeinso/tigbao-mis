<?php

namespace App\Http\Controllers\Auth\AdminStaff;

use App\Http\Controllers\Controller;
use App\Models\SeniorCitizenRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SeniorCitizenRecordsController extends Controller
{
    public function index()
    {
        $search = urldecode(request('search'));

        $query = SeniorCitizenRecord::orderBy('created_at')->where('is_deceased', 0);

        if (! empty($search)) {
            $query->where('name', 'LIKE', "%$search%");
        }

        $data = $query->paginate(15)->withQueryString();

        foreach ($data as $item) {
            $item->did = Crypt::encrypt($item->id);
        }

        return view('pages.admin-staff.senior-citizen-records.index', ['data' => $data]);
    }

    public function create()
    {
        return view('pages.admin-staff.senior-citizen-records.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'bdate' => 'required',
        ], [
            'required' => 'This field is required.',
        ]);

        $create = SeniorCitizenRecord::create([
            'name' => $request->name,
            'bdate' => $request->bdate,
        ]);

        if (! $create) {
            return redirect()->back()->with('error', 'Server Error');
        }

        return redirect()->back()->with('success', 'Successfully Register Senior Citizen');
    }

    public function edit(string $id)
    {
        $d_id = Crypt::decrypt(urldecode($id));

        $row = SeniorCitizenRecord::findOrFail($d_id);

        return view('pages.admin-staff.senior-citizen-records.edit', [
            'id' => $id,
            'data' => $row,
        ]);
    }

    public function destroy($id)
    {
        $did = Crypt::decrypt(urldecode($id));

        $row = SeniorCitizenRecord::findOrFail($did);

        $status = $row->delete();

        if (! $status) {
            return response()->json([], 500);
        }

        return response()->json([], 200);
    }

    public function setAsDecease($id)
    {
        $did = Crypt::decrypt(urldecode($id));

        $row = SeniorCitizenRecord::findOrFail($did);

        $status = $row->update([
            'is_deceased' => 1,
        ]);

        if (! $status) {
            return response()->json([], 500);
        }

        return response()->json([], 200);
    }

    public function update(string $id, Request $request)
    {
        $did = Crypt::decrypt(urldecode($id));

        $request->validate([
            'name' => 'required',
            'bdate' => 'required',
        ]);

        $row = SeniorCitizenRecord::findOrFail($did);

        $status = $row->update([
            'name' => $request->name,
            'bdate' => $request->bdate,
        ]);

        if (! $status) {
            return redirect()->back()->with('error', 'Server Error');
        }

        return redirect()->back()->with('success', 'Successfully updated senior citizen');
    }

    public function openArchive()
    {

        $search = urldecode(request('search'));

        $query = SeniorCitizenRecord::orderBy('updated_at')->where('is_deceased', 1);

        if (! empty($search)) {
            $query->where('name', 'LIKE', "%$search%");
        }

        $data = $query->paginate(15)->withQueryString();

        foreach ($data as $item) {
            $item->did = Crypt::encrypt($item->id);
        }

        return view('pages.admin-staff.senior-citizen-records.archive', [
            'data' => $data
        ]);
    }
}
