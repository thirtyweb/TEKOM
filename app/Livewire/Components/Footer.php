<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Category;

class Footer extends Component
{
    public function render()
    {
        return view('livewire.components.footer', [
            'categories' => Category::where('is_active', true)->get(),
        ]);
    }
}
