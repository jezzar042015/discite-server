<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => User::all()
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json([
                'data' => $user
            ]);
        }

        return response()->json([
            'message' => "User couldn't be found"
        ], 404);
    }

    public function register(Request $request): JsonResponse
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        return response()->json(
            ['data' => $success]
        );
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email','password');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                $success['token'] = $user->createToken('MyApp')->plainTextToken;
                $success['name'] = $user->name;

                return response()->json(['data' => $success]);
            } else {
                return response()->json(['message' => 'Unauthorised.'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Server Error', 'error' => $e->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'You have been successfully logged out.'], 200);
    }


    public function destroy($id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            $user->delete();
            return [
                'message' => 'deleted'
            ];
        }

        return response()->json([
            'message' => 'user not found'
        ], 404);
    }
}
