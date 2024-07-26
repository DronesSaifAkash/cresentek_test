<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiPostController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [AuthController::class, 'login']);
// for all user email is user.$n where n >=1 & <= 100000: {
//     "email": "user{$n}@example.com",
//     "password": "password"
// }


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/posts', [ApiPostController::class, 'index']);
    
    Route::get('/user/email', function (Request $request) {
        return response()->json([
            'email' => $request->user()->email,
        ]);
    });

    Route::post('/user/{id}/profile-picture', [UserProfileController::class, 'updateProfilePicture']);
});



