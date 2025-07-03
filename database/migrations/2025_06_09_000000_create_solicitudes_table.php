<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('servicio_id')->constrained('servicios')->cascadeOnDelete();
            $table->timestamps();
        });
         Schema::create('solicitud_material', function (Blueprint $table) {
            $table->id();

            // FK a solicitudes (bigint unsigned)
            $table->foreignId('solicitud_id')
                  ->constrained('solicitudes')
                  ->cascadeOnDelete();

            // material_id como INT SIGNED para coincidir con materiales.id
            $table->integer('material_id');
            $table->foreign('material_id')
                  ->references('id')
                  ->on('materiales')
                  ->cascadeOnDelete();

            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitud_material');
        Schema::dropIfExists('solicitudes');
    }
}
