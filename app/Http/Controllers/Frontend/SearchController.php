<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $request->validate(['q' => ['nullable', 'string', 'max:255']]);

        $keyword = $request->input('q');

        $products = Product::active()
            ->with('category')
            ->when($keyword, function ($q) use ($keyword) {
                $q->where(function ($sub) use ($keyword) {
                    $sub->where('name', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%")
                        ->orWhere('material', 'like', "%{$keyword}%")
                        ->orWhere('color', 'like', "%{$keyword}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('frontend.search', compact('products', 'keyword'));
    }
}
