<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Appnap Assignment",
 *      description="Full Stack Developer Appnap Assignment",
 *      @OA\Contact(
 *         name="API Support",
 *         url="https://www.rhasan.xyz",
 *         email="mdrabiuilhasan.me@gmail.com"
 *      ),
 * )
 * @OA\Server(
 *      url="http://localhost/Learning/appnap-assignment/backend/api/v1",
 *      description="Local Server"
 * )
 * @OA\Tag(
 *     name="Authentication",
 *     description="Login/Registration/Forget-Password/Password-Reset Route Here"
 * )
 * 
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
