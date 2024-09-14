<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Curso;
use App\Models\Cuento;

class Puntaje extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'curso_id', 'cuento_id', 'aciertos', 'fallas', 'total_palabras'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    public function texto()
    {
        return $this->belongsTo(Cuento::class, 'texto_id');
    }
}
