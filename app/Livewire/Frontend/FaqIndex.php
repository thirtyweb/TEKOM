<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Faq;
use App\Models\Question;
use App\Models\Quote;
use Livewire\Attributes\Title;


#[Title('FAQ    ')] 

class FaqIndex extends Component
{
    public $name = '';
    public $email = '';
    public $question = '';
    public $successMessage = '';

    protected $rules = [
        'name' => 'required|string|min:3',
        'email' => 'nullable|email',
        'question' => 'required|string|min:10',
    ];

    public function submitQuestion()
    {
        $validatedData = $this->validate();
        Question::create($validatedData);
        $this->successMessage = 'Pertanyaan Anda telah berhasil dikirim! Kami akan segera meninjaunya.';
        $this->reset(['name', 'email', 'question']);

    }

    public function render()
    {
        $officialFaqs = Faq::active()->ordered()->get();
        $officialFaqs->each(function ($faq) {
            $faq->key = 'faq-' . $faq->getKey();
        });

        $answeredQuestions = Question::where('status', 'answered')
            ->whereNotNull('answer')
            ->latest()
            ->get();
        $answeredQuestions->each(function ($question) {
            $question->key = 'uq-' . $question->getKey();
        });
        
        $allFaqs = $officialFaqs->toBase()->merge($answeredQuestions)->sortByDesc('created_at');

        $quote = Quote::inRandomOrder()->first();

        return view('livewire.frontend.faq-index', [
            'faqs' => $allFaqs,
            'quote' => $quote, 
        ]);
    }
}
