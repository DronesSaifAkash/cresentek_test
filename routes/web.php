<?php


use Illuminate\Validation\ValidationException;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Point no 3:
Route::get('/fetch-users', function () {
    DB::table('users')->orderBy('id')->chunk(1000, function ($users) {
        foreach ($users as $user) {
            // dd($users); // This will output the first chunk of users and stop execution, allowing you to see the data structure.
            echo $user->id . ': ' . $user->name . '<br>';
        }
    });
});


Route::resource('posts', PostController::class)->middleware('auth');

Route::get('example-index', [ExampleController::class, 'index']);

Route::get('/test-view-composer', function () {
    return view('test');
});

Route::get('/myapp-view-composer', function () {
    return view('myapp');
});

Route::middleware(['simple'])->group(function () {
    Route::get('/fetch-users-with-posts-comments', function () {
        $users = User::with(['posts', 'comments'])->paginate(100); // 100 users per page

        return response()->json($users);
    });
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Assuming you have a view at resources/views/admin/dashboard.blade.php
    })->name('admindashboard');
});


// Point No 16.
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users/{user}/delete', [UserController::class, 'softDelete'])->name('users.softDelete');

// Point No 17.
Route::get('/user/name', function () {
    return response()->json(['name' => User::find(1)->name]);
});

Route::get('/user/latest-phone/{id}', [UserController::class, 'showLatestPhone']);
Route::post('/user/{id}/phone', [UserController::class, 'savePhone']);
// {"message":"Failed to save phone number"} using postman and content-type : applicatin/json


Route::post('/user/{id}/update-password', function (Request $request, $id) {
    try{

        $validatedData = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);
   
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->password = $validatedData['password'];
        $user->save();

        return response()->json(['message' => 'Password updated successfully']);
    } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422);
    }
});


// point no 21
Route::get('/show-first-last', function () {
    $items = ['Apple', 'Banana', 'Cherry', 'Date', 'Elderberry'];

    return view('show-first-last', compact('items'));
});


Route::get('/user/{id}/profile-picture', [UserProfileController::class, 'showUploadForm']);
Route::post('/user/{id}/profile-picture', [UserProfileController::class, 'updateProfilePicture']);

// Point no 24.
Route::get('/user-count', [UserController::class, 'getUserCount']);

// Point no 25.
Route::get('/max-comments-per-user', [UserController::class, 'showMaxCommentsPerUser']);
