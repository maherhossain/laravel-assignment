<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;
use Validator;

class FilmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Film::all();
        return response()->json($items);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'title'         => 'required',
            'description'   => 'required',
            'realeaseDate'  => 'required',
            'rating'        => 'required',
            'ticketPrice'   => 'required',
            'country'       => 'required',
            'genre'         => 'required'
        ]);
        if($validator->fails()){
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        } else{
            //create item
            $item = new Film;
            $item->title        = $request->input('title');
            $item->description  = $request->input('description');
            $item->realeaseDate = $request->input('realeaseDate');
            $item->rating       = $request->input('rating');
            $item->ticketPrice  = $request->input('ticketPrice');
            $item->country      = $request->input('country');
            $item->genre        = $request->input('genre');
            $item->save();

            return response()->json($item);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Film::find($id);
        return response()->json($item);
    }

 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = validator::make($request->all(),[
            'title'         => 'required',
            'description'   => 'required',
            'realeaseDate'  => 'required',
            'rating'        => 'required',
            'ticketPrice'   => 'required',
            'country'       => 'required',
            'genre'         => 'required'
        ]);
        
        if($validator->fails()){
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
        } else{
            //find item
            $item = Film::find($id);
            $item->title        = $request->input('title');
            $item->description  = $request->input('description');
            $item->realeaseDate = $request->input('realeaseDate');
            $item->rating       = $request->input('rating');
            $item->ticketPrice  = $request->input('ticketPrice');
            $item->country      = $request->input('country');
            $item->genre        = $request->input('genre');
            $item->save();

            return response()->json($item);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Film::find($id);
        $item->delete();

        $response = array('response' => 'Item Deleted Successfully', 'success' => true);
        return $response;
    }
}
