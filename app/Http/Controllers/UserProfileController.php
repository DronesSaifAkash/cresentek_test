<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function showUploadForm($id)
    {
        $user = User::findOrFail($id);
        return view('users.profile-picture', compact('user'));
    }


    public function updateProfilePicture(Request $request, $id)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }

            // Store the new profile picture
            $imageName = time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->storeAs('public', $imageName);
            $user->profile_picture = $imageName;
            $user->save();
        }

        return redirect()->back()->with('message', 'Profile picture updated successfully.');
    }
}
