<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactRequest;
use App\Models\Faq;
use App\Models\Showroom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('frontend.about');
    }

    public function faq(): View
    {
        $faqs = Faq::active()->get()->groupBy('category');

        return view('frontend.faq', compact('faqs'));
    }

    public function contact(): View
    {
        $showrooms = Showroom::active()->get();

        return view('frontend.contact', compact('showrooms'));
    }

    public function submitContact(ContactRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Log::info('New contact form submission', $validated);

        return back()->with('success', 'Pesan Anda berhasil dikirim. Tim kami akan segera menghubungi Anda.');
    }

    public function privacyPolicy(): View
    {
        return view('frontend.privacy-policy');
    }
}
