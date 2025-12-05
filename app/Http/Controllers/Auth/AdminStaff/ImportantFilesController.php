<?php

namespace App\Http\Controllers\Auth\AdminStaff;

use App\Http\Controllers\Controller;
use App\Models\FileUpload;
use App\Models\Folder;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImportantFilesController extends Controller
{
    /**
     * Returns Important File index
     *
     * @return Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $query = Folder::orderBy('name');

        $search = request('search');

        if($search){
            $query->where('name', 'like', "%$search%");
        }

        $folders = $query->paginate(15)->withQueryString();

        $folders->map(function ($item) {
            return $item->encrypted_id = Crypt::encrypt($item->id);
        });

        return view('pages.admin-staff.important-files.index', [
            'folders' => $folders
        ]);
    }
    /**
     * Create
     */
    public function create()
    {
        return view('pages.admin-staff.important-files.create');
    }

    /**
     * Store
     *
     * @param Illuminate\Http\Request
     */
    public function store(Request $request)
    {
        $request->validate([
            'folder_name' => ['required']
        ]);

        Folder::create([
            'name' => $request->folder_name
        ]);

        return redirect()->route('important-files.index')->with('success', 'Successfully Created Folder');
    }

    /**
     * destroy
     */
    public function destroy($id)
    {
        $decrypted_id = Crypt::decrypt($id);

        $row = Folder::findOrFail($decrypted_id);

        $row->delete();

        return response(null, 200);
    }

    /**
     * edit
     */
    public function edit($id): View
    {

        $d_id = Crypt::decrypt(urldecode($id));

        $folder = Folder::findOrFail($d_id);

        return view('pages.admin-staff.important-files.edit', compact('folder', 'id'));
    }

    /**
     * update
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'folder_name' => 'required'
        ]);

        $row = Folder::findOrFail(Crypt::decrypt(urldecode($id)));

        $row->update([
            'name' => $request->folder_name
        ]);

        return redirect()->back()->with('success', 'Successfully Updated Folder');
    }

    /**
     * show
     */
    public function show(string $id): View
    {
        $folder = Folder::findOrFail(Crypt::decrypt(urldecode($id)));

        $query = FileUpload::where('folder_id', Crypt::decrypt(urldecode($id)));

        $search = request('search');

        if ($search) {
            $query->where('file_name', 'LIKE', "%$search%");
        }

        $files = $query->paginate(15)->withQueryString();

        foreach ($files as $item) {
            $item->encrypted_id = Crypt::encrypt($item->id);
        }

        return view('pages.admin-staff.important-files.show', compact('folder', 'id', 'files'));
    }

    /**
     * upload file
     */
    public function uploadFiles(Request $request)
    {
        $request->validate([
            'folder-id' => 'required',
            'upload-files' => ['required', 'array', 'max:10'],
            'upload-files.*' => 'file',
        ], [
            'upload-files.max' => 'Maximum 10 uploads only per session'
        ]);

        $id = Crypt::decrypt($request->input('folder-id'));

        $file_upload_path = 'file-uploads/' . Folder::getFolderName((int) $id);

        foreach ($request->file('upload-files') as $item) {
            $filename = $item->getClientOriginalName();

            $storage_path = Storage::disk('local')->putFile($file_upload_path, $item);

            FileUpload::create([
                'folder_id' => $id,
                'file_name' => $filename,
                'file_path' => $storage_path
            ]);
        }

        return response(null, 200);
    }

    /**
     * destroy file
     */
    public function destroyFile(string $id)
    {
        $decrypted_id = Crypt::decrypt(urldecode($id));

        $row = FileUpload::findOrFail($decrypted_id);

        $delete_file = Storage::disk('local')->delete($row->file_path);

        if (!$delete_file) {
            Log::error("Failed to delete file $row->file_path in the local storage");
            return response(null, 500);
        }

        $delete_status = $row->delete();

        if (!$delete_status) {
            Log::error("Failed to delete row in tbl file_uploads");
            return response(null, 500);
        }

        return response(null, 200);
    }

    /**
     * download file
     */
    public function downloadFile(string $id) {
        $decrypted_id = Crypt::decrypt(urldecode($id));

        $row = FileUpload::findOrFail($decrypted_id);

        if(Storage::disk('local')->exists($row->file_path)){
            return Storage::disk('local')->download($row->file_path, $row->file_name);
        }

        return redirect()->back()->with('error','File not found');
    }
}
