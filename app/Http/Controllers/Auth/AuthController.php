<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInformation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Mail\OTPMailer;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // view landing page
    public function viewLandingPage()
    {
        if (Auth::check()) {

            // url for each role
            switch (Auth::user()->role) {
                case 1:
                    $url = '/as/dashboard';
                    break;
                case 2:
                    $url = '/as/dashboard';
                    break;
                case 3:
                    $url = '/dashboard';
                    break;
            }

            return redirect($url);
        }

        return view('pages.general.index');
    }

    public function viewSignin()
    {
        return view('pages.general.sigin-in');
    }

    // view sign up
    public function viewSignup()
    {
        return view('pages.general.sign-up');
    }

    // signup process
    public function signupProcess(Request $request)
    {
        try {
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
                'address' => 'required',
                'sex' => 'required',
                'otp' => 'required',
            ], [
                'required' => 'This field is required'
            ]);



            // if validator fail
            if ($validator->fails()) {
                $errors = $validator->errors(); // get errors

                return response()->json($errors, 422);

                // if error has file return response 409
                if ($errors->has('file')) {
                    // log error
                    Log::error('response 409 - file maybe not jpg, png, jpeg, or filesize may exceed 5mb');

                    return response(null, 409);
                }
            }

            if($request->otp != session('otp')){
                return response()->json([], 403);
            }

            // upload id picture
            $upload_path = Storage::disk('local')->putFile('users/id-picture', $request->file('file'));

            // throw new Exception if fail to upload
            throw_if(! $upload_path, Exception::class, 'Failed to upload file id picture');

            // start transaction
            DB::beginTransaction();

            // set full name
            if ($request->mname != '') {
                $name = $request->fname.' '.$request->mname.' '.$request->lname;
            } else {
                $name = $request->fname.' '.$request->lname;
            }

            // user create data
            $create_user_data = [
                'name' => $name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            // create statu
            $create_user_status = User::create($create_user_data);

            // throw new Exception if fail to create new user
            throw_if(! $create_user_status, Exception::class, 'Failed to create user');

            // user information create data
            $ui_create_data = [
                'user_id' => $create_user_status->id,
                'fname' => $request->fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'bdate' => $request->bdate,
                'bplace' => $request->bplace,
                'id_type' => $request->id_type,
                'id_picture' => $upload_path,
                'contact_number' => $request->contact,
                'address' => $request->address,
                'sex' => $request->sex,
            ];

            // create user information
            $ui_create_status = UserInformation::create($ui_create_data);

            // throw new Exception if fail to insert user information data
            throw_if(! $ui_create_data, Exception::class, 'Fail to insert data user information');

            // db commit
            DB::commit();


            session()->forget('otp');

            return response(null, 200); // response 200
        } catch (\Throwable $th) {
            /**
             * log error
             * response 500
             */
            DB::rollBack();
            dd($th->getMessage());
            Log::error($th->getMessage());

            return response(null, 500);
        }
    }

    // signin process
    public function signinProcess(Request $request)
    {
        try {

            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8'],
            ]);

            // get user
            $isUserVerified = User::select('account_verified')->where('email', $request->email)->first();

            // invalid credentials
            if (! $isUserVerified) {
                return response(null, 401);
            }

            // user unverified
            if ((int) $isUserVerified->account_verified == 0) {
                return response(null, 403);
            }

            // invalid credentials
            if (! Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return response(null, 401);
            }

            // url for each role
            switch (Auth::user()->role) {
                case 1:
                    $url = '/as/dashboard';
                    break;
                case 2:
                    $url = '/as/dashboard';
                    break;
                case 3:
                    $url = '/dashboard';
                    break;
            }

            // return response 200
            return response()->json(['url' => $url]);
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

    // log out
    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }

    /**
     * send otp
     */
    public function sendOTP(Request $request) {
        $request->validate([
            'email' => 'required'
        ]);

        $otp = rand(100,999);

        session([
            'otp' => $otp
        ]);

        Mail::to($request->email)->send(new OTPMailer($otp));

        return response()->json([], 200);
    }
<<<<<<< HEAD

    public function viewFaqs() {
        return view('faqs');
    }
=======
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
}
