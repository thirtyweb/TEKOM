<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'slides',
        'link_url',
        'button_text',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'slides' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($banner) {
            if (!$banner->order) {
                $banner->order = static::max('order') + 1;
            }
        });
    }

    public function getSlidesWithUrlsAttribute()
    {
        if (!$this->slides) {
            return [];
        }

        return collect($this->slides)->map(function ($slide) {
            return [
                'title' => $slide['title'] ?? '',
                'description' => $slide['description'] ?? '',
                'image' => $slide['image'] ?? '',
                'image_url' => isset($slide['image']) ? asset('storage/' . $slide['image']) : null,
                'link_url' => $slide['link_url'] ?? $this->link_url ?? null,
                'button_text' => $slide['button_text'] ?? $this->button_text ?? null,
                'order' => $slide['order'] ?? 0,
            ];
        })->sortBy('order')->values()->all();
    }

    public function getFirstSlideImageAttribute()
    {
        $slides = $this->slides_with_urls;
        return $slides[0]['image_url'] ?? null;
    }

    public function getFirstSlideAttribute()
    {
        if (!$this->slides || empty($this->slides)) {
            return null;
        }

        $slide = $this->slides[0];
        return [
            'title' => $slide['title'] ?? $this->title,
            'description' => $slide['description'] ?? $this->description,
            'image' => $slide['image'] ?? null,
            'image_url' => isset($slide['image']) ? asset('storage/' . $slide['image']) : null,
            'link_url' => $slide['link_url'] ?? $this->link_url,
            'button_text' => $slide['button_text'] ?? $this->button_text,
        ];
    }

    public function getAllSlidesAttribute()
    {
        if (!$this->slides || empty($this->slides)) {
            return [[
                'title' => $this->title,
                'description' => $this->description,
                'image' => null,
                'image_url' => null,
                'link_url' => $this->link_url,
                'button_text' => $this->button_text,
            ]];
        }

        return collect($this->slides)->map(function ($slide) {
            return [
                'title' => $slide['title'] ?? '',
                'description' => $slide['description'] ?? '',
                'image' => $slide['image'] ?? null,
                'image_url' => isset($slide['image']) ? asset('storage/' . $slide['image']) : null,
                'link_url' => $slide['link_url'] ?? $this->link_url,
                'button_text' => $slide['button_text'] ?? $this->button_text,
                'order' => $slide['order'] ?? 1,
            ];
        })->sortBy('order')->values()->all();
    }
}