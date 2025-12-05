<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\User;
use App\Models\UserInformation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    // index
    public function index()
    {
        try {
            // get all users
            $users = User::getRows(['id', 'name', 'role', 'email', 'created_at', 'account_verified'], ['account_verified' => '1'])
                ->whereNot('role', 1)
                ->paginate(15);

            // return view
            return view('pages.admin.users-management.index', [
                'users' => $users
            ]);
        } catch (\Throwable $th) {
            /**
             * log error
             * abort 500
             */
            Log::error($th->getMessage());
            abort(500);
        }
    }

    // add user view form
    public function create()
    {
        return view('pages.admin.users-management.create');
    }

    // store
    public function store(Request $request)
    {
        try {
            // dd($request->all());
            // make validator
            $validator = Validator::make($request->all(), [
                'fname' => 'required',
                'mname' => 'nullable',
                'lname' => 'required',
                'bdate' => ['required', 'date'],
                'bplace' => 'required',
                'id_type' => ['required', 'integer'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'min:8'],
                'file' => ['required', 'mimes:png,jpg, jpeg', 'max:5120'],
                'contact' => 'required',
                'user_type' => 'required',
                'sex' => 'required',
                'address' => 'required',
            ], [
                'required' => 'This field is required.'
            ]);

            // if validator fail
            if ($validator->fails()) {
                $errors = $validator->errors(); // get errors

                return response()->json($errors, 422);

                // if error has file return response 409
                if ($errors->has('file')) {
                    // log error
                    Log::error("response 409 - file maybe not jpg, png, jpeg, or filesize may exceed 5mb");
                    return response(null, 409);
                }
            }

            // upload id pic
            $file_dir = HelperController::uploadFile($request->file('file'), 'users/id-picture');

            // thrown new Exception if fails to upload
            throw_if(!$file_dir, Exception::class, 'Failed to upload file into server');

            // fullname
            $fullname = '';
            $request->mname == ""
                ? $fullname = $request->fname . ' ' . $request->lname
                : $fullname = $request->fname . ' ' . $request->mname . ' ' . $request->lname;

            // start transaction
            DB::beginTransaction();

            // user create data
            $users_create_data = [
                'name' => $fullname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->user_type
            ];

            // create query
            $users_create_status = User::create($users_create_data);

            // throw new Exception if failed to create
            throw_if(!$users_create_status, Exception::class, 'Failed to insert data into table users');

            // create data
            $user_informations_create_data = [
                'user_id' => $users_create_status->id,
                'fname' => $request->fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'bdate' => $request->bdate,
                'bplace' => $request->bplace,
                'id_type' => $request->id_type,
                'id_picture' => $file_dir,
                'contact_number' => $request->contact,
                'sex' => $request->sex,
                'address' => $request->address,
            ];

            // create status
            $user_informations_create_status = UserInformation::create($user_informations_create_data);

            // throw Exception if failed to insert new row
            throw_if(!$user_informations_create_status, Exception::class, 'Failed to insert data into table user_informations');

            // commit changes
            DB::commit();

            // response 200
            return response(null, 200);
        } catch (\Throwable $th) {
            /**
             * log error
             * abort 500
             */
            DB::rollBack();
            dd($th->getMessage());
            Log::error($th->getMessage());
            return response(null, 500);
        }
    }

    // view pending users
    public function viewPendingUsers(Request $request)
    {
        try {
            // search get
            $search = $request->input('search');

            // get all users
            $users = User::getRows(
                [
                    'users.id',
                    'users.name',
                    'users.role',
                    'users.email',
                    'users.created_at',
                    'users.account_verified',
                    'u_info.id_type',
                    'u_info.id_picture',
                ],
                [
                    'account_verified' => '0'

                ],
                $search
            )
                ->join('user_informations as u_info', 'users.id', '=', 'u_info.user_id')
                ->paginate(15)
                ->appends(['search' => $search]);


            // return view
            return view('pages.admin.users-management.pending-user.index', ['users' => $users]);
        } catch (\Throwable $th) {
            /**
             * log error
             * abort 500
             */
            Log::error($th->getMessage());
            abort(500);
        }
    }

    // verify user account
    public function verifyPendingUser($id)
    {
        try {
            // decrypt id
            $decrypted_id = Crypt::decrypt($id);

            // update status
            $status = User::updateRow(['account_verified' => '1'], $decrypted_id);

            // throw new Exception if failed to update row
            throw_if(!$status, Exception::class, 'Failed to verify user account!');

            // return response 200
            return response(null, 200);
        } catch (\Throwable $th) {
            /**
             * log error
             * response 500
             */
            Log::error($th->getMessage());
            return response(null, 500);
        }
    }

    // reject pending user request
    public function rejectPendingUser($id)
    {
        try {
            // decrypt id
            $decrypted_id = (int) Crypt::decrypt($id);

            // update status
            $status = User::deleteRow($decrypted_id);

            // throw new Exception if failed to update row
            throw_if(!$status, Exception::class, 'Failed to reject user account registration!');

            // return response 200
            return response(null, 200);
        } catch (\Throwable $th) {
            /**
             * log error
             * response 500
             */
            Log::error($th->getMessage());
            return response(null, 500);
        }
    }

    //edit
    public function edit($id)
    {
        try {
            // decrypt id
            $decrypted_id = Crypt::decrypt($id);

            // get user row
            $user = User::join('user_informations as ui', 'users.id', '=', 'ui.user_id')
                ->select(
                    'users.id',
                    'users.email',
                    'users.role',
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
                )
                ->where('users.id', $decrypted_id)
                ->get();

            // return view
            return view('pages.admin.users-management.edit', ['user' => $user[0]]);
        } catch (\Throwable $th) {
            /**
             * log error
             * response 500
             */
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
                'user_type' => 'required',
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
                    'role' => $request->user_type
                ];
            } else {
                $user_update_data = [
                    'name' => $fullname,
                    'email' => $request->email,
                    'role' => $request->user_type,
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

            // return response 200
            return response(null, 200);
        } catch (\Throwable $th) {
            /**
             * log error
             * response 500
             */
            // dd($th->getMessage());
            Log::error($th->getMessage());
            return response(null, 500);
        }
    }

    // destroy
    public function destroy($id)
    {
        try {
            $decrypted_id = Crypt::decrypt($id); // decrypt id

            $delete_status = User::deleteRow($decrypted_id); // delete row

            throw_if(!$delete_status, Exception::class, 'Failed to delete row in users'); // throw Exception if fails to delete

            return response(null, 200); // response 200
        } catch (\Throwable $th) {
            /**
             * log error
             * response 500
             */
            Log::error($th->getMessage());
            return response(null, 500);
        }
    }
}
