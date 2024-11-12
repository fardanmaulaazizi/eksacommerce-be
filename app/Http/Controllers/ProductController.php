<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\In;
use Ramsey\Uuid\Type\Integer;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'store', 'reviews'])->get();
        return response()->json([
            'status' => true,
            'message' => 'product retrieval successful',
            'data' => $products
        ]);
    }

    public function store(Request $request)
    {
        $data = new Product();
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required',
            'category_id' => 'required',
            'store_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'product addition failed, please enter correct data',
                'data' => $validator->errors()
            ], 401);
        }
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/products', 'public');
        }
        $data->name = $request->name;
        $data->description = $request->description;
        $data->image = isset($imagePath) ? $imagePath : null;
        $data->price = $request->price;
        $data->category_id = $request->category_id;
        $data->store_id = $request->store_id;
        $data->save();
        return response()->json([
            'status' => true,
            'message' => 'product addition successful',
            'data' => $data
        ], 200);
    }

    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'store_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'product addition failed, please enter correct data',
                'data' => $validator->errors()
            ], 401);
        }
        if ($request->image) {
            $imagePath = $request->file('image')->store('images/products', 'public');
            $product->image = $imagePath;
        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->store_id = $request->store_id;
        $product->save();
        return response()->json([
            'status' => true,
            'message' => 'product update successful',
            'data' => $product
        ], 200);
    }


    public function show(Product $product)
    {
        $product = Product::with(['category', 'store', 'reviews.user'])->find($product->id);
        return response()->json([
            'status' => true,
            'message' => 'product retrieval successful',
            'data' => $product
        ]);
    }

    public function productByCategory(Category $category)
    {
        $products = Product::with(['store', 'reviews'])->where('category_id', $category->id)->get();
        return response()->json([
            'status' => true,
            'message' => 'product retrieval successful',
            'data' => $products
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'status' => true,
            'message' => 'user data deletion successful',
            'data' => $product
        ], 200);
    }
}
