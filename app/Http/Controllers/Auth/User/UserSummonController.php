<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Models\Summon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

/**
 * Controller for handling summon request (KP Form No. 9) routes.
 *
 * Provides endpoints to view, create, edit, update, delete and store summon requests.
 */
class UserSummonController extends Controller
{
    /**
     * This return a index view for list of summon request from a users
     *
     * Get data with current logged in user,
     * paginate the data with appended query search
     * encypt row ids
     * return blade with data
     *
     * @param \Illuminate\Http\Request $request - search and etc.
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->filled('search') ? $request->search : '';

        $data = Summon::getRows(
            wheres: [
                'user_id' => Auth::user()->id
            ],
            search: $search
        )
            ->paginate(15)
            ->withQueryString();

        foreach($data as $item){
            $item->encrypted_id = Crypt::encrypt($item->id);
        }

        return view('pages.user.kp-form-no-9.index', [
            'data' => $data
        ]);
    }

    /**
     * This return a create view for requesting summon
     *
     * @param string $id Encryptd id
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.user.kp-form-no-9.create');
    }

    /**
     * Show the view for viewing the request details
     *
     * Decrypts the id from the request,
     * get specific request and
     * add it in the data in the view
     *
     * @param mixed $id The ecrypted id for getting the specific request.
     * @return \Illuminate\View\View
     */
    public function show(string $id)
    {
        $decrypted_id = Crypt::decrypt(urldecode($id));

        $data = Summon::findOrFail($decrypted_id);

        return view('pages.user.kp-form-no-9.show', [
            'data' => $data
        ]);
    }

    /**
     * Handle the users request for summmon
     *
     * Validate request, Perform Create query, return response 200
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'mga_nagsumbong' => 'required',
            'kaso-sa-brgy-isip' => 'required',
            'mga_sinumbong' => 'required',
            'bahin-sa' => 'required',
            'petsa' => ['required', 'after_or_equal:tomorrow']
        ], [
            'required' => 'This field is required.',
            'petsa.after_or_equal' => 'The petsa must atleast tomorrow.'
        ]);

        Summon::create([
            'user_id' => Auth::user()->id,
            'kaso_sa_brgy_isip' => $request->input('kaso-sa-brgy-isip'),
            'mga_nagsumbong' => $request->mga_nagsumbong,
            'mga_gisumbong' => $request->mga_sinumbong,
            'bahin_sa' => $request->input('bahin-sa'),
            'petsa' => $request->petsa,
        ]);

        return response(null, 200);
    }

    /**
     * Open edit view for summon request
     *
     * Decrypt encrypted id from the uri query,
     * get data and return view edit.blade.php
     *
     * @param mixed $id The ecrypted id for getting the specific request.
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $decrypted_id = Crypt::decrypt(urldecode($id));

        $data = Summon::findOrFail($decrypted_id);

        $data->encrypted_id = urldecode($id);

        return view('pages.user.kp-form-no-9.edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified summon request.
     *
     * Validates the incoming request, decrypts the provided ID,
     * and returns a 200 response on success.
     *
     * @param  \Illuminate\Http\Request  $request  The incoming request with payload.
     * @param  string  $id  The encrypted summon request ID.
     * @return \Illuminate\Http\Response Return 500 resposne if there was unexpected error or update failed, else return response 200
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'bahin-sa' => 'required',
            'kaso-sa-brgy-isip' => 'required',
            'mga_nagsumbong' => 'required',
            'mga_sinumbong' => 'required',
            'petsa' => 'required',
        ], [
            'required' => 'This field is required.',
        ]);

        $d_id = Crypt::decrypt(urldecode($id));

        $update_status =  Summon::updateRow($d_id, [
            'kaso_sa_brgy_isip' => $request->input('kaso-sa-brgy-isip'),
            'mga_nagsumbong' => $request->mga_nagsumbong,
            'mga_gisumbong' => $request->mga_sinumbong,
            'bahin_sa' => $request->input('bahin-sa'),
            'petsa' => $request->petsa
        ]);

        // if failed to update request return response 500
        if(!$update_status){
            Log::error('Failed to update summon request');
            return response(null, 500);
        }

        return response(null, 200);
    }

    /**
     * This delete a request summon
     *
     * Decrypt id from the param, get row, delete row and return response 200
     *
     * @param string $id The encrypted id of the request
     * @return Illuminate\Http\Response Return 200 response if success
     */
    public function destroy(string $id) {
        $decrypted_id = Crypt::decrypt(urldecode($id));

        $item = Summon::findOrFail($decrypted_id);

        $item->delete();

        return response(null, 200);
    }
}
