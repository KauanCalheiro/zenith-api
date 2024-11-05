<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoaModuloTable extends Migration
{
    public function up()
    {
        Schema::create('pessoa_modulo', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('ref_pessoa');
            $table->integer('ref_modulo');

            $table->foreign('ref_pessoa')->references('id')->on('pessoas')->onDelete('cascade');
            $table->foreign('ref_modulo')->references('id')->on('modulos')->onDelete('cascade');

            $table->index('ref_pessoa', 'idx_pessoa_modulo_pessoa');
            $table->index('ref_modulo', 'idx_pessoa_modulo_modulo');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pessoa_modulo');
    }
}
