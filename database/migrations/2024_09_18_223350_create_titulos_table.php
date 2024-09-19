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
            $table->string('descricao', 45);
            $table->double('valor');
            $table->date('dt_vencimento');
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
