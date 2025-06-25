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

    public function scopeSemester($query, $semester)
    {
        return $query->where('semester', $semester);
    }

    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getTotalSksAttribute()
    {
        preg_match('/(\d+)/', $this->sks, $matches);
        return isset($matches[1]) ? (int)$matches[1] : 0;
    }

    public function getCreditsBreakdownAttribute()
    {
        preg_match('/\((\d+)-(\d+)\)/', $this->sks, $matches);
        return [
            'theory' => isset($matches[1]) ? (int)$matches[1] : 0,
            'practice' => isset($matches[2]) ? (int)$matches[2] : 0,
        ];
    }
}