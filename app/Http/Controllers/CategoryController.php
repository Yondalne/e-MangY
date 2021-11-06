<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store()
    {
        if(auth()->user()->admin != 1){
            return back();
        }

        Category::create([
            'label' => 'Josei'
        ]);
        Category::create([
            'label' => 'Kodomo'
        ]);
        Category::create([
            'label' => 'Shonen'
        ]);
        Category::create([
            'label' => 'Seinen'
        ]);
        Category::create([
            'label' => 'Shojo'
        ]);

        return 'saved';
    }
}
