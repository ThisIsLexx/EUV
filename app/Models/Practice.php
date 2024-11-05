<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    use HasFactory;

    protected $fillables = [
        'tiempo',
        'total_palabras',
        'palabras_correctas',
        'ppm',
        'dificultad'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
