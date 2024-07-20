<?php

use App\Http\Controllers\ExampleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\PostController;
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


Route::resource('posts', PostController::class);

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