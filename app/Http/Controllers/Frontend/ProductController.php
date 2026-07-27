<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function show(Product $product): View
    {
        abort_unless($product->status === 'active', 404);

        $product->increment('views');
        $product->load(['images', 'category', 'testimonials' => fn ($q) => $q->active()]);

        $relatedProducts = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('frontend.catalog.product', compact('product', 'relatedProducts'));
    }
}
