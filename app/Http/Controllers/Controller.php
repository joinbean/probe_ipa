<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Trophy management API",
 *      description="API to manage trophies",
 *      @OA\Contact(
 *          email="julien.raedler@twofold.swiss"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 * 
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Trophy Manager API Server"
 * )
 * 
 * @OA\Tag(
 *     name="Users",
 *     description="API Endpoints of Users"
 * )
 * 
 * @OA\Tag(
 *     name="Types",
 *     description="API Endpoints of Types"
 * )
 * 
 * @OA\Tag(
 *     name="Colors",
 *     description="API Endpoints of Colors"
 * )
 * 
 * @OA\Tag(
 *     name="Categories",
 *     description="API Endpoints of Categories"
 * )
 * 
 * @OA\Tag(
 *     name="Trophies",
 *     description="API Endpoints of Trophies"
 * )
 * 
 * @OAS\SecurityScheme(
 *      securityScheme="bearer_token",
 *      type="http",
 *      scheme="bearer"
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
