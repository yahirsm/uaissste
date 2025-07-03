<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoInsumo extends Model
{
    use HasFactory;

    protected $table = 'tipos_insumo';

    // 2) Tu PK se llama tipo_insumo_id
    protected $primaryKey = 'tipo_insumo_id';

    // 3) Si no es AUTO_INCREMENT (opcional)
    // public $incrementing = false;

    // 4) Columnas que puedes asignar masivamente
    protected $fillable = [
        'tipo_insumo_id',
        'nombre',
    ];

    // 5) No tienes timestamps
    public $timestamps = false;
}
