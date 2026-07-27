<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use App\Traits\HandlesImageUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    use HandlesImageUploads;

    public function index(): View
    {
        $categories = Category::withCount('products')->orderBy('sort_order')->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['name'], Category::class);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->storeImage($request->file('thumbnail'), 'categories');
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['name'], Category::class, $category->id);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            $this->deleteImage($category->thumbnail);
            $data['thumbnail'] = $this->storeImage($request->file('thumbnail'), 'categories');
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->products()->exists()) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk.');
        }

        $this->deleteImage($category->thumbnail);
        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
