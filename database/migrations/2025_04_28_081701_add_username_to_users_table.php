<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // <<--- No olvides importar DB

class AddUsernameToUsersTable extends Migration
{
    public function up(): void
    {
        // 1. Agrega el campo username como nullable
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 255)->nullable()->after('name');
        });

        // 2. Asigna automáticamente un username a los usuarios existentes
        DB::table('users')->update([
            'username' => DB::raw('CONCAT("user", id)')
        ]);

        // 3. Hace que el campo username sea único
        Schema::table('users', function (Blueprint $table) {
            $table->unique('username');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['username']); // <<--- Primero eliminar el índice unique
            $table->dropColumn('username');
        });
    }
}
