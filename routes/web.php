<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShowroomController as AdminShowroomController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Frontend\CatalogController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\SeoController;
use App\Http\Controllers\Frontend\ShowroomController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes (Public)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/katalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/kategori/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/produk/{product:slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/cari', [SearchController::class, 'index'])->name('search.index');

Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');

Route::get('/showroom', [ShowroomController::class, 'index'])->name('showroom.index');
Route::get('/showroom/{showroom:slug}', [ShowroomController::class, 'show'])->name('showroom.show');

Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact.index');
Route::post('/kontak', [PageController::class, 'submitContact'])->name('contact.submit');
Route::get('/kebijakan-privasi', [PageController::class, 'privacyPolicy'])->name('privacy-policy');

Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('categories', AdminCategoryController::class)->except(['show']);

        Route::resource('products', AdminProductController::class)->except(['show']);
        Route::post('products/{product}/images', [AdminProductController::class, 'storeImages'])->name('products.images.store');
        Route::delete('products/images/{productImage}', [AdminProductController::class, 'destroyImage'])->name('products.images.destroy');

        Route::resource('galleries', AdminGalleryController::class)->except(['show']);
        Route::resource('banners', BannerController::class)->except(['show']);

        Route::resource('showrooms', AdminShowroomController::class)->except(['show']);
        Route::post('showrooms/{showroom}/images', [AdminShowroomController::class, 'storeImages'])->name('showrooms.images.store');
        Route::delete('showrooms/images/{showroomImage}', [AdminShowroomController::class, 'destroyImage'])->name('showrooms.images.destroy');

        Route::resource('faqs', AdminFaqController::class)->except(['show']);
        Route::resource('testimonials', AdminTestimonialController::class)->except(['show']);

        Route::get('settings/general', [SettingController::class, 'general'])->name('settings.general');
        Route::put('settings/general', [SettingController::class, 'updateGeneral'])->name('settings.general.update');
        Route::get('settings/seo', [SettingController::class, 'seo'])->name('settings.seo');
        Route::put('settings/seo', [SettingController::class, 'updateSeo'])->name('settings.seo.update');

        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    });
});
