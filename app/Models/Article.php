<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use DOMDocument; // <-- Tambahkan ini

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category_id',
        'author_id',
        'status',
        'published_at',
        'views',
        'meta_data',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'meta_data' => 'array',
    ];
    
    public function getMetaDataAttribute($value)
    {
        $data = is_string($value) ? json_decode($value, true) : ($value ?? []);
        
        if (isset($data['tags'])) {
            $data['tags'] = is_array($data['tags']) 
                ? $data['tags'] 
                : explode(',', $data['tags']);
        }
        
        return $data;
    }
    
    public function setMetaDataAttribute($value)
    {
        $this->attributes['meta_data'] = is_array($value) 
            ? json_encode($value) 
            : $value;
    }

    protected static function booted(): void
    {
        parent::booted();

        static::deleted(function (Article $article) {
            // 1. Hapus featured_image jika ada
            if (!empty($article->featured_image)) {
                if (Storage::disk('public')->exists($article->featured_image)) {
                    Storage::disk('public')->delete($article->featured_image);
                }
            }

            // 2. Hapus gambar dari content (Rich Editor)
            if (!empty($article->content)) {
                $dom = new DOMDocument();
                // Gunakan @ untuk menekan error dari HTML yang mungkin tidak valid
                @$dom->loadHTML($article->content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                
                $images = $dom->getElementsByTagName('img');

                foreach ($images as $img) {
                    $src = $img->getAttribute('src');

                    // Jika src berisi '/storage/', maka itu adalah file lokal kita
                    if (Str::contains($src, '/storage/')) {
                        // Ubah URL lengkap menjadi path relatif di dalam storage
                        // Contoh: /storage/articles/gambar.jpg -> articles/gambar.jpg
                        $path = Str::after($src, '/storage/');

                        if (Storage::disk('public')->exists($path)) {
                            Storage::disk('public')->delete($path);
                        }
                    }
                }
            }
        });
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopePublishedNow($query)
    {
        return $query->where('status', 'published')
            ->where(function ($q) {
                $q->where('published_at', '<=', now())
                    ->orWhereNull('published_at');
            });
    }

    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('published_at', 'desc')
            ->take($limit);
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $readingTime = ceil($wordCount / 200); // Average reading speed
        return $readingTime;
    }
}
