<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddObservacionesToSolicitudMaterialTable extends Migration
{
    public function up()
    {
        Schema::table('solicitud_material', function (Blueprint $table) {
            $table->string('observaciones')->nullable()->after('cantidad');
        });
    }

    public function down()
    {
        Schema::table('solicitud_material', function (Blueprint $table) {
            $table->dropColumn('observaciones');
        });
    }
}
