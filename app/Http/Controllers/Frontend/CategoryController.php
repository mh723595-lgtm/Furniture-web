<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(Category $category): View
    {
        abort_unless($category->is_active, 404);

        $products = $category->activeProducts()->latest()->paginate(12);
        $categories = Category::active()->withCount('activeProducts')->orderBy('sort_order')->get();

        return view('frontend.catalog.category', compact('category', 'products', 'categories'));
    }
}
