<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Models\Gallery;
use App\Models\Product;
use App\Traits\HandlesImageUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryController extends Controller
{
    use HandlesImageUploads;

    public function index(): View
    {
        $galleries = Gallery::with('product')->orderByDesc('id')->paginate(20);

        return view('admin.galleries.index', compact('galleries'));
    }

    public function create(): View
    {
        $products = Product::orderBy('name')->get();

        return view('admin.galleries.create', compact('products'));
    }

    public function store(GalleryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        $data['image_path'] = $this->storeImage($request->file('image'), 'galleries');

        Gallery::create($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery): View
    {
        $products = Product::orderBy('name')->get();

        return view('admin.galleries.edit', compact('gallery', 'products'));
    }

    public function update(GalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $this->deleteImage($gallery->image_path);
            $data['image_path'] = $this->storeImage($request->file('image'), 'galleries');
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        $this->deleteImage($gallery->image_path);
        $gallery->delete();

        return back()->with('success', 'Galeri berhasil dihapus.');
    }
}
