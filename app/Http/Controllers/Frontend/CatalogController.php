<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::active()
            ->with('category')
            ->when($request->filled('category'), fn ($q) => $q->whereHas('category', fn ($c) => $c->where('slug', $request->category)))
            ->when($request->filled('material'), fn ($q) => $q->where('material', 'like', '%' . $request->material . '%'))
            ->when($request->filled('color'), fn ($q) => $q->where('color', 'like', '%' . $request->color . '%'))
            ->when($request->filled('min_price'), fn ($q) => $q->where('price', '>=', $request->min_price))
            ->when($request->filled('max_price'), fn ($q) => $q->where('price', '<=', $request->max_price))
            ->when($request->filled('sort'), function ($q) use ($request) {
                match ($request->sort) {
                    'price_asc' => $q->orderBy('price', 'asc'),
                    'price_desc' => $q->orderBy('price', 'desc'),
                    'newest' => $q->latest(),
                    'popular' => $q->orderByDesc('views'),
                    default => $q->latest(),
                };
            }, fn ($q) => $q->latest())
            ->paginate(12)
            ->withQueryString();

        $categories = Category::active()->withCount('activeProducts')->orderBy('sort_order')->get();

        return view('frontend.catalog.index', compact('products', 'categories'));
    }
}
