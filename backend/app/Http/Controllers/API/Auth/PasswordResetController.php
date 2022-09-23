<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Auth\ResetPasswordPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends BaseController
{
    public function passwordReset($token, ResetPasswordPasswordRequest $request){       

        $reset_token = DB::table('password_resets')->where('token', $token)->first();
        if($reset_token){

            $user = User::where('email', $reset_token->email)->first();
            DB::table('users')->where('email', $reset_token->email)->update([
                "password" => Hash::make($request->input('password'))
            ]);

            $token = $user->createToken($user->name)->accessToken;
            
            $success = [
                "name" => $user->name, 
                "token" => $token 
            ];
   
            return $this->sendResponse('User Password Reset successfully. Please login', $success);


        }else{
            return $this->sendError('Invalid token', [], 404);
        }

    }
}
