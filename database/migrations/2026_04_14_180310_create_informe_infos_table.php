<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::table('informes_info', function (Blueprint $table) {
        $table->text('descripcion')->after('id');
    });
}

public function down(): void
{
    Schema::table('informes_info', function (Blueprint $table) {
        $table->dropColumn('descripcion');
    });
}
}
