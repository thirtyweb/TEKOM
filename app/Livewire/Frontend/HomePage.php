<?php

namespace App\Livewire\Frontend;

use App\Models\AboutUsSection;
use Livewire\Component;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Gallery;
use App\Models\Quote;

class HomePage extends Component
{
    public $aboutUsData;

    public function mount()
    {
        $this->aboutUsData = AboutUsSection::first(); 
    }

    public function render()
    {
        return view('livewire.frontend.home-page', [
            'banners' => Banner::active()->ordered()->get(),
            'galleries' => Gallery::active()->latest()->take(3)->get(),
            'featuredArticles' => Article::published()->recent(3)->with(['category', 'author'])->get(),
            'quoteOfTheDay' => Quote::active()->random()->first(),
            'aboutUsData' => $this->aboutUsData,
        ]);
    }
}