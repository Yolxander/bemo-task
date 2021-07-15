<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::all()->toArray();
        return array_reverse($cards);
    }

    public function store(Request $request)
    {

        $card = new Card([
            'name' => $request->input('name'),
        ]);

        $card->save();

        return response()->json('Card created!');
    }

    public function show($id)
    {
        $card = Card::find($id);
        return response()->json($card);
    }

    public function update($id, Request $request)
    {
        $card = Card::find($id);
        $card->update($request->all());

        return response()->json('Card updated!');
    }

    public function destroy($id)
    {
        $card = Card::find($id);
        $card->delete();

        return response()->json('Column deleted!');
    }
}
