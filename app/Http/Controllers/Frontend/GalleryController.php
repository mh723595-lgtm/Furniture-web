<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::active()->with('product')->orderByDesc('id')->paginate(16);

        return view('frontend.gallery', compact('galleries'));
    }
}
