<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;     
use App\Models\Servicio;  
use App\Models\Plaza;     // ← Importa Plaza

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
     * Relación con Plaza
     */
    public function plaza()
    {
        return $this->belongsTo(Plaza::class, 'plaza_id');
    }

    /**
     * Historial de servicios (many-to-many)
     */
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'empleado_servicio')
                    ->withPivot('fecha_inicio', 'fecha_fin')
                    ->withTimestamps();
    }

    /**
     * Sólo los servicios ya finalizados
     */
    public function serviciosAnteriores()
    {
        return $this->servicios()->whereNotNull('fecha_fin');
    }
}
