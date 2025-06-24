<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsSection extends Model
{
    use HasFactory;

    protected $table = 'about_us_section'; 

    protected $fillable = [
        'about_us_description',
        'vision_text',
        'mission_items',
        'facts',
    ];

    protected $casts = [
        'mission_items' => 'array',
        'facts' => 'array',
    ];
}
