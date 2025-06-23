<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Selamat Datang di Website Kami',
                'description' => 'Temukan informasi terbaru dan menarik hanya di sini.',
                'slides' => [
                    [
                        'title' => 'Slide 1',
                        'description' => 'Slide pertama menampilkan highlight utama.',
                        'image' => 'https://source.unsplash.com/800x400/?welcome',
                        'link_url' => '#',
                        'button_text' => 'Lihat Selengkapnya',
                        'order' => 1,
                    ],
                    [
                        'title' => 'Slide 2',
                        'description' => 'Slide kedua tentang fitur terbaik kami.',
                        'image' => 'https://source.unsplash.com/800x400/?feature',
                        'order' => 2,
                    ]
                ],
                'link_url' => '/tentang-kami',
                'button_text' => 'Pelajari',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Promo Spesial Bulan Ini',
                'description' => 'Dapatkan diskon dan penawaran terbaik.',
                'slides' => [
                    [
                        'title' => 'Diskon 50%',
                        'description' => 'Untuk produk pilihan.',
                        'image' => 'https://source.unsplash.com/800x400/?discount',
                        'link_url' => '/promo',
                        'order' => 1,
                    ]
                ],
                'link_url' => '/promo',
                'button_text' => 'Ambil Sekarang',
                'order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $data) {
            Banner::create($data);
        }
    }
}
