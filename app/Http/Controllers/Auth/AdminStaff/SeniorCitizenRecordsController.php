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

<<<<<<< HEAD
        $query = SeniorCitizenRecord::orderBy('created_at')->where('is_deceased', 0);

        if (! empty($search)) {
            $query->where('name', 'LIKE', "%$search%");
=======
        $query = SeniorCitizenRecord::orderBy('created_at', 'desc')
            ->where('is_deceased', 0);

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'LIKE', "%$search%")
                  ->orWhere('middle_name', 'LIKE', "%$search%")
                  ->orWhere('last_name', 'LIKE', "%$search%");
            });
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
        }

        $data = $query->paginate(15)->withQueryString();

        foreach ($data as $item) {
            $item->did = Crypt::encrypt($item->id);
        }

<<<<<<< HEAD
        return view('pages.admin-staff.senior-citizen-records.index', ['data' => $data]);
=======
        return view('pages.admin-staff.senior-citizen-records.index', compact('data'));
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
    }

    public function create()
    {
        return view('pages.admin-staff.senior-citizen-records.create');
    }

    public function store(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
            'name' => 'required',
            'bdate' => 'required',
=======
            'first_name'  => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name'   => 'required|string|max:255',
            'gender'      => 'required|string',
            'bdate'       => 'required|date',
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
        ], [
            'required' => 'This field is required.',
        ]);

<<<<<<< HEAD
        $create = SeniorCitizenRecord::create([
            'name' => $request->name,
            'bdate' => $request->bdate,
        ]);

        if (! $create) {
            return redirect()->back()->with('error', 'Server Error');
        }

        return redirect()->back()->with('success', 'Successfully Register Senior Citizen');
=======
        $created = SeniorCitizenRecord::create([
            'first_name'  => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name'   => $request->last_name,
            'gender'      => $request->gender,
            'bdate'       => $request->bdate,
            'is_deceased' => 0,
        ]);

        if (!$created) {
            return redirect()->back()->with('error', 'Server Error');
        }

        return redirect()->route('senior-citizen.records.index')
            ->with('success', 'Successfully registered senior citizen');
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
    }

    public function edit(string $id)
    {
        $d_id = Crypt::decrypt(urldecode($id));
<<<<<<< HEAD

        $row = SeniorCitizenRecord::findOrFail($d_id);

        return view('pages.admin-staff.senior-citizen-records.edit', [
            'id' => $id,
=======
        $row = SeniorCitizenRecord::findOrFail($d_id);

        return view('pages.admin-staff.senior-citizen-records.edit', [
            'id'   => $id,
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
            'data' => $row,
        ]);
    }

<<<<<<< HEAD
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

=======
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
    public function update(string $id, Request $request)
    {
        $did = Crypt::decrypt(urldecode($id));

        $request->validate([
<<<<<<< HEAD
            'name' => 'required',
            'bdate' => 'required',
=======
            'first_name'       => 'required|string|max:255',
            'middle_name'      => 'nullable|string|max:255',
            'last_name'        => 'required|string|max:255',
            'gender'           => 'required|string',
            'bdate'            => 'required|date',
            'death_certificate'=> 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
        ]);

        $row = SeniorCitizenRecord::findOrFail($did);

<<<<<<< HEAD
        $status = $row->update([
            'name' => $request->name,
            'bdate' => $request->bdate,
        ]);

        if (! $status) {
            return redirect()->back()->with('error', 'Server Error');
        }

        return redirect()->back()->with('success', 'Successfully updated senior citizen');
=======
        $dataToUpdate = [
            'first_name'  => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name'   => $request->last_name,
            'gender'      => $request->gender,
            'bdate'       => $request->bdate,
        ];

        if ($request->hasFile('death_certificate')) {
            $path = $request->file('death_certificate')->store('death_certificates', 'public');
            $dataToUpdate['death_certificate'] = $path;
        }

        $status = $row->update($dataToUpdate);

        if (!$status) {
            return redirect()->back()->with('error', 'Server Error');
        }

        return redirect()->route('senior-citizen.records.index')
            ->with('success', 'Successfully updated senior citizen');
    }

    public function destroy(string $id)
    {
        $did = Crypt::decrypt(urldecode($id));
        $row = SeniorCitizenRecord::findOrFail($did);

        $status = $row->delete();

        if (!$status) {
            return response()->json([], 500);
        }

        return response()->json([], 200);
    }

    // SET AS DECEASED (AJAX)
    public function setAsDecease(Request $request, string $id)
    {
        $did = Crypt::decrypt(urldecode($id));
        $row = SeniorCitizenRecord::findOrFail($did);

        $request->validate([
            'date_deceased'     => 'required|date',
            'death_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('death_certificate')) {
            $path = $request->file('death_certificate')->store('death_certificates', 'public');
            $row->death_certificate = $path;
        }

        $row->is_deceased   = 1;
        $row->date_deceased = $request->date_deceased;
        $row->save();

        return response()->json(['success' => true], 200);
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
    }

    public function openArchive()
    {
<<<<<<< HEAD

        $search = urldecode(request('search'));

        $query = SeniorCitizenRecord::orderBy('updated_at')->where('is_deceased', 1);

        if (! empty($search)) {
            $query->where('name', 'LIKE', "%$search%");
=======
        $search = urldecode(request('search'));

        $query = SeniorCitizenRecord::where('is_deceased', 1)
            ->orderBy('updated_at', 'desc');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'LIKE', "%$search%")
                  ->orWhere('middle_name', 'LIKE', "%$search%")
                  ->orWhere('last_name', 'LIKE', "%$search%");
            });
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
        }

        $data = $query->paginate(15)->withQueryString();

        foreach ($data as $item) {
            $item->did = Crypt::encrypt($item->id);
        }

<<<<<<< HEAD
        return view('pages.admin-staff.senior-citizen-records.archive', [
            'data' => $data
        ]);
=======
        return view('pages.admin-staff.senior-citizen-records.archive', compact('data'));
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
    }
}
