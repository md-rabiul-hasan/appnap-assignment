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
    /**
     * Password Reset
     * @OA\Post (
     *     path="/auth/reset-password/{token}",
     *     tags={"Authentication"},
     *     summary="Login with your cridentail",
     *     @OA\Parameter(
     *         in="path",
     *         name="token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "password" : "112233",
     *                     "confirm_password" : "112233"
     *                }
     *             )
     *         )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="User Password Reset successfully. Please login",
     *          @OA\JsonContent(
     *              type="object",
     *              example={{"success":true,"status_code":200,"message":"User Password Reset successfully. Please login","data":{"name":"Rabiul Hasan","token":"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMmUwODdlNWRiOGE5ZjgyZWMyOTY3YTI4YTNlY2U3Y2I4M2MxMDFlZGIxZTZiNzQzMTdjNGRlZGRjNmVmMmQ1ZDM1YjMzNjY1OGE4N2M1ZTciLCJpYXQiOjE2NjM5MDg3NzMuNTMxMDAzLCJuYmYiOjE2NjM5MDg3NzMuNTMxMDEyLCJleHAiOjE2OTU0NDQ3NzMuNDE4MjQxLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.wHnLAII73ytZ4C_8BzJp6GQlHWr83gKFboRFD-Bwukw233d9lorrmOrj3gG9UbKatvoYuznln4TwYzNZVCcP_QNXcjiu7UvPYHEJ9V-rRz2v6uh4gFhArutbHlQfcgQT9ONK8z_YbS29ghmgEdNSRaJjdVUqRlkI_SiYuDPiF5DH0QnNcAvWSx-YFIE7yhWyxdvjvfYonPnp3k6dYb1C8lm-m0ioHdUMloVpYxIByOX_cqfeOOlu8tEbdDUV_UfmNbkmCHPbLea9MlNup0ekZK6ch5lED-u7M-0c5h-KkBxaIXcrI0LxeyfIBUMMTP-2SZdotSEaotVgtDwSezBdXNewmAz219l6pOKM5uSkd4xrKae9QdFgNneqL-fd_D3gLnAavJemarzBnH7Oezg9aeGqVSn7m_P-nurkfUvnq7Q4eW-Fy223VLuMs2W9A79_k5tvJKQ9Lq9xo0DROAJDBPDtm83Le_b7U5uD9FebfW8n_BYScQfBcwqohrlSbE2xKj1KBfE59tnHJaaQK9qUCNleWYr6_7angI2L2q64yDoR6wlbeIpPI-6uChatinrypc7Yugh9sE3B-1qigUqIMxib3C2RGOZ6J9-5IEuITnFXJcYi6sY6M6kh29GhH_9pcxB-6sSeAukLq5UY8Q26OJwlNq3GPePxkvpL3bBI-Ac"}}}
     *          )
     *     ),
     * 
     * )
     */
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
                "token" => "Bearer ". $token 
            ];
   
            return $this->sendResponse('User Password Reset successfully. Please login', $success);


        }else{
            return $this->sendError('Invalid token', [], 404);
        }

    }
}
