<?php

// database/migrations/xxxx_xx_xx_create_empleados_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('primer_apellido');
            $table->string('segundo_apellido');
            $table->string('numero_empleado')->unique();
            $table->string('rfc')->unique();
            $table->foreignId('servicio_actual_id')->nullable()->constrained('servicios')->nullOnDelete();
            $table->foreignId('plaza_id')->constrained('plazas')->onDelete('restrict');
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
