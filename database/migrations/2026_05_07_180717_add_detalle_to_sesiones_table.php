<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetalleToSesionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('sesiones', function (Blueprint $table) {
        $table->text('detalle_sesion')->nullable(); // Agregamos la columna
    });
}
public function down()
{
    Schema::table('sesiones', function (Blueprint $table) {
        $table->dropColumn('detalle_sesion');
    });
}

}
