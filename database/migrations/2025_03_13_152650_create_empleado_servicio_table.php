<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('empleado_servicio', function (Blueprint $table) {
            $table->id();

            // Claves foráneas para empleado y servicio
            $table->foreignId('empleado_id')
                ->constrained('empleados')
                ->onDelete('cascade'); // Si se elimina el empleado, se eliminan los registros relacionados

            $table->foreignId('servicio_id')
                ->constrained('servicios')
                ->onDelete('cascade'); // Si se elimina el servicio, se eliminan los registros relacionados

            // Fechas de inicio y fin del historial
            $table->date('fecha_inicio')->nullable(); // Puede estar vacío si aún no ha iniciado
            $table->date('fecha_fin')->nullable();    // Puede estar vacío si aún está en curso

            $table->timestamps(); // Para created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empleado_servicio');
    }
};
