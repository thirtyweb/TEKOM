<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * Secara eksplisit mendefinisikan nama tabel yang digunakan oleh model ini.
     */
    protected $table = 'user_questions'; // <--- TAMBAHKAN BARIS INI

    protected $fillable = [
        'name',
        'email',
        'question',
        'answer',
        'status',
    ];
}