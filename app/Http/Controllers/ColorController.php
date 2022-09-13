<?php

namespace App\Http\Controllers;

use App\Models\Color;

class ColorController extends Controller
{
    /**
     * @OA\Get(
     *     path="/colors",
     *     tags={"Colors"},
     *     summary="Get list of colors",
     *     description="Returns list of colors",
     *     security={{"bearer_token":{}}},
     *     @OA\Response(
     *          response="200", 
     *          description="Successful operation."
     *     )
     * )
     */
    public function index()
    {
        return response()->json([Color::all()], 200);
    }
}
