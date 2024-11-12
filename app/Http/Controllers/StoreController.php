<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::with('user')->orderBy('id', 'desc')->get();
        return response()->json([
            'status' => true,
            'message' => 'store retrieval successful',
            'data' => $stores
        ]);
    }

    public function show(Store $store)
    {
        $store = Store::with('products')->find($store->id);
        return response()->json([
            'status' => true,
            'message' => 'store retrieval successful',
            'data' => $store
        ]);
    }

    public function store(Request $request)
    {
        $data = new Store();
        $rules = [
            'name' => 'required',
            'location' => 'required',
            'user_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'store addition failed',
                'data' => $validator->errors()
            ]);
        }
        if(Store::where('name', $request->name)->exists()){
            return response()->json([
                'status' => false,
                'message' => 'store addition failed, store name already exists',
            ]);
        }
        $data->name = $request->name;
        $data->location = $request->location;
        $data->user_id = $request->user_id;
        $data->save();
        return response()->json([
            'status' => true,
            'message' => 'store addition successful',
            'data' => $data
        ], 200);
    }

    public function update(Request $request, Store $store)
    {
        $rules = [
            'name' => 'required',
            'location' => 'required',
            'user_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'store data update failed',
                'data' => $validator->errors()
            ], 401);
        }

        $store->name = $request->name;
        $store->location = $request->location;
        $store->user_id = $request->user_id;
        $store->save();

        return response()->json([
            'status' => true,
            'message' => 'store data update successful',
            'data' => $store
        ], 200);
    }
    

    public function destroy(Store $store)
    {
        $store->delete();
        return response()->json([
            'status' => true,
            'message' => 'store data deletion successful',
            'data' => $store
        ], 200);
    }

    public function register(Request $request)
    {
        $data = new Store();
        $data->name = $request->name;
        $data->location = $request->location;
        $data->user_id = $request->user_id;
        $data->status = 'pending';
        $data->save();
        return response()->json([
            'status' => true,
            'message' => 'store registration successful',
            'data' => $data
        ], 200);
    }

    public function accStore(Store $store)
    {
        $store->status = 'active';
        $store->save();
        return response()->json([
            'status' => true,
            'message' => 'store activation successful',
            'data' => $store
        ], 200);
    }

    public function getStoreByUserId(User $user)
    {
        $store = Store::where('user_id', $user->id)->first();
        return response()->json([
            'status' => true,
            'message' => 'store retrieval successful',
            'data' => $store
        ]);
    }
}
