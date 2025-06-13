<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Faq;

class FaqIndex extends Component
{
    public function render()
    {
        return view('livewire.frontend.faq-index', [
            'faqs' => Faq::active()->ordered()->get(),
        ]);
    }
}
