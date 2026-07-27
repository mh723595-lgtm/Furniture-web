<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Showroom;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap(): Response
    {
        $products = Product::active()->select('slug', 'updated_at')->get();
        $categories = Category::active()->select('slug', 'updated_at')->get();
        $showrooms = Showroom::active()->select('slug', 'updated_at')->get();

        $content = view('seo.sitemap', compact('products', 'categories', 'showrooms'))->render();

        return response($content, 200)->header('Content-Type', 'text/xml');
    }

    public function robots(): Response
    {
        $content = view('seo.robots')->render();

        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
