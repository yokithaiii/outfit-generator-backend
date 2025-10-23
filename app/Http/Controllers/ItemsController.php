<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return response()->json(['data' => $items], 200);
    }

    public function show(Item $item)
    {
        return response()->json(['data' => $item], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'string|required',
            'image_url' => 'string|required',
        ]);

        $validatedData['user_id'] = $request->user()?->id ?? '019a0e38-8865-716f-bdf0-d2996366c87f';
        $item = Item::query()->create($validatedData);

        return response()->json(['data' => $item], 201);
    }

    public function update(Item $item, Request $request)
    {

    }

    public function destroy(Item $item)
    {
        $item->delete();

        return response()->json(['message' => 'Item deleted'], 200);
    }
}
