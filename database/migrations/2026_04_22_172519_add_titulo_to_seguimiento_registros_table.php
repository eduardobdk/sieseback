<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTituloToSeguimientoRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::table('seguimiento_registros', function (Blueprint $table) {
        // AQUÍ VA LA LÍNEA:
        $table->string('titulo')->after('id'); 
    });
}

public function down(): void
{
    Schema::table('seguimiento_registros', function (Blueprint $table) {
        // Es buena práctica poner esto para poder deshacer el cambio si es necesario
        $table->dropColumn('titulo');
    });
}
}
