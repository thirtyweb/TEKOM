<?php
// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Livewire\Frontend\HomePage;
use App\Livewire\Frontend\ArticleList;
use App\Livewire\Frontend\ArticleDetail;
use App\Livewire\Frontend\GalleryIndex;
use App\Livewire\Frontend\ResourceIndex;
use App\Livewire\Frontend\FaqIndex;

Route::get('/', HomePage::class)->name('home');

// Articles routes
Route::get('/artikel', ArticleList::class)->name('articles.index');
Route::get('/artikel/{article}', ArticleDetail::class)->name('articles.show');

// Category routes
Route::get('/kategori/{category}', function($category) {
    return redirect()->route('articles.index', ['categoryId' => $category]);
})->name('categories.show');

// Gallery routes
Route::get('/galeri', GalleryIndex::class)->name('gallery.index');

// Resources routes
Route::get('/resource', ResourceIndex::class)->name('resources.index');

// FAQ routes
Route::get('/faq', FaqIndex::class)->name('faq.index');

// Static pages
Route::view('/tentang', 'pages.about')->name('about');
Route::view('/kontak', 'pages.contact')->name('contact');