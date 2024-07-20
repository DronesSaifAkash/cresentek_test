<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ExampleController extends Controller
{
    public function index()
    {
        $formattedDate = format_date('2024-07-22');
        $exampleText = example_function('example parameter');

        return view('myexample', compact('formattedDate', 'exampleText'));
    }

 
}
