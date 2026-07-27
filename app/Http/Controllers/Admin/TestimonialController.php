<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Models\Product;
use App\Models\Testimonial;
use App\Traits\HandlesImageUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    use HandlesImageUploads;

    public function index(): View
    {
        $testimonials = Testimonial::with('product')->orderBy('sort_order')->paginate(15);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        $products = Product::orderBy('name')->get();

        return view('admin.testimonials.create', compact('products'));
    }

    public function store(TestimonialRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('customer_photo')) {
            $data['customer_photo'] = $this->storeImage($request->file('customer_photo'), 'testimonials');
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial): View
    {
        $products = Product::orderBy('name')->get();

        return view('admin.testimonials.edit', compact('testimonial', 'products'));
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('customer_photo')) {
            $this->deleteImage($testimonial->customer_photo);
            $data['customer_photo'] = $this->storeImage($request->file('customer_photo'), 'testimonials');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $this->deleteImage($testimonial->customer_photo);
        $testimonial->delete();

        return back()->with('success', 'Testimoni berhasil dihapus.');
    }
}
