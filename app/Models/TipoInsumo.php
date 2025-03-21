<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoInsumo extends Model
{
    use HasFactory;

    protected $table = 'tipos_insumo';  // Nombre real de la tabla
    protected $primaryKey = 'tipo_insumo_id'; // Clave primaria correcta

    public $timestamps = false; // Si no usas `created_at` y `updated_at`
}
