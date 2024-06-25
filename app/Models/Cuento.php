<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuento extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'contenido',
        'dificultad',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
