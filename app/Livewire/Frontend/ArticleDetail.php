<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Article;

class ArticleDetail extends Component
{
    public Article $article;

    public function mount(Article $article)
    {
        $this->article = $article;
        $this->article->incrementViews();
    }

    public function render()
    {
        return view('livewire.frontend.articles.article-detail', [
            'relatedArticles' => Article::published()
                ->where('category_id', $this->article->category_id)
                ->where('id', '!=', $this->article->id)
                ->limit(3)
                ->get(),
        ]);
    }
}
