<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'images',
        'is_active',
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($gallery) {
            if (empty($gallery->slug)) {
                $gallery->slug = Str::slug($gallery->title);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Accessor to ensure images is always an array
    public function getImagesAttribute($value)
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }
        
        return is_array($value) ? $value : [];
    }

    // Mutator to ensure images is stored as JSON
    public function setImagesAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['images'] = json_encode($value);
        } elseif (is_string($value)) {
            // If it's already a JSON string, validate it
            $decoded = json_decode($value, true);
            $this->attributes['images'] = is_array($decoded) ? $value : json_encode([]);
        } else {
            $this->attributes['images'] = json_encode([]);
        }
    }

    // Helper method to get image count safely
    public function getImageCountAttribute()
    {
        return count($this->images);
    }

    // Helper method to get first image
    public function getFirstImageAttribute()
    {
        $images = $this->images;
        return !empty($images) ? $images[0] : null;
    }

    // Scope for active galleries
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    

    // Scope for recent galleries
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
    
}