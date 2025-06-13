<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Category;

class Navigation extends Component
{
    public function render()
    {
        return view('livewire.components.navigation', [
            'categories' => Category::where('is_active', true)->get(),
        ]);
    }
}
