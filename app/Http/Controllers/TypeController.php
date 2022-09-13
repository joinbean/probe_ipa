<?php

namespace App\Http\Controllers;

use App\Models\Type;

class TypeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/types",
     *     tags={"Types"},
     *     summary="Get list of types",
     *     description="Returns list of types",
     *     security={{"bearer_token":{}}},
     *     @OA\Response(
     *          response="200", 
     *          description="Successful operation."
     *     )
     * )
     */
    public function index()
    {
        return response()->json([Type::all()], 200);
    }
}
