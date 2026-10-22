<?php

namespace App\Http\Controllers;

use App\Models\Category;

class UserCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('books')->get();

        return view('users.category', [
            'categories' => $categories,
        ]);
    }
}