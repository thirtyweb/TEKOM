<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $authors = Author::pluck('id')->all();
        $categories = Category::pluck('id')->all();

        if (empty($authors) || empty($categories)) {
            $this->command->error('Seeder gagal karena author/category belum ada.');
            return;
        }

        $dummyArticles = [
            [
                'title' => 'Laravel 11 Dirilis: Fitur Baru dan Perubahan Penting',
                'excerpt' => 'Laravel 11 membawa banyak pembaruan termasuk peningkatan performa dan arsitektur.',
                'content' => '<p>Laravel 11 hadir dengan berbagai fitur baru seperti streamlined bootstrap, route caching yang lebih cepat, dan banyak lagi.</p>',
                'featured_image' => 'https://source.unsplash.com/800x400/?code,laravel',
                'status' => 'published',
                'views' => rand(10, 100),
                'meta_data' => ['tags' => ['laravel', 'php', 'framework']],
            ],
            [
                'title' => 'Tips Menulis Artikel SEO untuk Developer',
                'excerpt' => 'Pelajari teknik penulisan artikel SEO yang efektif bagi pengembang.',
                'content' => '<p>Menulis artikel SEO membutuhkan pemahaman keyword, struktur heading, dan readability.</p>',
                'featured_image' => 'https://source.unsplash.com/800x400/?seo,writing',
                'status' => 'draft',
                'views' => rand(5, 50),
                'meta_data' => ['tags' => ['seo', 'content writing']],
            ],
            [
                'title' => 'Cara Membuat API dengan Laravel Sanctum',
                'excerpt' => 'Laravel Sanctum adalah solusi ringan untuk autentikasi API di Laravel.',
                'content' => '<p>Sanctum cocok digunakan untuk SPA dan mobile app karena simplicity-nya.</p>',
                'featured_image' => 'https://source.unsplash.com/800x400/?api,security',
                'status' => 'published',
                'views' => rand(20, 200),
                'meta_data' => ['tags' => ['laravel', 'api', 'sanctum']],
            ],
        ];

        foreach ($dummyArticles as $data) {
            Article::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'excerpt' => $data['excerpt'],
                'content' => $data['content'],
                'featured_image' => $data['featured_image'],
                'category_id' => fake()->randomElement($categories),
                'author_id' => fake()->randomElement($authors),
                'status' => $data['status'],
                'published_at' => $data['status'] === 'published' ? now()->subDays(rand(1, 10)) : null,
                'views' => $data['views'],
                'meta_data' => $data['meta_data'],
            ]);
        }
    }
}
