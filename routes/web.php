<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



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

