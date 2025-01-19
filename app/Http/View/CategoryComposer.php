<?php

namespace App\Http\View;
use Illuminate\View\View;
use App\Models\category;

class CategoryComposer
{
    public function compose(View $view){
        $view->with('categories', category::all());
    }
}