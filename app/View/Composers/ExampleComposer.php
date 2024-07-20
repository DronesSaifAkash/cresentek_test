<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ExampleComposer
{
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
        // Dependencies are automatically resolved by the service container...
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        
        Log::info('ExampleComposer is executed.');
        $view->with('example_variable', 'This is an example variable.');
    }
}
