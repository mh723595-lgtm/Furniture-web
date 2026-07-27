<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Showroom;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::active()->count(),
            'total_categories' => Category::count(),
            'total_showrooms' => Showroom::count(),
            'total_testimonials' => Testimonial::count(),
            'out_of_stock' => Product::where('stock', 0)->count(),
        ];

        $latestProducts = Product::with('category')->latest()->take(5)->get();
        $mostViewed = Product::orderByDesc('views')->take(5)->get();

        return view('admin.dashboard.index', compact('stats', 'latestProducts', 'mostViewed'));
    }
}
