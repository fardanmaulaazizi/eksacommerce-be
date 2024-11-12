<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'login failed',
                'data' => $validator->errors()
            ], 401);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => false,
                'message' => 'login failed, account not found',
            ], 401);
        }

        $dataUser =
            User::where('email', $request->email)->first();
        if ($dataUser->role_id == 1) {
            $token = $dataUser->createToken('authToken', ['manage-applications'])->plainTextToken;
        } else {
            $token = $dataUser->createToken('authToken', [])->plainTextToken;
        }

        return response()->json([
            'status' => true,
            'message' => 'login successful',
            'token' => $token,
            'data' => $dataUser
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'logout successful',
        ], 200);
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'register failed',
                'data' => $validator->errors()
            ], 401);
        }
        if(User::where('email', $request->email)->exists()){
            return response()->json([
                'status' => false,
                'message' => 'register failed, email already exists',
            ], 401);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = "user";
        $user->save();
        $token = $user->createToken('authToken', [])->plainTextToken;
        return response()->json([
            'status' => true,
            'message' => 'register successful',
            'data' => $user,
            'token' => $token
        ], 200);
    }

    public function user(Request $request)
    {
        $user = $request->user()->load('store');

        return response()->json([
            'status' => true,
            'message' => 'User retrieval successful',
            'data' => $user
        ]);
    }

    public function updateAccount(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        if ($request->newPassword) {
            if (!password_verify($request->currentPassword, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Old password is incorrect',
                ], 200);
            }
            $user->password = bcrypt($request->newPassword);
        }
        $user->save();
        return response()->json([
            'status' => true,
            'message' => 'User update successful',
            'data' => $user
        ],200);
    }
}
