<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{


    public function run(): void
    {
        $this->call([
            AuthorSeeder::class,
            CategorySeeder::class,
            ArticleSeeder::class,
            QuoteSeeder::class,
            BannerSeeder::class,
            GallerySeeder::class,
        ]);
    }
}
