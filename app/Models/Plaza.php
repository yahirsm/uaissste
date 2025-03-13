<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plaza extends Model
{
    use HasFactory;

    protected $table = 'plazas'; // Define la tabla explícitamente
    protected $fillable = ['nombre'];
    public $timestamps = true; // Para registrar created_at y updated_at

    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}
