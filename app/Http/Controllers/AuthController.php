<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $user = Auth::user();
            $token = $user->createToken('Personal Access Token')->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => $user,
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);

        /*  it returns
        {
            "token": "1|mjYrQFloqDvonMvMp3fstaGB6VqZS8ySoASLOfTVe4727bcb",
            "user": {
                "id": 1,
                "name": "User 1",
                "email": "user1@example.com",
                "email_verified_at": null,
                "created_at": "2024-07-19T15:17:13.000000Z",
                "updated_at": "2024-07-19T15:17:13.000000Z",
                "is_deleted": null,
                "profile_picture": null
            }
        }
        
        */
    }
}