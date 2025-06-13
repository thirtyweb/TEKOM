<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::published()->with(['category', 'author']);
        
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }
        
        $articles = $query->paginate(10);
        
        return response()->json([
            'data' => $articles,
            'status' => 'success'
        ]);
    }

    public function show(Article $article)
    {
        $article->load(['category', 'author']);
        $article->incrementViews();
        
        return response()->json([
            'data' => $article,
            'status' => 'success'
        ]);
    }
}