<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_id',
        'tipo',
        'cantidad',
        'unidad',
        'fecha_movimiento',
        'fecha_caducidad',
    ];
     protected $casts = [
        'fecha_movimiento' => 'date',
        'fecha_caducidad'  => 'date',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
