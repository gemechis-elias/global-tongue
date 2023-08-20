<?php

namespace App\Http\Controllers;
use OpenApi\Annotations as OA;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     description="",
 *     version="1.0.0",
 *     title="Global Tongue API Documentation",
 *     @OA\Contact(
 *         email="gemeelijah@gmail.com"
 *     ),
 *     @OA\License(
 *         name="Gemechis Elias",
 *         url="https://gemechis.me"
 *     )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
