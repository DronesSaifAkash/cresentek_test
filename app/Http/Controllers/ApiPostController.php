<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class ApiPostController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $posts = $user->posts;

        return response()->json($posts);
    }
}
