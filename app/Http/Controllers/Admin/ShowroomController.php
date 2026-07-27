<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreShowroomRequest;
use App\Http\Requests\Admin\UpdateShowroomRequest;
use App\Models\Showroom;
use App\Models\ShowroomImage;
use App\Traits\HandlesImageUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShowroomController extends Controller
{
    use HandlesImageUploads;

    public function index(): View
    {
        $showrooms = Showroom::orderBy('name')->paginate(15);

        return view('admin.showrooms.index', compact('showrooms'));
    }

    public function create(): View
    {
        return view('admin.showrooms.create');
    }

    public function store(StoreShowroomRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['name'], Showroom::class);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->storeImage($request->file('thumbnail'), 'showrooms');
        }

        $showroom = Showroom::create($data);

        $this->storeGalleryImages($request, $showroom);

        return redirect()->route('admin.showrooms.index')->with('success', 'Showroom berhasil ditambahkan.');
    }

    public function edit(Showroom $showroom): View
    {
        $showroom->load('images');

        return view('admin.showrooms.edit', compact('showroom'));
    }

    public function update(UpdateShowroomRequest $request, Showroom $showroom): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['name'], Showroom::class, $showroom->id);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            $this->deleteImage($showroom->thumbnail);
            $data['thumbnail'] = $this->storeImage($request->file('thumbnail'), 'showrooms');
        }

        $showroom->update($data);

        $this->storeGalleryImages($request, $showroom);

        return redirect()->route('admin.showrooms.index')->with('success', 'Showroom berhasil diperbarui.');
    }

    public function destroy(Showroom $showroom): RedirectResponse
    {
        $this->deleteImage($showroom->thumbnail);

        foreach ($showroom->images as $image) {
            $this->deleteImage($image->image_path);
        }

        $showroom->delete();

        return back()->with('success', 'Showroom berhasil dihapus.');
    }

    /**
     * AJAX endpoint: add one or more gallery photos to an existing showroom
     * without resubmitting the whole edit form.
     */
    public function storeImages(Request $request, Showroom $showroom): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'gallery' => ['required', 'array', 'min:1'],
            'gallery.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $maxOrder = $showroom->images()->max('sort_order') ?? 0;
        $created = [];

        foreach ($request->file('gallery') as $index => $file) {
            $path = $this->storeImage($file, 'showrooms/gallery');

            $image = ShowroomImage::create([
                'showroom_id' => $showroom->id,
                'image_path' => $path,
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
     * AJAX-friendly deletion of a single showroom photo. Avoids the invalid
     * nested <form> pattern that previously corrupted the parent edit form.
     */
    public function destroyImage(Request $request, ShowroomImage $showroomImage): RedirectResponse|\Illuminate\Http\JsonResponse
    {
        $this->deleteImage($showroomImage->image_path);
        $showroomImage->delete();

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Foto showroom berhasil dihapus.');
    }

    private function storeGalleryImages(Request $request, Showroom $showroom): void
    {
        if (!$request->hasFile('gallery')) {
            return;
        }

        $maxOrder = $showroom->images()->max('sort_order') ?? 0;

        foreach ($request->file('gallery') as $index => $file) {
            $path = $this->storeImage($file, 'showrooms/gallery');

            ShowroomImage::create([
                'showroom_id' => $showroom->id,
                'image_path' => $path,
                'sort_order' => $maxOrder + $index + 1,
            ]);
        }
    }
}
