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
        Schema::create('exercicio_treino', function (Blueprint $table) {
            $table->foreignId('ref_exercicio')->constrained('exercicios')->onDelete('cascade');
            $table->foreignId('ref_treino')->constrained('treinos')->onDelete('cascade');
            $table->integer('repeticoes')->nullable();
            $table->timestamps();
            $table->primary(['ref_exercicio', 'ref_treino']);
        });

        Schema::table('exercicio_treino', function (Blueprint $table) {
            $table->index('ref_exercicio');
            $table->index('ref_treino');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercicio_treino');
    }
};
