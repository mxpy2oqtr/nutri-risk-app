<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        return response()->json($foods);
    }

    public function store(Request $request)
    {
        $food = Food::create($request->all());
        return response()->json($food, 201);
    }

    public function show(string $id)
    {
        $food = Food::find($id);
        
        if (!$food) {
            return response()->json(['error' => 'Food not found'], 404);
        }
        
        return response()->json($food);
    }

    public function update(Request $request, string $id)
    {
        $food = Food::find($id);
        
        if (!$food) {
            return response()->json(['error' => 'Food not found'], 404);
        }
        
        $food->update($request->all());
        return response()->json($food);
    }

    public function destroy(string $id)
    {
        $food = Food::find($id);
        
        if (!$food) {
            return response()->json(['error' => 'Food not found'], 404);
        }
        
        $food->delete();
        return response()->json(null, 204);
    }
}