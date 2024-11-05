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
        Schema::create('treino_pessoa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ref_pessoa')->constrained('pessoas');
            $table->foreignId('ref_treino')->constrained('treinos');
            $table->date('dt_inicial');
            $table->date('dt_final')->nullable();
            $table->timestamps();
        });

        Schema::table('treino_pessoa', function (Blueprint $table) {
            $table->index('ref_treino');
            $table->index('ref_pessoa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treino_pessoa');
    }
};
