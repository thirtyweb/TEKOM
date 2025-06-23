<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;

class ArticleList extends Component
{
    use WithPagination;

    public $categoryId = null;
    public $search = '';
    public $sortBy = 'latest';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryId()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Fix timezone untuk comparison
        $currentTime = now()->setTimezone(config('app.timezone', 'UTC'));
        
        $query = Article::where('status', 'published')
            ->where('published_at', '<=', $currentTime)
            ->whereNotNull('published_at')
            ->with(['category', 'author']);

        // Atau gunakan scope yang lebih permisif
        // $query = Article::publishedNow()->with(['category', 'author']);

        if ($this->categoryId) {
            $query->where('category_id', $this->categoryId);
        }

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $this->search . '%');
            });
        }

        switch ($this->sortBy) {
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            default:
                $query->orderBy('published_at', 'desc');
        }

        return view('livewire.frontend.articles.article-list', [
            'articles' => $query->paginate(12),
            'categories' => Category::where('is_active', true)->get(),
        ]);
    }
}