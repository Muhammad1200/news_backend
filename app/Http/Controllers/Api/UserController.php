<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\ChangePasswordRequest;
use App\Http\Requests\Api\UpdateCustomerProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function me()
    {
        try {
            $user = User::where('id',Auth::id())->first();
            return $this->respond($user,[],true,'successfully retrieved!');
        }catch (\Exception $e){
            return $this->respondInternalError([],false,$e->getMessage());
        }
    }

    public function profileUpdate(UpdateCustomerProfileRequest $request)
    {
        try {
            $user = User::relations()->where('id',Auth::id());
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'country' => $request->country,
            ]);

            return $this->respond($user->first(),[],true,'successfully retrieved!');
        }catch (\Exception $e){
            return $this->respondInternalError([],false,$e->getMessage());
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {

            $user = User::where('id',Auth::id())->first();
            if( !Hash::check( $request->old_password , $user->password ) ){
                return $this->setStatusCode(409)
                    ->respondWithError([],false,"Old password is not match!");
            }

            $user->update([
                'password' => $request->password
            ]);

            return $this->respond($user,[],true,'Password change successfully!');
        }catch (\Exception $e){
            return $this->respondInternalError([],false,$e->getMessage());
        }
    }

}
