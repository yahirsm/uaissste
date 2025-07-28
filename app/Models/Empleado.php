<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Servicio;
use App\Models\Plaza;

/**
 * App\Models\Empleado
 *
 * @property int         $id
 * @property string      $nombre
 * @property string      $primer_apellido
 * @property string|null $segundo_apellido
 * @property string      $numero_empleado
 * @property string      $rfc
 * @property int         $servicio_actual_id
 * @property int         $plaza_id
 * @property int         $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 *
 * @property-read User     $user
 * @property-read Servicio $servicioActual
 * @property-read Plaza    $plaza
 */
class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $fillable = [
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'numero_empleado',
        'rfc',
        'servicio_actual_id',
        'plaza_id',
        'user_id',
    ];

    /**
     * Relación con el usuario (clave foránea user_id)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación con el Servicio actual (clave foránea servicio_actual_id)
     */
    public function servicioActual()
    {
        return $this->belongsTo(Servicio::class, 'servicio_actual_id');
    }

    /**
     * Relación con Plaza (clave foránea plaza_id)
     */
    public function plaza()
    {
        return $this->belongsTo(Plaza::class, 'plaza_id');
    }

    /**
     * Historial de servicios (muchos a muchos con pivot)
     */
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'empleado_servicio')
            ->withPivot('fecha_inicio', 'fecha_fin')
            ->withTimestamps();
    }
    /**
     * Solo los servicios ya finalizados (fecha_fin != null)
     */
    public function serviciosAnteriores()
    {
        return $this->belongsToMany(Servicio::class, 'empleado_servicio')
            ->withPivot('fecha_inicio', 'fecha_fin')
            ->withTimestamps()
            ->wherePivotNotNull('fecha_fin');
    }
}
