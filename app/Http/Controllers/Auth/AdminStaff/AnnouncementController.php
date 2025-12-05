<?php

namespace App\Http\Controllers\Auth\AdminStaff;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AnnouncementController extends Controller
{
    public function index()
    {
        $date = urldecode(request('created_at'));
        $search = urldecode(request('search'));
        $title = urldecode(request('title'));

        if (! empty($date)) {
            $query = Announcement::orderBy('created_at', $date);
        } else {
            $query = Announcement::orderBy('created_at');
        }

        if (! empty($search)) {
            $query->where('title', 'LIKE', "%$title%");
        }

        if (! empty($title)) {
            $query->orderBy('title', $title);
        }

        $data = $query->paginate(15)->withQueryString();

        foreach ($data as $item) {
            $item->encrypted_id = Crypt::encrypt($item->id);
        }

        return view('pages.admin-staff.announcements.index', ['data' => $data]);
    }

    public function create()
    {
        return view('pages.admin-staff.announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $create = Announcement::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if (! $create) {
            return redirect()->back()->with('error', 'Server Error, Something went wrong');
        }

        return redirect()->route('announcements.index')->with('success', 'Successfully Maded Announcement');
    }

    public function destroy(string $id)
    {
        $decrypted_id = Crypt::decrypt(urldecode($id));

        $announcement = Announcement::findOrFail($decrypted_id);

        $delete = $announcement->delete();

        if (! $delete) {
            return response()->json([], 500);
        }

        return response()->json([], 200);
    }

    public function edit(string $id)
    {

        $decrypted_id = Crypt::decrypt(urldecode($id));

        $data = Announcement::findOrFail($decrypted_id);

        return view('pages.admin-staff.announcements.edit', [
            'id' => $id,
            'data' => $data,
        ]);
    }

    public function update(string $id, Request $request)
    {
        $decrypted_id = Crypt::decrypt(urldecode($id));

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $announcement = Announcement::findOrFail($decrypted_id);

        $update = $announcement->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if (! $update) {
            return redirect()->back()->with('error', 'Server Error, Something went wrong');
        }

        return redirect()->route('announcements.index')->with('success', 'Successfully Updated Announcement');
    }
}
