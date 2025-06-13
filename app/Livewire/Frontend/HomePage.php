<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Quote;

class HomePage extends Component
{
    public function render()
    {
        return view('livewire.frontend.home-page', [
            'banners' => Banner::active()->ordered()->get(),
            'featuredArticles' => Article::published()->recent(6)->with(['category', 'author'])->get(),
            'quoteOfTheDay' => Quote::active()->random()->first(),
        ]);
    }
}
