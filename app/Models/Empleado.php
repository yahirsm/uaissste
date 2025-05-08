<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados'; // Define el nombre de la tabla explícitamente

    protected $fillable = [
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'numero_empleado',
        'rfc',
        'servicio_actual_id',
        'plaza_id',
        'user_id'
    ];

    // Relación con Servicio (actual)
    public function servicioActual()
    {
        return $this->belongsTo(Servicio::class, 'servicio_actual_id');
    }

    // Relación con Plaza
    public function plaza()
    {
        return $this->belongsTo(Plaza::class);
    }

    // Relación muchos a muchos con Servicios (historial)
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'empleado_servicio')
            ->withTimestamps()
            ->withPivot('fecha_inicio', 'fecha_fin');
    }
    public function serviciosAnteriores()
    {
        return $this->belongsToMany(Servicio::class, 'empleado_servicio')
            ->withPivot('fecha_inicio', 'fecha_fin')
            ->whereNotNull('fecha_fin'); // Filtra solo servicios anteriores
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
