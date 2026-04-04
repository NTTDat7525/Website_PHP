<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index() {
        return response()->json(Food::all(), 200);
    }

    public function show($id) {
        return response()->json(Food::findOrFail($id), 200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'nullable|string',
        ]);
        $food = Food::create($validated);
        return response()->json($food, 201);
    }

    public function update(Request $request, $id) {
        $food = Food::findOrFail($id);
        $food->update($request->all());
        return response()->json($food, 200);
    }

    public function destroy($id) {
        Food::destroy($id);
        return response()->json(['message' => 'Xóa món ăn thành công'], 200);
    }
}