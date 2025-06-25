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

        static::deleted(function (Category $category) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
        });
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
