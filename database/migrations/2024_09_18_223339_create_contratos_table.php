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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ref_pessoa')->constrained('pessoas');
            $table->foreignId('ref_plano')->constrained('planos');
            $table->foreignId('ref_motivo_cancelamento')->constrained('motivos_cancelamento')->nullable();
            $table->foreignId('ref_pessoa_indicacao')->constrained('pessoas')->nullable();
            $table->foreignId('ref_forma_pagamento')->constrained('formas_pagamento');
            $table->timestamp('dt_contratacao');
            $table->timestamp('dt_final')->nullable();
            $table->timestamp('dt_suspensao')->nullable();
            $table->integer('meses_suspensao')->nullable();
            $table->string('caminho_contrato')->nullable();
            $table->integer('numero_parcelas_pagamento')->nullable();
            $table->timestamps();
        });

        Schema::table('contratos', function (Blueprint $table) {
            $table->index('ref_pessoa');
            $table->index('ref_plano');
            $table->index('ref_motivo_cancelamento');
            $table->index('ref_pessoa_indicacao');
            $table->index('ref_forma_pagamento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
