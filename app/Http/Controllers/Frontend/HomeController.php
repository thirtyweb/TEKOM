<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Quote;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::active()->ordered()->get();
        $featuredArticles = Article::published()->recent(6)->with(['category', 'author'])->get();
        $quoteOfTheDay = Quote::active()->random()->first();
        $categories = Category::where('is_active', true)->withCount('articles')->get();

        return view('frontend.home', compact('banners', 'featuredArticles', 'quoteOfTheDay', 'categories'));
    }
}