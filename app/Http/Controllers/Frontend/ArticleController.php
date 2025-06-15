<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function index()
    {
        return view('livewire.frontend.article-list');
    }

    public function show(Article $article)
    {
        $article->incrementViews();
        
        $relatedArticles = Article::published()
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->limit(3)
            ->get();

        return view('frontend.articles.show', compact('article', 'relatedArticles'));
    }
}
