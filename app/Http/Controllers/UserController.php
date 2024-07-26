<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::notDeleted()->paginate(100);
        return view('users.index', compact('users'));
    }

    public function softDelete(User $user)
    {
        $user->softDelete();
        return redirect()->route('users.index')->with('success', 'User soft deleted successfully.');
    }

    // point no 18.
    public function showLatestPhone($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $latestPhone = $user->latestPhone();

        if (!$latestPhone) {
            return response()->json(['message' => 'No phone number found for this user'], 404);
        }

        return response()->json(['phone_number' => $latestPhone]);
    }


    public function savePhone(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $request->validate([
            'phone_number' => 'required|string|max:255',
        ]);

        $phoneNumber = $request->input('phone_number');

        if ($user->saveLatestPhone($phoneNumber)) {
            return response()->json(['message' => 'Phone number saved successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to save phone number'], 500);
        }
    }


    public function updatePassword(Request $request, $id)
    {
        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Validate the request
        $validatedData = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Update the password
        $user->password = $validatedData['password'];
        $user->save();

        return response()->json(['message' => 'Password updated successfully']);
    }


    public function getUserCount()
    {
        $userCount = User::count();
        return response()->json(['total_users' => $userCount]);
    }

    public function showMaxCommentsPerUser()
    {
        $users = User::with('comments')->get();

        $maxComments = $users->max(function ($user) {
            return $user->comments->count();
        });

        return view('users.max-comments', compact('users', 'maxComments'));
    }
}