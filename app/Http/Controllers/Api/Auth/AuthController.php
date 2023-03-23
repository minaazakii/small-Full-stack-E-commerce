<?php

namespace App\Http\Controllers\api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\auth\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        return response()->json(
            [
                'message' => 'Register successfully',
            ],
            200
        );
    }
    public function login(Request $request)
    {
        $user = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if (!$user) {
            return response()->json(
                [
                    'error' => 'Invalid username or password'
                ],
                401
            );
        }
        $user = Auth::user();
        return response()->json(
            [
                'message' => 'Login successful',
                'user'=>$user,
            ],200);
    }
}
