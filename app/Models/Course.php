<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'sks',
        'prerequisite',
        'semester',
        'category',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope untuk semester
    public function scopeSemester($query, $semester)
    {
        return $query->where('semester', $semester);
    }

    // Scope untuk kategori
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Scope untuk mata kuliah aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Get total SKS from string format like "3(2-1)"
    public function getTotalSksAttribute()
    {
        preg_match('/(\d+)/', $this->sks, $matches);
        return isset($matches[1]) ? (int)$matches[1] : 0;
    }

    // Get theory and practice credits
    public function getCreditsBreakdownAttribute()
    {
        preg_match('/\((\d+)-(\d+)\)/', $this->sks, $matches);
        return [
            'theory' => isset($matches[1]) ? (int)$matches[1] : 0,
            'practice' => isset($matches[2]) ? (int)$matches[2] : 0,
        ];
    }
}