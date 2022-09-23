<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginController extends BaseController
{
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
       
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user  = Auth::user();
            $token = $user->createToken($user->name)->accessToken;
            
            $success = [
                "name" => $user->name, 
                "token" => $token 
            ];
   
            return $this->sendResponse( 'User login successfully.', $success);
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'email or password was incorrect'], 403);
        } 
    }
}
