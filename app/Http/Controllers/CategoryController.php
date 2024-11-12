<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return response()->json([
            'status' => true,
            'message' => 'category retrieval successful',
            'data' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $data = new Category();
        $rules = [
            'name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'category addition failed',
                'data' => $validator->errors()
            ], 401);
        }

        $data->name = $request->name;
        $data->save();
        return response()->json([
            'status' => true,
            'message' => 'category addition successful',
            'data' => $data
        ], 200);
    }

    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'category data update failed',
                'data' => $validator->errors()
            ], 401);
        }

        $category->name = $request->name;
        $category->save();

        return response()->json([
            'status' => true,
            'message' => 'category data update successful',
            'data' => $category
        ], 200);
    }

    public function show(Category $category)
    {
        return response()->json([
            'status' => true,
            'message' => 'category data retrieval successful',
            'data' => $category->with('products')->find($category->id)
        ], 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'status' => true,
            'message' => 'category data deletion successful',
            'data' => $category
        ], 200);
    }
}
