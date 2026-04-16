<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('informes', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->string('portada')->nullable();
        $table->string('pdf_contexto')->nullable();
        $table->string('pdf_anexo1')->nullable();
        $table->string('pdf_anexo2')->nullable();
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
        Schema::dropIfExists('informes');
    }
}
