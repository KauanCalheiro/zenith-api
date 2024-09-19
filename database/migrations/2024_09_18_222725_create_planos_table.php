<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('planos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 45);
            $table->text('descricao');
            $table->timestamp('dt_inicio');
            $table->timestamp('dt_fim')->nullable();
            $table->integer('numero_meses_contrato')->nullable();
            $table->double('valor_mensal');
            $table->string('modelo_contrato', 45);
            $table->integer('diarias');
            $table->foreignId('ref_historico')->constrained('historicos')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('planos', function (Blueprint $table) {
            $table->index('ref_historico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planos');
    }
};
