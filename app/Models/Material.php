<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materiales';
    protected $fillable = ['nombre', 'descripcion', 'partida_id', 'tipo_insumo_id'];

    public function partida()
    {
        return $this->belongsTo(Partida::class);
    }

    public function tipoMaterial()
    {
        return $this->belongsTo(TipoInsumo::class, 'tipo_insumo_id');
    }
    public function tipoInsumo()
{
    return $this->belongsTo(TipoInsumo::class, 'tipo_insumo_id', 'tipo_insumo_id');
}


}