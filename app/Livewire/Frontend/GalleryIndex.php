<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Gallery;

class GalleryIndex extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.frontend.gallery-index', [
            'galleries' => Gallery::where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->paginate(9),
        ]);
    }
}
