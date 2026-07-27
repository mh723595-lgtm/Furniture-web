<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Showroom;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $banners = Banner::active()->get();
        $categories = Category::active()->withCount('activeProducts')->orderBy('sort_order')->take(8)->get();
        $featuredProducts = Product::active()->featured()->with('category')->latest()->take(8)->get();
        $bestSellers = Product::active()->bestSeller()->with('category')->latest()->take(8)->get();
        $galleries = Gallery::active()->orderByDesc('id')->take(8)->get();
        $showrooms = Showroom::active()->take(3)->get();
        $testimonials = Testimonial::active()->take(6)->get();
        $faqs = Faq::active()->take(6)->get();

        return view('frontend.home', compact(
            'banners', 'categories', 'featuredProducts', 'bestSellers',
            'galleries', 'showrooms', 'testimonials', 'faqs'
        ));
    }
}
