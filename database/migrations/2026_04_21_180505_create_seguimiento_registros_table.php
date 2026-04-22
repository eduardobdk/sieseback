<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientoRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::create('seguimiento_registros', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');    // Falta esta columna según el error
        $table->string('extension'); // 'pdf' o 'link'
        $table->text('archivo');     // Ruta del PDF o la URL
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seguimiento_registros');
    }
}
