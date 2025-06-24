<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Faq;
use App\Models\Question;
use App\Models\Quote; // <-- [1] IMPORT MODEL QUOTE

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
        // Ambil data FAQ resmi
        $officialFaqs = Faq::active()->ordered()->get();
        $officialFaqs->each(function ($faq) {
            $faq->key = 'faq-' . $faq->getKey();
        });

        // Ambil pertanyaan yang sudah dijawab admin
        $answeredQuestions = Question::where('status', 'answered')
            ->whereNotNull('answer')
            ->latest()
            ->get();
        $answeredQuestions->each(function ($question) {
            $question->key = 'uq-' . $question->getKey();
        });
        
        // Gabungkan semua FAQ
        $allFaqs = $officialFaqs->toBase()->merge($answeredQuestions)->sortByDesc('created_at');

        // [2] AMBIL SATU QUOTE SECARA ACAK
        // Jika Anda tidak punya model Quote, Anda bisa menonaktifkan baris ini
        // dan baris 'quote' => $quote di bawah untuk sementara.
        $quote = Quote::inRandomOrder()->first();

        // [3] KIRIM SEMUA DATA KE VIEW
        return view('livewire.frontend.faq-index', [
            'faqs' => $allFaqs,
            'quote' => $quote, // <-- Variabel $quote sekarang dikirim ke view
        ]);
    }
}
