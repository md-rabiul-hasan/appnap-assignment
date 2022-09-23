<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Jobs\PasswordResetMailSendJob;
use App\Mail\PasswordResetMail;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordController extends BaseController
{
    /**
     * Forget Password
     * @OA\Post (
     *     path="/auth/forget-password",
     *     tags={"Authentication"},
     *     summary="Reset token send email",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "email": "arif@gmail.com",
     *                }
     *             )
     *         )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Password reset mail sent.",
     *          @OA\JsonContent(
     *              type="object",
     *              example={{"success":true,"status_code":200,"message":"Password reset mail sent.","data":{"reset_token":"XamaAWLSwKyInDl8gANe"}}}
     *          )
     *     ),
     * 
     * )
     */
    public function forgetPassword(ForgetPasswordRequest $request){
    

        $email = $request->input('email');

        $user = User::where('email', $email)->first();
        if($user){
            $email = $user->email;
            $reset_token = $this->generateResetToken($email);

            $success = [
                "reset_token" => $reset_token 
            ];
       
            return $this->sendResponse('Password reset mail sent.', $success);

        }else{
            return $this->sendError('This email not registration yet', [], 404); 
        }
        
    }


    protected function generateResetToken($email){
        $token = Str::random(20);
        $password_reset = DB::table('password_resets')->where('email', $email)->first();
        if($password_reset){
            DB::table('password_resets')->where('email', $email)->update([
                "token" => $token
            ]);
        }else{
            DB::table('password_resets')->insert([
                "email" => $email,
                "token" => $token
            ]);
        }
        $this->sendPasswordResetMail($email, $token);
        return $token;
    }

    protected function sendPasswordResetMail($email, $token){
        $details = [
            'email' => $email,
            'subject' => 'Password Reset',
            'url' => "http://localhost:3000/reset-password/$token"
        ];
        Mail::to($details['email'])->send(new PasswordResetMail($details));
        // dispatch(new PasswordResetMailSendJob($details));
    }

}