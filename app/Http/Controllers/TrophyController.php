<?php

namespace App\Http\Controllers;

use App\Models\Trophy;
use Illuminate\Http\Request;

class TrophyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth('sanctum')->user();
        return response()->json([
            $user->trophies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * Display the specified resource.
     *
     * @param  \App\Models\Trophy  $trophy
     * @return \Illuminate\Http\Response
     */
    public function show(Trophy $trophy)
    {
        return response()->json([$trophy]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trophy  $trophy
     * @return \Illuminate\Http\Response
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
        
        $trophy->update();

        return response()->json(['message' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trophy  $trophy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trophy $trophy)
    {
        $trophy->delete();

        return response()->json(['message' => 'success'], 200);
    }
}
