<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicios'; // Define la tabla explícitamente
    protected $fillable = ['nombre'];
    public $timestamps = true; // Habilita timestamps si la tabla los tiene

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'empleado_servicio')
                    ->withTimestamps(); // Para que registre las fechas de creación y actualización
    }
}
