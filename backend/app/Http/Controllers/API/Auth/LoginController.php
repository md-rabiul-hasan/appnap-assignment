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
     * Login
     * @OA\Post (
     *     path="/auth/login",
     *     tags={"Authentication"},
     *     summary="Login with your cridentail",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "email": "arif@gmail.com",
     *                     "password": "123123",
     *                }
     *             )
     *         )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="User login successfully.",
     *          @OA\JsonContent(
     *              type="object",
     *              example={{"success":true,"status_code":200,"message":"User login successfully.","data":{"name":"Rabiul Hasan","token":"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZWQ2NjdiOGNjNDgyOWQ5NjY0MmU2MDI3ZmZlNDU2Zjg0M2JjY2VkY2JmNjZlYzY5NDVlMTlmYjQxZjY2ZjI0YmRmMjZiMzE1NDU0ZjMxNTAiLCJpYXQiOjE2NjM5MDgxNjguMjUzNDMyLCJuYmYiOjE2NjM5MDgxNjguMjUzNDQxLCJleHAiOjE2OTU0NDQxNjguMTI2NjcyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.SPDaF-nFeT3KNOojx8mfttafvGwOJJrBfWnikfr4RENaRSQo6EWUnIFqjbnwbTMEa9yRs-1Mkem2Fdji1_M3OtkjFM-YQNaMU-rqybJqwDyuc79Rt9aDlRp0Aw3nKHnKAgxuS_9BADC9P73RLaef9dsS0G9KBUODUdvvU4TkBqC-nAbINM850fTmk_xMPhmZ1N0fBmEKqc2B4HaLXHMQswFicOeuHOiOdRjjrZM6h8v6T5IJjGozP1ECQM6MhRlcqBBSl2G6fSZjUKEjQR1jqo3wr_rmcyt8v-wlEM44U9_nWT86RrCL-ySP-zMBYKN2J0aAc_zEg0JEc5AoyPKNDTcN2n1AbwvHjU28DN5yc_GOOp5miRbdhRZSktJ-LipOpUZt5CZZoXH8K5KQjmxF3FB4cDb6eHXsQZnSp1dUUfdWMueQyIuKyeAFeSqunPMtMZJc7DmAwI1ODOSl2SgBTBk8nGMARJa-CMaBItSybHlC_AtWJnNXdIyq4IKd0q6eiK9sDFP7xuCTkSRdOYescT7_BX3Q44uJWGk0gFmJp5Rcy_aHcn5AO4vCjsPAY3S1UVakVEqQ2FaO4I4YnKLNKFLl1B1TnOfmVhMVwj8UDNhJkXv1JyuNQnawNbvCW7pt3vBvbasYqBh_-VRTvMAczyuajny2oQmgg8Ymlq1Kkr4"}}}
     *          )
     *     ),
     * 
     * )
     */
    public function login(LoginRequest $request)
    {
       
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user  = Auth::user();
            $token = $user->createToken($user->name)->accessToken;
            
            $success = [
                "name"       => $user->name,
                "token_type" => "Bearer",
                "token"      => $token
            ];   
            return $this->sendResponse( 'User login successfully.', $success);
        } 
        else{ 
            return $this->sendError('email or password was incorrect.', ['error'=>'email or password was incorrect'], 200);
        } 
    }
}
