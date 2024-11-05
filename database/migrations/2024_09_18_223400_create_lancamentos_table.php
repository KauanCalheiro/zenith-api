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
        Schema::create('lancamentos', function (Blueprint $table) {
            $table->id();
            $table->double('valor');
            $table->string('descricao', 45);
            $table->foreignId('ref_titulo')->constrained('titulos');
            $table->foreignId('ref_historico')->constrained('historicos');
            $table->date('dt_emissao');
            $table->date('dt_contabil');
            $table->timestamps();
        });

        Schema::table('lancamentos', function (Blueprint $table) {
            $table->index('ref_titulo');
            $table->index('ref_historico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lancamentos');
    }
};
