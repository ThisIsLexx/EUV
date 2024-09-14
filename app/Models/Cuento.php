<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cuento extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'contenido',
        'dificultad',
    ];

    public function cursos(): belongsToMany
    {
        return $this->belongsToMany(Curso::class);
    }

    public function puntajes(): hasMany
    {
        return $this->hasMany(Puntaje::class);
    }
}   
