// database/migrations/2025_05_26_000002_create_movimientos_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->increments('id');              // genera INT AUTO_INCREMENT PK
            $table->integer('material_id');        // INT firmado, para que coincida con materiales.id
            $table->enum('tipo', ['entrada', 'salida']);
            $table->decimal('cantidad', 10, 2);
            $table->string('unidad')->default('pieza');
            $table->date('fecha_movimiento');
            $table->date('fecha_caducidad')->nullable();
            $table->timestamps();

            $table->foreign('material_id')
                ->references('id')
                ->on('materiales')
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
};
