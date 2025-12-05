<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Models\AnimalTransportationClearanceRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


class AnimalClearanceRequestController extends Controller
{
    /**
     * index
     */
    public function index(): View
    {
        $status = urldecode(request('status'));

        $query = AnimalTransportationClearanceRequest::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id);

        if (!empty($status)) $query->where('status', $status);

        $data = $query->paginate(15);

        foreach ($data as $item) {
            $item->encrypted_id = Crypt::encrypt($item->id);
        }

        return view('pages.user.animal-transportation-clearance-request.index', [
            'data' => $data
        ]);
    }

    /**
     * create
     */
    public function create(): View
    {
        return view('pages.user.animal-transportation-clearance-request.create');
    }

    /**
     * store
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'animal_type' => ['required'],
            'animal_name' => ['required'],
            'animal_age' => ['required'],
            'location' => ['required']
        ], [
            'required' => 'This field is required.'
        ]);

        AnimalTransportationClearanceRequest::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'animal_type' => $request->animal_type,
            'animal_name' => $request->animal_name,
            'animal_age' => $request->animal_age,
            'location' => $request->location,
        ]);

        return redirect()->route('animal-transportation-clearance.request.index')->with('success', 'Successfuly Requested Clearance');
    }

    /**
     * show
     */
    public function show(string $id): View {
        $decrypted_id = Crypt::decrypt(urldecode($id));

        $data = AnimalTransportationClearanceRequest::findOrFail($decrypted_id);

        return view('pages.user.animal-transportation-clearance-request.show', [
            'data'=> $data
        ]);
    }
}
