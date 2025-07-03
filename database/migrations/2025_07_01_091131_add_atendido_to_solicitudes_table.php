<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAtendidoToSolicitudesTable extends Migration
{
    public function up(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->boolean('atendido')
                  ->default(false)
                  ->after('updated_at');
        });
    }

    public function down(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->dropColumn('atendido');
        });
    }
}
