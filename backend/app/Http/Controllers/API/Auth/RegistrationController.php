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
     * Registration
     * @OA\Post (
     *     path="/auth/registration",
     *     tags={"Authentication"},
     *     summary="Registration with your information",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "name" : "Ariful Islam",
     *                     "email": "arif@gmail.com",
     *                     "password": "123123",
     *                     "confirm_password" : "123123"
     *                }
     *             )
     *         )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="User register successfully.",
     *          @OA\JsonContent(
     *              type="object",
     *              example={{"success":true,"status_code":200,"message":"User register successfully.","data":{"name":"Ariful Islam","token":"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZDIyYWUwYWE3ZTZhZjQwYmViMzZhM2RiYzAzNTcyNDEzYmI4MmFiYTAwMTk2YTgzZWU0ZjQyZDg4ZTcwZjk3YzcyMmRlZDE1NTliOTg2ZTciLCJpYXQiOjE2NjM5MDczNzguMDMwOTM5LCJuYmYiOjE2NjM5MDczNzguMDMwOTQ4LCJleHAiOjE2OTU0NDMzNzcuODExODYxLCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.g6EYLaFnKf_8lnlrxSNj6zsb-WcbLZ7KOS5qjEkv1jPu2jrmbsvluzDgXk8NyupH6mkYQS0wHdqMFlvFJBolxfsmwNNgBV0OfqlydKiBpL4rD_bsYKB8FxyiX7QxM6IOWFkGMJsq7v2jRGGOkKIvklMEhpJcSwdo-iDNae1HuOedYpSyRs2H07yXsunQ2zyFovEPGgttQH4we6OfoWA1x4L6NE6v_9jFmE9PUdyTf9qn8398EeZqu_S6UCNUcMQ_5MYTE2fx3DMNNgPCHmL4bUoj9mdszeaMm3lH5Qq72xKsc5ft_GrX11rk8FmRaS4mB8AJLhefH9afu8hpIbrZw-sBVfF71aZFfrrDrK7dp0hnEdoO385cHkE5mgyMwfl_0mT65Y-yPMsx2xBQUHWX0Y_gwk2QFGSjib6YNeENInujn_rC__kdeyCsIDTYumHVsGRk4DCEkpGja_YllCUPf4TNW_asQyUo3MHoYWTWuSxR0NPBbl8Ji_BQlO8j45YPduzUT-Ek3G7EcAjj28zyX9KqSF20wNt6BnDLzbZA5wdusm2yq6IekjOQlkM6xaoIQ0dRs8bohF0hqRPPnd5sRbLBRqfQxn0MQvw4zGP3qbdtfyQPVowO8N2W8jfqqPXLqcSiq5_sjSQW6YtKnjgGfurkdSeLCDp5kd374E9aJA4"}}}
     *          )
     *     ),
     * 
     * )
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
            "token" => "Bearer ". $token 
        ];
   
        return $this->sendResponse('User register successfully.', $success);
   
    }

}
