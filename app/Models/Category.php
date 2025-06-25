<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // <-- Tambahkan ini

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'is_active',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void
    {
        parent::booted();

        // Event ini akan terpanggil SETELAH record dihapus dari database
        static::deleted(function (Category $category) {
            // Cek jika kategori memiliki gambar
            if ($category->image) {
                // Hapus file dari storage.
                // 'public' adalah nama disk yang mengarah ke storage/app/public
                Storage::disk('public')->delete($category->image);
            }
        });
    }

    // Definisikan relasi ke articles jika belum ada
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
