<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Banner;

class Slideshow extends Component
{
    public function render()
    {
        return view('livewire.components.slideshow', [
            'banners' => Banner::active()->ordered()->get(),
        ]);
    }
}
