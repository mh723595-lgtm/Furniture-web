<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Traits\HandlesImageUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    use HandlesImageUploads;

    public function index(Request $request): View
    {
        $products = Product::with('category')
            ->when($request->filled('search'), fn ($q) => $q->where('name', 'like', '%' . $request->search . '%'))
            ->when($request->filled('category'), fn ($q) => $q->where('category_id', $request->category))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::active()->orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['name'], Product::class);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_best_seller'] = $request->boolean('is_best_seller');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->storeImage($request->file('thumbnail'), 'products');
        }

        $product = Product::create($data);

        $this->storeGalleryImages($request, $product);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::active()->orderBy('name')->get();
        $product->load('images');

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['name'], Product::class, $product->id);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_best_seller'] = $request->boolean('is_best_seller');

        if ($request->hasFile('thumbnail')) {
            $this->deleteImage($product->thumbnail);
            $data['thumbnail'] = $this->storeImage($request->file('thumbnail'), 'products');
        }

        $product->update($data);

        $this->storeGalleryImages($request, $product);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->deleteImage($product->thumbnail);

        foreach ($product->images as $image) {
            $this->deleteImage($image->image_path);
        }

        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * AJAX endpoint: add one or more gallery images to an existing product
     * without resubmitting the whole edit form. Returns the created images
     * as JSON so the admin UI can append them instantly.
     */
    public function storeImages(Request $request, Product $product): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $maxOrder = $product->images()->max('sort_order') ?? 0;
        $created = [];

        foreach ($request->file('images') as $index => $file) {
            $path = $this->storeImage($file, 'products/gallery');

            $image = ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'alt_text' => $product->name,
                'sort_order' => $maxOrder + $index + 1,
            ]);

            $created[] = [
                'id' => $image->id,
                'url' => asset('storage/' . $image->image_path),
            ];
        }

        return response()->json(['images' => $created]);
    }

    /**
     * AJAX-friendly deletion of a single product gallery image. Responds with
     * JSON when requested so the admin UI can remove it from the DOM instantly
     * instead of relying on a nested <form> (which is invalid HTML and was
     * corrupting the parent edit form's submission).
     */
    public function destroyImage(Request $request, ProductImage $productImage): RedirectResponse|\Illuminate\Http\JsonResponse
    {
        $this->deleteImage($productImage->image_path);
        $productImage->delete();

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Gambar produk berhasil dihapus.');
    }

    private function storeGalleryImages(Request $request, Product $product): void
    {
        if (!$request->hasFile('images')) {
            return;
        }

        $maxOrder = $product->images()->max('sort_order') ?? 0;

        foreach ($request->file('images') as $index => $file) {
            $path = $this->storeImage($file, 'products/gallery');

            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'alt_text' => $product->name,
                'sort_order' => $maxOrder + $index + 1,
            ]);
        }
    }
}
