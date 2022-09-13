<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/register",
     *     tags={"Users"},
     *     summary="Register a new user",
     *     description="Registers a new user",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                @OA\Property(
     *                    property="name",
     *                    type="string"
     *                ),
     *                @OA\Property(
     *                    property="email",
     *                    type="string"
     *                ),
     *                @OA\Property(
     *                    property="password",
     *                    type="string"
     *                ),
     *                example={
     *                      "name": "Smithy", 
     *                      "email": "johny.smith@combobo.io", 
     *                      "password": "password"
     *                }
     *              )
     *              
     *          )
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Successful operation.",
     *          @OA\JsonContent(
     *              @OA\Examples(example="result", value={"access_token": "2|eLYk1swwVOugon1Ti6fCzO8IozLc7GJoyATDLmRv",
     *	            "token_type": "Bearer"}, summary="A result object.")
    *          )
    *     )
    * )
    */
    public function register(Request $request)
    {
        $post_data = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|min:8'
        ]);
 
        $user = User::create([
            'name' => $post_data['name'],
            'email' => $post_data['email'],
            'password' => Hash::make($post_data['password'])
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
 
    /**
     * @OA\Post(
     *     path="/login",
     *     tags={"Users"},
     *     summary="Login as user",
     *     description="Logs in a user",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                @OA\Property(
     *                    property="email",
     *                    type="string"
     *                ),
     *                @OA\Property(
     *                    property="password",
     *                    type="string"
     *                ),
     *                example={
     *                      "email": "johny.smith@combobo.io", 
     *                      "password": "password"
     *                }
     *              )
     *              
     *          )
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Successful operation.",
     *          @OA\JsonContent(
     *              @OA\Examples(example="result", value={"access_token": "2|eLYk1swwVOugon1Ti6fCzO8IozLc7GJoyATDLmRv",
     *	            "token_type": "Bearer"}, summary="A result object.")
    *          )
    *     )
    * )
    */
    public function login(Request $request)
    {
    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
            'message' => 'Login information is invalid.'
        ], 401);
    }

    $user = User::where('email', $request['email'])->firstOrFail();
    
    $token = $user->createToken('authToken')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer'
    ]);
    }
}
