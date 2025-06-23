<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Teknologi',
                'description' => 'Artikel seputar perkembangan teknologi dan gadget terbaru.',
                'image' => 'https://source.unsplash.com/400x300/?technology',
                'is_active' => true,
            ],
            [
                'name' => 'Pemrograman',
                'description' => 'Tips, tutorial, dan berita tentang dunia pemrograman.',
                'image' => 'https://source.unsplash.com/400x300/?programming',
                'is_active' => true,
            ],
            [
                'name' => 'Desain UI/UX',
                'description' => 'Panduan dan inspirasi desain antarmuka pengguna.',
                'image' => 'https://source.unsplash.com/400x300/?ui,ux',
                'is_active' => true,
            ],
            [
                'name' => 'Kesehatan Digital',
                'description' => 'Topik tentang kesehatan mental & fisik di era digital.',
                'image' => 'https://source.unsplash.com/400x300/?health,technology',
                'is_active' => false,
            ],
        ];

        foreach ($categories as $data) {
            Category::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'description' => $data['description'],
                'image' => $data['image'],
                'is_active' => $data['is_active'],
            ]);
        }
    }
}
