<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\User;
use App\Models\UserInformation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // index
    public function index()
    {
        try {
            // get current logged in user
            $user = User::join('user_informations as ui', 'users.id', '=', 'ui.user_id')
                ->select([
                    'users.*',
                    'ui.fname',
                    'ui.mname',
                    'ui.lname',
                    'ui.bdate',
                    'ui.bplace',
                    'ui.id_type',
                    'ui.id_picture',
                    'ui.contact_number',
                    'ui.sex',
                    'ui.address'
                ])
                ->where('users.id', Auth::user()->id)
                ->get();

            $user[0]->encrypted_id = Crypt::encrypt(Auth::user()->id);

            // return view with user
            return view('pages.general.profile', [
                'user' => $user[0]
            ]);
        } catch (\Throwable $th) {
            /**
             * log error
             * abort 500
             */
            dd($th->getMessage());
            Log::error($th->getMessage());
            abort(500);
        }
    }

    // update
    public function update(Request $request, $id)
    {
        try {
            // decrypt id
            $decrypted_id = Crypt::decrypt($id);

            // get user
            $user = User::findOrFail($decrypted_id);

            // validate request
            $validator = Validator::make($request->all(), [
                'fname' => 'required',
                'mname' => 'nullable',
                'lname' => 'required',
                'bdate' => ['required', 'date'],
                'bplace' => 'required',
                'id_type' => 'nullable',
                'id_picture' => 'nullable',
                'contact' => 'required',
                'email' => ['required', 'email', "unique:users,email, {$user->id}"],
                'password' => ['nullable', 'min:8'],
                'sex' => ['required'],
                'address' => ['required'],
            ]);

            if ($validator->fails()) {

                if ($validator->errors()->has('email')) {
                    return response(['message' => 'Email Already May Exist, Invalid Email and Etc.'], 422);
                }

                return response(null, 422);
            }

            // get fullname
            $fullname = $request->mname == "" ? $request->fname . ' ' . $request->lname : $request->fname . ' ' . $request->mname . ' ' . $request->lname;
            // start transaction
            DB::beginTransaction();

            if ($request->password == "") {
                $user_update_data = [
                    'name' => $fullname,
                    'email' => $request->email,
                ];
            } else {
                $user_update_data = [
                    'name' => $fullname,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ];
            }

            // update user
            $update_user_status = $user->update($user_update_data);

            // throw new Exception if update fails
            throw_if(!$update_user_status, Exception::class, 'Fails to update a row in users');

            if ($request->hasFile('file')) {
                // upload id picture
                $id_path = HelperController::uploadFile($request->file('file'), 'users/id-picture');

                // user information update data
                $update_user_info_data = [
                    'fname' => $request->fname,
                    'mname' => $request->mname == "" ? null : $request->mname,
                    'lname' => $request->lname,
                    'bdate' => $request->bdate,
                    'bplace' => $request->bplace,
                    'id_type' => $request->id_type,
                    'id_picture' => $id_path,
                    'contact_number' => $request->contact,
                    'sex' => $request->sex,
                    'address' => $request->address
                ];
            } else {
                // user information update data
                $update_user_info_data = [
                    'fname' => $request->fname,
                    'mname' => $request->mname == "" ? null : $request->mname,
                    'lname' => $request->lname,
                    'bdate' => $request->bdate,
                    'bplace' => $request->bplace,
                    'id_type' => $request->id_type,
                    'contact_number' => $request->contact,
                    'sex' => $request->sex,
                    'address' => $request->address
                ];
            }

            // update user information
            $update_user_info_status = UserInformation::where('user_id', $decrypted_id)
                ->update($update_user_info_data);

            //
            throw_if(!$update_user_info_status, Exception::class, 'Failed to update row in user_informations');

            // commit
            DB::commit();

            Auth::loginUsingId(Auth::id());

            // return response 200
            return response(null, 200);
        } catch (\Throwable $th) {
            /**
             * log error
             * response 500
             */
            dd($th->getMessage());
            Log::error($th->getMessage());
            return response(null, 500);
        }
    }
}
