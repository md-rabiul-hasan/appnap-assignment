<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController;

class UserInformationController extends BaseController
{

    /**
     * user Profile
     * @OA\Get (
     *     path="/auth/user-info",
     *     tags={"Authentication"},
     *     summary="Authenticated User Profile",
     *     description="This api fetch authentication user profile",
     *     security={{"jwt_token":{}}},
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="object",
     *              example={"success":true,"status_code":200,"message":"User Fetch successfully.","data":{"name":"Rabiul Hasan","email":"rabiul.fci@gmail.com"}}
     *          )
     *     ), 
     * )
     */
    public function userInfo(){      		
        $success = [
            "name"  => Auth::user()->name,
            "email" => Auth::user()->email,
        ];   
        return $this->sendResponse('User Fetch successfully.', $success);
    }
}
