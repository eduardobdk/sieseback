<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCopladeBienvenidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
{
    Schema::create('coplade_bienvenidas', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->string('subtitulo');
        $table->text('descripcion');
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
        Schema::dropIfExists('coplade_bienvenidas');
    }
}
