<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Auth\RegistrationRequest;

class RegistrationController extends BaseController
{
	
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function registration(RegistrationRequest $request){
		
        $user = User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
		
		

        $token = $user->createToken($user->name)->accessToken;

        $success = [
            "name" => $user->name, 
            "token" => $token 
        ];
   
        return $this->sendResponse('User register successfully.', $success);
   
    }

}
