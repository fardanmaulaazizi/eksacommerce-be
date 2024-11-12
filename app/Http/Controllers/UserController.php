<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return response()->json([
            'status' => true,
            'message' => 'user retrieval successful',
            'data' => $users
        ]);
    }

    public function store(Request $request)
    {
        $data = new User();
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'user addition failed',
                'data' => $validator->errors()
            ], 401);
        }

        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->role = $request->role;
        $data->save();
        return response()->json([
            'status' => true,
            'message' => 'user addition successful',
            'data' => $data
        ], 200);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'user data update failed',
                'data' => $validator->errors()
            ], 401);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'user data update successful',
            'data' => $user
        ], 200);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'status' => true,
            'message' => 'user data deletion successful',
            'data' => $user
        ], 200);
    }
}
