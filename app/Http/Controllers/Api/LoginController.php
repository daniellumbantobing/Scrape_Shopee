<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            return (new UserResource($user))->additional(
                [
                    'meta' => [
                        'token' => $user->api_token,
                    ],
                ]
            );
        }

        return response()->json([
            'message' => 'Your credential not match'
        ], 401);
    }

    public function profile()
    {
        $user = auth()->user();

        return new UserResource($user);
    }
}