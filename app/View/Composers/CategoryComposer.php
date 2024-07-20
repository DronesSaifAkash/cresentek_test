<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Category;

class CategoryComposer
{
    public function compose(View $view)
    {
        // Fetch all categories
        $categories = Category::all();
        // Bind the categories to the view
        $view->with('categories', $categories);
    }
}
