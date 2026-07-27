<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Models\Banner;
use App\Traits\HandlesImageUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BannerController extends Controller
{
    use HandlesImageUploads;

    public function index(): View
    {
        $banners = Banner::orderBy('sort_order')->paginate(15);

        return view('admin.banners.index', compact('banners'));
    }

    public function create(): View
    {
        return view('admin.banners.create');
    }

    public function store(BannerRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        $data['image_path'] = $this->storeImage($request->file('image'), 'banners');

        Banner::create($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function edit(Banner $banner): View
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(BannerRequest $request, Banner $banner): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $this->deleteImage($banner->image_path);
            $data['image_path'] = $this->storeImage($request->file('image'), 'banners');
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner): RedirectResponse
    {
        $this->deleteImage($banner->image_path);
        $banner->delete();

        return back()->with('success', 'Banner berhasil dihapus.');
    }
}
