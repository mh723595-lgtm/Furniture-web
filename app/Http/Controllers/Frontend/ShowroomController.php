<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Showroom;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShowroomController extends Controller
{
    public function index(Request $request): View
    {
        $showrooms = Showroom::active()
            ->when($request->filled('city'), fn ($q) => $q->where('city', 'like', '%' . $request->city . '%'))
            ->orderBy('city')
            ->get();

        return view('frontend.showroom.index', compact('showrooms'));
    }

    public function show(Showroom $showroom): View
    {
        abort_unless($showroom->is_active, 404);

        $showroom->load('images');

        return view('frontend.showroom.show', compact('showroom'));
    }
}
