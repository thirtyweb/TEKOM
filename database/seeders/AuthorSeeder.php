<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use Illuminate\Support\Str;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            [
                'name' => 'Budi Santoso',
                'bio' => 'Penulis teknologi dan pengembang web.',
                'avatar' => 'https://i.pravatar.cc/150?img=1',
                'email' => 'budi@example.com',
                'website' => 'https://budi.dev',
                'is_active' => true,
            ],
            [
                'name' => 'Siti Aminah',
                'bio' => 'Spesialis konten kreatif dan sosial media.',
                'avatar' => 'https://i.pravatar.cc/150?img=2',
                'email' => 'siti@example.com',
                'website' => 'https://siti.id',
                'is_active' => true,
            ],
            [
                'name' => 'Andi Nugroho',
                'bio' => 'Penulis artikel edukatif dan trainer.',
                'avatar' => 'https://i.pravatar.cc/150?img=3',
                'email' => 'andi@example.com',
                'website' => 'https://andi.com',
                'is_active' => true,
            ],
        ];

        foreach ($authors as $data) {
            Author::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'bio' => $data['bio'],
                'avatar' => $data['avatar'],
                'email' => $data['email'],
                'website' => $data['website'],
                'is_active' => $data['is_active'],
            ]);
        }
    }
}
