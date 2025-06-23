<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quote;

class QuoteSeeder extends Seeder
{
    public function run(): void
    {
        $quotes = [
            [
                'quote' => 'The best way to get started is to quit talking and begin doing.',
                'author' => 'Walt Disney',
                'source' => 'Speech',
                'is_active' => true,
            ],
            [
                'quote' => 'Success is not in what you have, but who you are.',
                'author' => 'Bo Bennett',
                'source' => 'Book: Year to Success',
                'is_active' => true,
            ],
            [
                'quote' => 'The only limit to our realization of tomorrow is our doubts of today.',
                'author' => 'Franklin D. Roosevelt',
                'source' => 'Public Address',
                'is_active' => false,
            ],
            [
                'quote' => 'In the middle of every difficulty lies opportunity.',
                'author' => 'Albert Einstein',
                'source' => 'Letter',
                'is_active' => true,
            ],
            [
                'quote' => 'Be yourself; everyone else is already taken.',
                'author' => 'Oscar Wilde',
                'source' => 'Quote Collection',
                'is_active' => true,
            ],
        ];

        foreach ($quotes as $data) {
            Quote::create($data);
        }
    }
}
