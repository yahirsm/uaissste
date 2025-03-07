<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materiales';  // Nombre de la tabla en la base de datos

    protected $fillable = ['nombre', 'descripcion', 'partida_id'];

    public function partida()
    {
        return $this->belongsTo(Partida::class);
    }
}
