<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'titulo',
        'descripcion',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function alumnos() {
        return $this->belongsToMany(User::class);
    }
}
