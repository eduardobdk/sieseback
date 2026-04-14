<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaneacionDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('planeacion_documentos', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->string('portada')->nullable(); // La imagen del librito
        $table->string('archivo')->nullable(); // El PDF descargable
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
        Schema::dropIfExists('planeacion_documentos');
    }
}
