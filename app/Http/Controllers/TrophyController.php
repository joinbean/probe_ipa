<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Trophy;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TrophyController extends Controller
{
    /**
     * @OA\Get(
     *     path="/trophies",
     *     tags={"Trophies"},
     *     summary="Get list of trophies",
     *     description="Returns list of trophies",
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
            $user->trophies
        ]);
    }

    /**
     * @OA\Post(
     *     path="/trophies",
     *     tags={"Trophies"},
     *     summary="Store new trophies",
     *     description="Returns trophies data",
     *     security={{"bearer_token":{}}},
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                @OA\Property(
     *                    property="type_id",
     *                    type="integer"
     *                ),
     *                @OA\Property(
     *                    property="title",
     *                    type="string"
     *                ),
     *                @OA\Property(
     *                    property="ranking",
     *                    type="integer"
     *                ),
     *                @OA\Property(
     *                    property="date",
     *                    type="date"
     *                ),
     *                @OA\Property(
     *                    property="category_id",
     *                    type="integer"
     *                ),
     *                 @OA\Property(
     *                    property="place",
     *                    type="string"
     *                ),
     *                 @OA\Property(
     *                    property="oponent",
     *                    type="string"
     *                ),
     *                 @OA\Property(
     *                    property="score",
     *                    type="string"
     *                ),
     *                 @OA\Property(
     *                    property="price",
     *                    type="integer"
     *                ),
     *                 @OA\Property(
     *                    property="club_name",
     *                    type="string"
     *                ),
     *                 @OA\Property(
     *                    property="image",
     *                    type="file"
     *                ),
     *                example={
     *                      "type_id": "1", 
     *                      "title": "Tournament",
     *                      "ranking": "1",
     *                      "date": "2000-01-01",
     *                      "category_id": "1",
     *                      "place": "New York",
     *                      "oponent": "Bad Guys",
     *                      "score": "80/0",
     *                      "price": "50000",
     *                      "club_name": "NY Sports Club",
     *                      "image": "image.jpg"
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
            'type_id' => 'required|exists:types,id',
            'title' => 'required|string|max:255',
            'ranking' => 'required|integer',
            'date' => 'required|date',
            'category_id' => 'exists:categories,id',
            'place' => 'required|string|max:255',
            'oponent' => 'required|string|max:255',
            'score' => 'required|string|max:255',
            'price' => 'required|integer',
            'club_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $user = auth('sanctum')->user();
        $category = Category::where('id', '=', $validated['category_id'])->first();
        if ($category->user_id !== $user->id) {
            return response()->json(['Forbidden'], 403);
        } 

        $image_path = $request->file('image')->store('image', 'public');

        $trophy = new Trophy();

        $trophy->user_id = auth('sanctum')->user()->id;
        $trophy->type_id = $validated['type_id'];
        $trophy->type_id = $validated['type_id'];
        $trophy->title = $validated['title'];
        $trophy->ranking = $validated['ranking'];
        $trophy->date = $validated['date'];
        $trophy->category_id = array_key_exists('category_id', $validated) ? $validated['category_id'] : null;
        $trophy->place = $validated['place'];
        $trophy->oponent = $validated['oponent'];
        $trophy->score = $validated['score'];
        $trophy->price = $validated['price'];
        $trophy->club_name = $validated['club_name'];
        $trophy->image = $image_path;

        $trophy->save();

        return response()->json(['message' => 'success'], 200);
    }

    /**
     * @OA\Get(
     *     path="/trophies/{id}",
     *     tags={"Trophies"},
     *     summary="Get trophies information",
     *     description="Returns trophies data",
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          description="trophies id",
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
     *              @OA\Examples(example="result", value={
     *                      "id": 1, 
     *                      "type_id": "1", 
     *                      "title": "Tournament",
     *                      "ranking": "1",
     *                      "date": "2000-01-01",
     *                      "category_id": "1",
     *                      "place": "New York",
     *                      "oponent": "Bad Guys",
     *                      "score": "80/0",
     *                      "price": "50000",
     *                      "club_name": "NY Sports Club",
     *                      "image": "image.jpg",
     *                      "created_at": "2022-07-29 07:53:36", 
     *                      "updated_at": "2022-07-29 07:53:36"
     *              }, summary="A trophies.")
     *          )
     *     )
     * )
     */
    public function show(Trophy $trophy)
    {
        $user = auth('sanctum')->user();
        if ($user->id === $trophy->user_id) {
            return response()->json([$trophy]);
        } else {
            return response()->json(['Forbidden'], 403);
        }
    }

    /**
     * @OA\Put(
     *     path="/trophies/{id}",
     *     tags={"Trophies"},
     *     summary="Update trophy information",
     *     description="Updates trophy data",
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          description="trophy id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                @OA\Property(
     *                    property="type_id",
     *                    type="integer"
     *                ),
     *                @OA\Property(
     *                    property="title",
     *                    type="string"
     *                ),
     *                @OA\Property(
     *                    property="ranking",
     *                    type="integer"
     *                ),
     *                @OA\Property(
     *                    property="date",
     *                    type="date"
     *                ),
     *                @OA\Property(
     *                    property="category_id",
     *                    type="integer"
     *                ),
     *                 @OA\Property(
     *                    property="place",
     *                    type="string"
     *                ),
     *                 @OA\Property(
     *                    property="oponent",
     *                    type="string"
     *                ),
     *                 @OA\Property(
     *                    property="score",
     *                    type="string"
     *                ),
     *                 @OA\Property(
     *                    property="price",
     *                    type="integer"
     *                ),
     *                 @OA\Property(
     *                    property="club_name",
     *                    type="string"
     *                ),
     *                 @OA\Property(
     *                    property="image",
     *                    type="file"
     *                ),
     *                example={
     *                      "type_id": "1", 
     *                      "title": "Tournament",
     *                      "ranking": "1",
     *                      "date": "2000-01-01",
     *                      "category_id": "1",
     *                      "place": "New York",
     *                      "oponent": "Bad Guys",
     *                      "score": "80/0",
     *                      "price": "50000",
     *                      "club_name": "NY Sports Club",
     *                      "image": "image.jpg"
     *                }
     *              )
     *              
     *          )
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Successful operation.",
     *          @OA\JsonContent(
     *              @OA\Examples(example="result", value={
     *                      "id": 1, 
     *                      "type_id": "1", 
     *                      "title": "Tournament",
     *                      "ranking": "1",
     *                      "date": "2000-01-01",
     *                      "category_id": "1",
     *                      "place": "New York",
     *                      "oponent": "Bad Guys",
     *                      "score": "80/0",
     *                      "price": "50000",
     *                      "club_name": "NY Sports Club",
     *                      "image": "image.jpg",
     *                      "created_at": "2022-07-29 07:53:36", 
     *                      "updated_at": "2022-07-29 07:53:36"
     *              }, summary="A trophies.")
     *          )
     *     ),
     *     @OA\Response(
     *          response="422",
     *          description="The given data was invalid.")
     * )
     */
    public function update(Request $request, Trophy $trophy)
    {
        $validated = $request->validate([
            'type_id' => 'exists:types,id',
            'title' => 'string|max:255',
            'ranking' => 'integer',
            'date' => 'date',
            'category_id' => 'exists:categories,id',
            'place' => 'string|max:255',
            'oponent' => 'string|max:255',
            'score' => 'string|max:255',
            'price' => 'integer',
            'club_name' => 'string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $trophy = $trophy;

        $user = auth('sanctum')->user();
        if ($user->id !== $trophy->user_id) {
            return response()->json(['Forbidden'], 403);
        }
        
        $trophy->type_id        = array_key_exists('type_id', $validated)       ? $validated['type_id']     : $trophy->type_id;
        $trophy->title          = array_key_exists('title', $validated)         ? $validated['title']       : $trophy->title;
        $trophy->ranking        = array_key_exists('ranking', $validated)       ? $validated['ranking']     : $trophy->ranking;
        $trophy->date           = array_key_exists('date', $validated)          ? $validated['date']        : $trophy->date;
        $trophy->category_id    = array_key_exists('category_id', $validated)   ? $validated['category_id'] : $trophy->category_id;
        $trophy->place          = array_key_exists('place', $validated)         ? $validated['place']       : $trophy->place;
        $trophy->oponent        = array_key_exists('oponent', $validated)       ? $validated['oponent']     : $trophy->oponent;
        $trophy->score          = array_key_exists('score', $validated)         ? $validated['score']       : $trophy->score;
        $trophy->price          = array_key_exists('price', $validated)         ? $validated['price']       : $trophy->price;
        $trophy->club_name      = array_key_exists('club_name', $validated)     ? $validated['club_name']   : $trophy->club_name;

        if (array_key_exists('image', $validated)) {
            $image_path = $request->file('image')->store('image', 'public');
            $trophy->image = $image_path;
        }

        if ($trophy->category_id !== null) {
            if (!Category::where('id', '=', $trophy->category_id)->exists()) {
                $trophy->category_id = null;
            }
            $category = Category::where('id', '=', $trophy->category_id)->first();
            if ($category->user_id !== $user->id) {
                return response()->json(['Forbidden'], 403);
            } 
        }
        
        
        $trophy->update();

        return response()->json(['message' => 'success'], 200);
    }

    /**
     * @OA\Delete(
     *     path="/trophies/{id}",
     *     tags={"Trophies"},
     *     summary="Delete existing trophy",
     *     description="Deletes a record",
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          description="trophy id",
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
     *          description="No such trophy.")
     * )
     */
    public function destroy(Trophy $trophy)
    {
        $user = auth('sanctum')->user();
        if ($user->id === $trophy->user_id) {
            $trophy->delete();

            return response()->json(['message' => 'success'], 200);
        } else {
            return response()->json(['Forbidden'], 403);
        }
    }

    /**
     * @OA\Get(
     *     path="/trophies/sortByDate",
     *     tags={"Trophies"},
     *     summary="Get trophies information",
     *     description="Returns trophies data",
     *     security={{"bearer_token":{}}},
     *     @OA\Response(
     *          response="200", 
     *          description="Successful operation.",
     *          @OA\JsonContent(
     *              @OA\Examples(example="result", value={
     *                      "id": 1, 
     *                      "type_id": "1", 
     *                      "title": "Tournament",
     *                      "ranking": "1",
     *                      "date": "2000-01-01",
     *                      "category_id": "1",
     *                      "place": "New York",
     *                      "oponent": "Bad Guys",
     *                      "score": "80/0",
     *                      "price": "50000",
     *                      "club_name": "NY Sports Club",
     *                      "image": "image.jpg",
     *                      "created_at": "2022-07-29 07:53:36", 
     *                      "updated_at": "2022-07-29 07:53:36"
     *              }, summary="A trophies.")
     *          )
     *     )
     * )
     */
    public function sortByDate()
    {
        $user = auth('sanctum')->user();
        return $user->trophies->sortBy('date')->values()->all();
    }

    /**
     * @OA\Get(
     *     path="/trophies/sortByRank",
     *     tags={"Trophies"},
     *     summary="Get trophies information",
     *     description="Returns trophies data",
     *     security={{"bearer_token":{}}},
     *     @OA\Response(
     *          response="200", 
     *          description="Successful operation.",
     *          @OA\JsonContent(
     *              @OA\Examples(example="result", value={
     *                      "id": 1, 
     *                      "type_id": "1", 
     *                      "title": "Tournament",
     *                      "ranking": "1",
     *                      "date": "2000-01-01",
     *                      "category_id": "1",
     *                      "place": "New York",
     *                      "oponent": "Bad Guys",
     *                      "score": "80/0",
     *                      "price": "50000",
     *                      "club_name": "NY Sports Club",
     *                      "image": "image.jpg",
     *                      "created_at": "2022-07-29 07:53:36", 
     *                      "updated_at": "2022-07-29 07:53:36"
     *              }, summary="A trophies.")
     *          )
     *     )
     * )
     */
    public function sortByRank()
    {
        $user = auth('sanctum')->user();
        return $user->trophies->sortBy('ranking')->values()->all();
    }

    /**
     * @OA\Get(
     *     path="/trophies/filterByType/{id}",
     *     tags={"Trophies"},
     *     summary="Get trophies information",
     *     description="Returns trophies data",
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          description="type id",
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
     *              @OA\Examples(example="result", value={
     *                      "id": 1, 
     *                      "type_id": "1", 
     *                      "title": "Tournament",
     *                      "ranking": "1",
     *                      "date": "2000-01-01",
     *                      "category_id": "1",
     *                      "place": "New York",
     *                      "oponent": "Bad Guys",
     *                      "score": "80/0",
     *                      "price": "50000",
     *                      "club_name": "NY Sports Club",
     *                      "image": "image.jpg",
     *                      "created_at": "2022-07-29 07:53:36", 
     *                      "updated_at": "2022-07-29 07:53:36"
     *              }, summary="A trophies.")
     *          )
     *     )
     * )
     */
    public function filterByType(Type $type)
    {
        $user = auth('sanctum')->user();
        return $type->trophies->where('user_id', '=', $user->id);
    }

    /**
     * @OA\Get(
     *     path="/trophies/filterByRank/{rank}",
     *     tags={"Trophies"},
     *     summary="Get trophies information",
     *     description="Returns trophies data",
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *          name="rank",
     *          description="rank value",
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
     *              @OA\Examples(example="result", value={
     *                      "id": 1, 
     *                      "type_id": "1", 
     *                      "title": "Tournament",
     *                      "ranking": "1",
     *                      "date": "2000-01-01",
     *                      "category_id": "1",
     *                      "place": "New York",
     *                      "oponent": "Bad Guys",
     *                      "score": "80/0",
     *                      "price": "50000",
     *                      "club_name": "NY Sports Club",
     *                      "image": "image.jpg",
     *                      "created_at": "2022-07-29 07:53:36", 
     *                      "updated_at": "2022-07-29 07:53:36"
     *              }, summary="A trophies.")
     *          )
     *     )
     * )
     */
    public function filterByRank(Request $request, $rank)
    {
        $user = auth('sanctum')->user();
        return response()->json([Trophy::where('user_id', '=', $user->id)->where('ranking', '=', $rank)->get()]);
        return ;
    }

    /**
     * @OA\Get(
     *     path="/trophies/filterByCategory/{id}",
     *     tags={"Trophies"},
     *     summary="Get trophies information",
     *     description="Returns trophies data",
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
     *              @OA\Examples(example="result", value={
     *                      "id": 1, 
     *                      "type_id": "1", 
     *                      "title": "Tournament",
     *                      "ranking": "1",
     *                      "date": "2000-01-01",
     *                      "category_id": "1",
     *                      "place": "New York",
     *                      "oponent": "Bad Guys",
     *                      "score": "80/0",
     *                      "price": "50000",
     *                      "club_name": "NY Sports Club",
     *                      "image": "image.jpg",
     *                      "created_at": "2022-07-29 07:53:36", 
     *                      "updated_at": "2022-07-29 07:53:36"
     *              }, summary="A trophies.")
     *          )
     *     )
     * )
     */
    public function filterByCategory(Category $category)
    {
        return Trophy::where('category_id', '=', $category->id)->get();
    }
}
