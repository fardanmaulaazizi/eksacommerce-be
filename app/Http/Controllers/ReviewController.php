<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'product'])->get();
        return response()->json([
            'status' => true,
            'message' => 'review retrieval successful',
            'data' => $reviews
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'product_id' => 'required',
            'comment' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'review addition failed',
                'data' => $validator->errors()
            ], 401);
        }
        $data = new Review();
        $data->user_id = $request->user_id;
        $data->product_id = $request->product_id;
        $data->comment = $request->comment;
        $data->save();
        return response()->json([
            'status' => true,
            'message' => 'review addition successful',
            'data' => $data
        ], 200);
    }

    public function update(Request $request, Review $review)
    {
        $rules = [
            'user_id' => 'required',
            'product_id' => 'required',
            'comment' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'review data update failed',
                'data' => $validator->errors()
            ], 401);
        }

        $review->user_id = $request->user_id;
        $review->product_id = $request->product_id;
        $review->comment = $request->comment;
        $review->save();

        return response()->json([
            'status' => true,
            'message' => 'review data update successful',
            'data' => $review
        ], 200);
    }

    public function reviewByStoreId($storeId){
        $store = Store::where('id', $storeId)->first();
        $products = $store->products;
        $reviews = [];
        foreach($products as $product){
            foreach($product->reviews as $review){
                $reviews[] = (object)[
                    $user = User::where('id', $review->user_id)->first(),
                    'id' => $review->id,
                    'product' => $product->name,
                    'user' => $user->name,
                    'comment' => $review->comment
                ];
            }  
        }
        return response()->json([
            'status' => true,
            'message' => 'review data update successful',
            'data' => $reviews
        ], 200);
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json([
            'status' => true,
            'message' => 'user data deletion successful',
            'data' => $review
        ], 200);
    }
}
