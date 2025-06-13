<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Quote;

class QuoteOfTheDay extends Component
{
    public function render()
    {
        return view('livewire.components.quote-of-the-day', [
            'quote' => Quote::active()->random()->first(),
        ]);
    }
}
