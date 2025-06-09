// database/migrations/2025_05_26_000001_add_stock_to_materiales.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('materiales', function (Blueprint $table) {
            $table->decimal('stock_actual', 10, 2)->default(0)->after('descripcion');
        });
    }

    public function down()
    {
        Schema::table('materiales', function (Blueprint $table) {
            $table->dropColumn('stock_actual');
        });
    }
};
