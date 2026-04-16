<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('evaluacion_documentos', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->string('portada')->nullable(); // Foto del librito
        $table->string('archivo')->nullable(); // Archivo PDF
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
        Schema::dropIfExists('evaluacion_documentos');
    }
}
