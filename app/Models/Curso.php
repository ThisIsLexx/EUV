<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'titulo',
        'descripcion',
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function alumnos() : belongsToMany {
        return $this->belongsToMany(User::class);
    }

    public function cuentos() : HasMany {
        return $this->hasMany(Cuento::class);
    }
}
