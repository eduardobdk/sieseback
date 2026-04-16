<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('documentos', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->string('archivo'); // El nombre del archivo en el servidor
        $table->string('extension'); // Para saber si es pdf, docx, xlsx y ponerle su icono
        $table->string('seccion'); // Aquí diremos si es de "herramientas", "evaluacion", etc.
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
        Schema::dropIfExists('documentos');
    }
}
