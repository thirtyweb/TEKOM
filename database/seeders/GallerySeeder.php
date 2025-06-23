<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Kegiatan Sekolah',
                'description' => 'Dokumentasi kegiatan belajar mengajar dan ekstrakurikuler.',
                'images' => [
                    'https://source.unsplash.com/800x600/?school,event',
                    'https://source.unsplash.com/800x600/?classroom',
                    'https://source.unsplash.com/800x600/?students',
                ],
                'is_active' => true,
            ],
            [
                'title' => 'Pameran Kreatif',
                'description' => 'Karya-karya siswa dalam pameran seni tahunan.',
                'images' => [
                    'https://source.unsplash.com/800x600/?art,exhibition',
                    'https://source.unsplash.com/800x600/?creative',
                ],
                'is_active' => true,
            ],
            [
                'title' => 'Dokumentasi Alumni',
                'description' => 'Kenangan bersama para alumni.',
                'images' => [],
                'is_active' => false,
            ],
        ];

        foreach ($galleries as $data) {
            Gallery::create($data);
        }
    }
}
