<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoaPerfilTable extends Migration
{
    public function up()
    {
        Schema::create('pessoa_perfil', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('ref_pessoa');
            $table->integer('ref_perfil');

            $table->foreign('ref_pessoa')->references('id')->on('pessoas')->onDelete('cascade');
            $table->foreign('ref_perfil')->references('id')->on('perfis')->onDelete('cascade');

            $table->index('ref_pessoa', 'idx_pessoa_perfil_pessoa');
            $table->index('ref_perfil', 'idx_pessoa_perfil_perfil');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pessoa_perfil');
    }
}
