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
        Schema::create('titulos', function (Blueprint $table) {
            $table->id();
            $table->double('valor');
            $table->date('dt_vencimento');
            $table->integer('num_parcela');
            $table->date('dt_emissao');
            $table->string('cod_boleto', 45);
            $table->string('cod_barras', 45);
            $table->date('dt_remessa')->nullable();
            $table->date('dt_retorno')->nullable();
            $table->foreignId('ref_contrato')->constrained('contratos')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('titulos', function (Blueprint $table) {
            $table->index('ref_contrato');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('titulos');
    }
};
