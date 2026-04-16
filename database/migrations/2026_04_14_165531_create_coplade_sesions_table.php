<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCopladeSesionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('coplade_sesions', function (Blueprint $table) {
        $table->id();
        $table->integer('anio'); // Para las pestañas (2024, 2023...)
        $table->string('apartado'); // Ej: "Sesiones ordinarias", "Subcomités..."
        $table->string('titulo');
        $table->string('imagen')->nullable();
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
        Schema::dropIfExists('coplade_sesions');
    }
}
