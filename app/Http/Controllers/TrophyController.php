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
        return response()->json([
            Trophy::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image_path = $request->file('image')->store('image', 'public');

        $trophy = new Trophy();

        $trophy->user_id = auth('sanctum')->user()->id;
        $trophy->type_id = $request->type_id;
        $trophy->title = $request->title;
        $trophy->ranking = $request->ranking;
        $trophy->date = $request->date;
        $trophy->type_id = $request->type_id;
        $trophy->place = $request->place;
        $trophy->oponent = $request->oponent;
        $trophy->score = $request->score;
        $trophy->price = $request->price;
        $trophy->club_name = $request->club_name;
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trophy  $trophy
     * @return \Illuminate\Http\Response
     */
    public function edit(Trophy $trophy)
    {
        //
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
        $trophy->update([
            'name' => $request->name != null ? $request->name : $trophy->name,
            'type_id' => $request->type_id != null ? $request->type_id : $trophy->type_id,
            'title' => $request->title != null ? $request->title : $trophy->title,
            'ranking' => $request->ranking != null ? $request->ranking : $trophy->ranking,
            'date' => $request->date != null ? $request->date : $trophy->date,
            'category_id' => $request->type_id != null ? $request->type_id : null,  
            'place' => $request->place != null ? $request->place : $trophy->place,
            'oponent' => $request->oponent != null ? $request->oponent : $trophy->oponent,
            'score' => $request->score != null ? $request->score : $trophy->score,
            'price' => $request->price != null ? $request->price : $trophy->price,
            'club_name' => $request->club_name != null ? $request->club_name : $trophy->club_name,
        ]);

        $trophy->save();

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
