<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        $faqs = Faq::orderBy('sort_order')->paginate(20);

        return view('admin.faqs.index', compact('faqs'));
    }

    public function create(): View
    {
        return view('admin.faqs.create');
    }

    public function store(FaqRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        Faq::create($data);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit(Faq $faq): View
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(FaqRequest $request, Faq $faq): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        $faq->update($data);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return back()->with('success', 'FAQ berhasil dihapus.');
    }
}
