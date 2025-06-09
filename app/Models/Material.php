<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Partida;
use App\Models\TipoInsumo;
use App\Models\Movimiento;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materiales';

    /**
     * Mass assignable attributes
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'clave',
        'descripcion',
        'partida_id',
        'tipo_insumo_id',
        'stock_actual',
    ];

    /**
     * Relación con Partida
     */
    public function partida()
    {
        return $this->belongsTo(Partida::class);
    }

    /**
     * Relación con TipoInsumo
     */
    public function tipoInsumo()
    {
        return $this->belongsTo(TipoInsumo::class, 'tipo_insumo_id');
    }

    /**
     * Relación con Movimientos de inventario
     */
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'material_id');
    }
}
