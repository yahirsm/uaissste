<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoServicio extends Model
{
    use HasFactory;

    protected $table = 'empleado_servicio';

    protected $fillable = [
        'empleado_id',
        'servicio_id',
        'fecha_inicio',
        'fecha_fin'
    ];

    public $timestamps = true; // Para que registre automáticamente created_at y updated_at

    // Relación con el empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    // Relación con el servicio
    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
