<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/categories",
     *     tags={"Categories"},
     *     summary="Get list of categories",
     *     description="Returns list of categories",
     *     security={{"bearer_token":{}}},
     *     @OA\Response(
     *          response="200", 
     *          description="Successful operation."
     *     )
     * )
     */
    public function index()
    {
        $user = auth('sanctum')->user();
        return response()->json([
            $user->categories
        ]);
    }

    /**
     * @OA\Post(
     *     path="/categories",
     *     tags={"Categories"},
     *     summary="Store new category",
     *     description="Returns category data",
     *     security={{"bearer_token":{}}},
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                @OA\Property(
     *                    property="name",
     *                    type="string"
     *                ),
     *                @OA\Property(
     *                    property="color_id",
     *                    type="integer"
     *                ),
     *                example={
     *                      "name": "Tennis",
     *                      "color_id": "2"
     *                }
     *              )
     *              
     *          )
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Successful operation.",
     *          @OA\JsonContent(
     *              @OA\Examples(example="result", value={"success": true}, summary="A result object.")
     *          )
     *     ),
     *     @OA\Response(
     *          response="422",
     *          description="The given data was invalid.")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color_id' => 'required|exists:colors,id'
        ]);

        $category = new Category();
        $category->user_id = auth('sanctum')->user()->id;
        $category->name = $validated['name'];
        $category->color_id = $validated['color_id'];
        $category->save();

        return response()->json(['message' => 'success'], 200);
    }

    /**
     * @OA\Get(
     *     path="/categories/{id}",
     *     tags={"Categories"},
     *     summary="Get categories information",
     *     description="Returns categories data",
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          description="category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Successful operation.",
     *          @OA\JsonContent(
     *              @OA\Examples(example="result", value={"id": 1, "name": "Tennis", "color_id": "1", "created_at": "2022-07-29 07:53:36", "updated_at": "2022-07-29 07:53:36"}, summary="A categories.")
     *          )
     *     )
     * )
     */
    public function show(Category $category)
    {
        $user = auth('sanctum')->user();
        if ($user->id === $category->user_id) {
            return response()->json([$category]);
        } else {
            return response()->json(['Forbidden'], 403);
        }
        
    }

    /**
     * @OA\Put(
     *     path="/categories/{id}",
     *     tags={"Categories"},
     *     summary="Update categories information",
     *     description="Updates categories data",
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          description="categories id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                @OA\Property(
     *                    property="name",
     *                    type="string"
     *                ),
     *                @OA\Property(
     *                    property="color_id",
     *                    type="integer"
     *                ),
     *                example={
     *                      "name": "Tennis",
     *                      "color_id": "1"
     *                }
     *              )
     *              
     *          )
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Successful operation.",
     *          @OA\JsonContent(
     *              @OA\Examples(example="result", value={"id": 1, "name": "Tennis", "color_id": "1", "created_at": "2022-07-29 07:53:36", "updated_at": "2022-07-29 07:53:36"}, summary="A categories.")
     *          )
     *     ),
     *     @OA\Response(
     *          response="422",
     *          description="The given data was invalid.")
     * )
     */
    public function update(Request $request, Category $category)
    {
        $user = auth('sanctum')->user();
        if ($user->id === $category->user_id) {
            $validated = $request->validate([
                'name' => 'string|max:255',
                'color_id' => 'exists:colors,id'
            ]);
    
            $category->name         =   array_key_exists('name', $validated)        ? $validated['name']        : $category->name;
            $category->color_id     =   array_key_exists('color_id', $validated)    ? $validated['color_id']    : $category->color_id;
    
            $category->save();
    
            return response()->json(['message' => 'success'], 200);
        } else {
            return response()->json(['Forbidden'], 403);
        }
    }

    /**
     * @OA\Delete(
     *     path="/categories/{id}",
     *     tags={"Categories"},
     *     summary="Delete existing categories",
     *     description="Deletes a record",
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          description="categories id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Successful operation.",
     *          @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *          response="404",
     *          description="No such categories.")
     * )
     */
    public function destroy(Category $category)
    {
        $user = auth('sanctum')->user();
        if ($user->id === $category->user_id) {
            $category->delete();

            return response()->json(['message' => 'success'], 200);
        } else {
            return response()->json(['Forbidden'], 403);
        }
    }
}
