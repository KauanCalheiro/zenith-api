<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilModuloTable extends Migration
{
    public function up()
    {
        Schema::create('perfil_modulo', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('ref_perfil');
            $table->integer('ref_modulo');

            $table->foreign('ref_perfil')->references('id')->on('perfis')->onDelete('cascade');
            $table->foreign('ref_modulo')->references('id')->on('modulos')->onDelete('cascade');

            $table->index('ref_perfil', 'idx_perfil_modulo_perfil');
            $table->index('ref_modulo', 'idx_perfil_modulo_modulo');
        });
    }

    public function down()
    {
        Schema::dropIfExists('perfil_modulo');
    }
}
