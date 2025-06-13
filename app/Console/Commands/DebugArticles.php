<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;

class DebugArticles extends Command
{
    protected $signature = 'debug:articles';
    protected $description = 'Tampilkan data artikel untuk debug';

    public function handle()
    {
        $articles = Article::published()->get();

        foreach ($articles as $article) {
            $this->info("{$article->id} - {$article->title} ({$article->status}) - {$article->published_at}");
        }

        return Command::SUCCESS;
    }
}
