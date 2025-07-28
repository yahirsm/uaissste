<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Material;
use App\Models\User;
use App\Models\Servicio;

class Solicitud extends Model
{
    use HasFactory;

    /**
     * Tabla asociada
     *
     * @var string
     */
    protected $table = 'solicitudes';

    /**
     * Columnas asignables masivamente
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'user_id',
        'servicio_id',
        'atendido',
    ];

    /**
     * Casts para atributos
     *
     * @var array<string,string>
     */
    protected $casts = [
        'atendido' => 'boolean',
    ];

    /**
     * Relación many-to-many con Material
     */
    public function materiales()
    {
        return $this->belongsToMany(Material::class, 'solicitud_material')
                    ->withPivot(['cantidad','observaciones'])
                    ->withTimestamps();
    }

    /**
     * Relación a User (quién hizo la solicitud)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación a Servicio
     */
    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    /**
     * Scope: sólo las solicitudes pendientes (no atendidas)
     */
    public function scopePendientes($query)
    {
        return $query->where('atendido', false);
    }

    /**
     * Scope: sólo las solicitudes ya atendidas
     */
    public function scopeAtendidas($query)
    {
        return $query->where('atendido', true);
    }

    /**
     * Marcar esta solicitud como atendida
     */
    public function marcarAtendida(): bool
    {
        return $this->update(['atendido' => true]);
    }
}
