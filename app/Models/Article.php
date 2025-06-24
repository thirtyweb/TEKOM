<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }

            // Auto set published_at when status is published and published_at is empty
            if ($article->status === 'published' && !$article->published_at) {
                $article->published_at = now();
            }
        });

        static::updating(function ($article) {
            // Auto set published_at when status changes to published
            if ($article->status === 'published' && !$article->published_at) {
                $article->published_at = now();
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
