<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Partida;
use App\Models\TipoInsumo;
use App\Models\Movimiento;
use App\Models\Solicitud;  // <-- Import necesario

class Material extends Model
{
    use HasFactory;

    protected $table = 'materiales';

    /**
     * Atributos asignables en masa
     *
     * @var array<int,string>
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

    /**
     * Relación many-to-many con Solicitudes
     */
    public function solicitudes()
    {
        return $this->belongsToMany(Solicitud::class, 'solicitud_material')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }

    /**
     * Atributo calculado stock_actual
     */
    public function getStockActualAttribute()
    {
        $entradas = $this->movimientos()
                         ->where('tipo', 'entrada')
                         ->sum('cantidad');

        $salidas  = $this->movimientos()
                         ->where('tipo', 'salida')
                         ->sum('cantidad');

        return $entradas - $salidas;
    }
}
