<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ForgotRequests;
use App\Http\Requests\Api\LoginRequests;
use App\Http\Requests\Api\SetNewPasswordRequest;
use App\Http\Requests\Api\UsersRequests;
use App\Mail\OTPMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{


    public function login(LoginRequests $request)
    {
        try {
            $credentials = request(['email', 'password']);

            $user = User::where('email', $credentials['email'])->first();

            if (empty($user)) return $this->respondUnauthorized([], false, 'User does not exists');

            if (!Hash::check($request->password, $user->password)) {
                return $this->respondUnauthorized([], false, 'Credentials do not match');
            }

            return $this->respond([
                'user' => $user,
                'token' => $this->createUserToken($user, 'news'),
            ], [], 200, 'Login Successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondInternalError([], false, $e->getMessage());
        }
    }

    public function signup(UsersRequests $request)
    {
        try {

            DB::beginTransaction();
            $user = User::create($request->all());
            DB::commit();

            return $this->respond(
                [
                    'user' => $user,
                    'token' => $this->createUserToken($user, 'news'),
                ],
                [],
                true,
                'account created successfully!'
            );

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondInternalError([], false, $e->getMessage());
        }
    }

    public function forgot(ForgotRequests $request)
    {
        try {
            $user = User::where('email', $request->input('email'))->first();
            if ($user) {
                $otp = rand(10, 10000);
                Mail::to($user->email)->send(new OTPMail(
                    $user->email,
                    $user->first_name . ' ' . $user->last_name,
                    $otp,
                ));
                DB::beginTransaction();
                $user->update(['otp' => $otp]);
                DB::commit();
            }

            return $this->respond([], [], true, 'OTP code send to you email!');

        } catch (\Exception $e) {
            return $this->respondInternalError([], false, $e->getMessage());
        }
    }

    public function changePassword(SetNewPasswordRequest $request)
    {
        try {

            $user = User::where('email', $request->input('email'))->first();

            if ($user and $user->otp != $request->input('otp')) {
                return $this->setStatusCode(409)
                    ->respondWithError([], false, 'Your OTP is not matched!');
            }

            $user->update([
                'password' => $request->password,
            ]);

            return $this->respond([], [], true, 'Password changed successfully!');

        } catch (\Exception $e) {
            return $this->respondInternalError([], false, $e->getMessage());
        }
    }


}
