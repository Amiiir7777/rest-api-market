<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{

    /**
     * @OA\Get (
     *      path="/test",
     *      operationId="test",
     *      tags={"Auth"},
     *      summary="get test",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found Exception",
     *          @OA\JsonContent()
     *       ),
     *       security={{ "bearer_token": {} }}
     *     )
     */
    public function index()
    {
        return ['TestController'];
    }
}
