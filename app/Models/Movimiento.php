<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Movimiento extends Model
{
    use HasFactory;

    /**
     * Tabla asociada
     *
     * @var string
     */
    protected $table = 'movimientos';

    /**
     * Tipos posibles de movimiento
     */
    public const TIPO_ENTRADA = 'entrada';
    public const TIPO_SALIDA  = 'salida';

    /**
     * Atributos asignables masivamente
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'material_id',
        'tipo',              // entrada|salida
        'cantidad',
        'unidad',
        'fecha_movimiento',
        'fecha_caducidad',
    ];

    /**
     * Casts para atributos
     *
     * @var array<string,string>
     */
    protected $casts = [
        'fecha_movimiento' => 'date',
        'fecha_caducidad'  => 'date',
    ];

    /**
     * Relación con Material
     */
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    /**
     * Scope: sólo entradas
     */
    public function scopeEntradas($query)
    {
        return $query->where('tipo', self::TIPO_ENTRADA);
    }

    /**
     * Scope: sólo salidas
     */
    public function scopeSalidas($query)
    {
        return $query->where('tipo', self::TIPO_SALIDA);
    }

    /**
     * Accessor para formato de fecha_movimiento
     */
    /**
     * Accessor para obtener la fecha formateada sin hacer un nuevo parseo
     */
    public function getFechaMovimientoFormattedAttribute(): ?string
    {
        return optional($this->fecha_movimiento)
            ->format('d/m/Y');
    }


    /**
     * Helper: crea un movimiento de salida y actualiza stock
     *
     * @param  int    $materialId
     * @param  float  $cantidad
     * @param  string $unidad
     * @param  string|null $fechaCaducidad
     * @return self
     */
    public static function registrarSalida(int $materialId, float $cantidad, string $unidad, ?string $fechaCaducidad = null): self
    {
        // Crear el movimiento
        $mov = self::create([
            'material_id'      => $materialId,
            'tipo'             => self::TIPO_SALIDA,
            'cantidad'         => $cantidad,
            'unidad'           => $unidad,
            'fecha_movimiento' => Carbon::now()->toDateString(),
            'fecha_caducidad'  => $fechaCaducidad,
        ]);

        // Descontar stock en el modelo Material
        $material = $mov->material;
        $material->update([
            // stock_actual es un atributo calculado: no se actualiza directamente aquí,
            // sino que al insertar un movimiento de salida, stock_actual disminuirá
            // automáticamente en base a la suma de movimientos
        ]);

        return $mov;
    }
}
